<?php
class SL0020_model extends MY_Model {  
	
    function SL0020_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ORDER_LEDGER';
    	$this->pkId = "id";
    }  
    
    function isSamePo($pono)
    {
    	$result = false;
    	$sql = "SELECT count(*) as count 
    			FROM ORDER_LEDGER o
		 		WHERE o.po_no = '".$pono."'";
    	$query = $this->db->query($sql);
		$row = $query->row();
    	if( $row->count > 0 ){
			$result = true;
		}
    	
		return $result; 
    }

   function getCustomerList($con){
    	
    	$sql = "select v.vendor_code as vendor_code, CONCAT( v.vendor_code,':',v.trader_short_name) as vendor_name
    		    from CUSTOMER_MASTER c
    		    join VENDOR_MASTER v on v.vendor_code = c.vendor_code
    		    where c.delete_flag = '0'"; 
    	if($con != null && $con != ""){
    		$sql = $sql . " and (c.vendor_code like '" . $con . "%' or v.trader_short_name like '%" . $con . "%')";
    	}	
    	$sql = $sql . "  order by v.vendor_code";
    	return $this->db->query($sql);
    }
    
    function getMaxSeqOrderNo($order){
    	$sql = "SELECT SUBSTR(MAX(order_no),11,2) as seq 
    			FROM ORDER_LEDGER o
		 		WHERE o.order_no like '".$order."%'";

		return $this->db->query($sql);
    }
    
    function getPriceList($vendor,$item){
    	$sql = "SELECT
						vendor_code
						,vendor_name
						,item_code
						,IF(price_std1 is null, price_std, 
												IF(price_std1 = -1 and step1_discount = -2, price_std,
												IF(price_std1 = -1 and step1_discount = -3, price_csh,
												IF(price_std1 = -1 and step1_discount = -4, price_crd,price_std1)))) as price_std
						,IF(price_crd1 is null, price_crd, 
												IF(price_crd1 = -1 and step1_discount = -2, price_std,
												IF(price_std1 = -1 and step1_discount = -3, price_csh,
												IF(price_crd1 = -1 and step1_discount = -3, price_csh,price_crd1)))) as price_crd
						,IF(price_csh1 is null, price_csh, 
												IF(price_csh1 = -1 and step1_discount = -2, price_std,
												IF(price_std1 = -1 and step1_discount = -3, price_csh,
												IF(price_csh1 = -1 and step1_discount = -4, price_crd,price_csh1)))) as price_csh
						,step1_discount
						,step1_discount_rate
						,step2_discount
						,step2_discount_rate
						,step3_discount
						,step3_discount_rate
						,discount_condition
						,discount_rate_type
				FROM(
				select 
						cm.vendor_code
						,(select trader_name from VENDOR_MASTER where vendor_code = cm.vendor_code) as vendor_name
						,cm.item_code
						,s.price_std as price_std
						,s.price_crd as price_crd
						,s.price_csh as price_csh
						,sp.price_std as price_std1
						,sp.price_crd as price_crd1
						,sp.price_csh as price_csh1
						,sp.discount_condition
						,sp.discount_rate_type
						,sp.step1_discount
						,sp.step1_discount_rate
						,sp.step2_discount
						,sp.step2_discount_rate
						,sp.step3_discount
						,sp.step3_discount_rate
				from (SELECT * FROM CUSTOMER_MASTER WHERE vendor_code like '".$vendor."' and item_code like '".$item."') cm
				LEFT JOIN 
					(SELECT item_code,price_std,price_crd,price_csh 
				   FROM SALE_PRICE_MASTER x
					 WHERE delete_flag = 0 and approved_flag = 1 and cancel_flag = 0 and vendor_code = '00000'
								 and item_code like '".$item."'
							   and CURRENT_DATE() BETWEEN start_date and end_date
								 and start_date = (select max(start_date) 
																	 from SALE_PRICE_MASTER 
																	 where vendor_code = x.vendor_code and item_code = x.item_code 
																	 group by vendor_code,item_code)
				
					)s 
				   ON s.item_code = cm.item_code
				LEFT JOIN 
						( select * from SALE_PRICE_MASTER y
							where delete_flag = 0 and cancel_flag = 0 and approved_flag = 1 and vendor_code = '".$vendor."'
								 and item_code like '".$item."'
							   and CURRENT_DATE() BETWEEN start_date and end_date
								 and start_date = (select max(start_date) 
																	 from SALE_PRICE_MASTER 
																	 where vendor_code = y.vendor_code and item_code = y.item_code 
																	 group by vendor_code,item_code)
				
						) sp 
						ON sp.item_code = cm.item_code and cm.vendor_code = sp.vendor_code
				) a
				order by vendor_code
				";	
    	
    	return $this->db->query($sql);
    }
    
    function getPaymentType($vendor,$delivery,$item){
    	$sql = "SELECT payment_type
    			FROM CUSTOMER_MASTER
    			WHERE vendor_code = '".$vendor."' 
    				  and item_code = '".$item."'  
    				  and delivery_code = '".$delivery."'
    			      and delete_flag = 0	
				";	
    	return $this->db->query($sql);
    }    

    function getPacking($item){
    	$sql = "SELECT default_small_packing_qty * default_big_packing_qty as packing_qty
    			FROM ITEM_MASTER
    			WHERE item_code = '".$item."'  
				";	
    	return $this->db->query($sql);
    }    
    
}