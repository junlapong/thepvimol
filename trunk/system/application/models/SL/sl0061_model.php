<?php
class SL0061_model extends MY_Model {  
	
    function SL0061_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'DELIVERY_LEDGER';
    	$this->pkId = "id";
    }  

    function getOrderDetailList($query){
        $tmp = "";
    	if($query != null )
    	{
    		$tmp = " and x.order_no = '".$query."'";
    	}
    	
    	
    	$sql = "select cancel_flag,order_no,DATE_FORMAT(o.order_date,'%Y-%m-%d')as order_date,DATE_FORMAT(o.plan_deli_date,'%Y-%m-%d')as plan_order_date,po_no,ref_doc,v.trader_name,d.delivery_name,d.address_1,d.address_2,d.address_3
				from (
				select x.*
								from (
									select a.order_no,
				                 order_date,
				                 cancel_flag,
				                 customer_code,
				                 delivery_code,
									       ref_doc,
									       po_no,
									       a.plan_deli_date,
									       a.item_code,
									       a.order_qty,
									       b.deli_qty , a.order_qty - IFNULL(b.deli_qty,0) as remain_qty
									from
									(  SELECT order_no,
				                    order_date,
				                    cancel_flag,
									          item_code,
				                    customer_code,
				                    delivery_code,
									          sum(order_qty) as order_qty,
									          delivery_date as plan_deli_date,
									          ref_doc,
									          po_no
									   FROM ORDER_LEDGER ord
									   where ord.cancel_flag = '0' and ord.delete_flag = '0' and ord.finished_flag = '0'
									   group by order_no,item_code) a
									left join (
									   SELECT order_no, item_code ,sum(order_qty) as deli_qty
									   FROM DELIVERY_LEDGER d
									   where cancel_flag = '0' and delete_flag = '0'
									   group by order_no,item_code) b 
									on a.item_code = b.item_code and a.order_no = b.order_no
								) x
								where remain_qty > 0 ".$tmp."
								order by plan_deli_date
				) o
				join VENDOR_MASTER v on v.vendor_code = o.customer_code
				join DELIVERY_MASTER d on d.delivery_code = o.delivery_code
				group by o.order_no
				order by o.plan_deli_date";

		return $this->db->query($sql);
    }
    
    function getOrderNoList($query){
        $tmp = "";
    	if($query != null )
    	{
    		$tmp = " and o.order_no = '".$query."'";
    	}
    	
    	
    	$sql = "SELECT y.order_no
    	              ,y.item_code
    	              ,IFNULL(y.remain_withdraw_qty,0) as remain_withdraw_qty
    	              ,IFNULL(y.remain_withdraw_qty,0) as delivery_qty
    	              ,IFNULL(current_stock_qty ,0) as stock_qty
    	              ,IFNULL(plan_qty,0) as plan_qty
    	              ,(IFNULL(plan_qty,0) + IFNULL(current_stock_qty,0)) as available_qty
    	              ,(IFNULL(delivery_reason,'')) as delivery_reason
				FROM (
				  SELECT order_no
				  		,item_code
				  		,remain_withdraw_qty
				  		,delivery_reason
				      	,(SELECT IF( ( (sum(order_qty) - sum(finish_order_qty)) < 0 ), 0 , sum(order_qty) - sum(finish_order_qty)) FROM JOB_LEDGER where item_code = x.item_code and cancel_flag = '0' and finish_flag = '0') as plan_qty
				  FROM (
						select a.order_no,
						       a.item_code,
						       a.order_qty,
						       b.deli_qty ,
						       b.delivery_reason,
				           a.order_qty - IFNULL(b.deli_qty,0) as remain_withdraw_qty
						from
									(  SELECT order_no,
									          item_code,
									          sum(order_qty) as order_qty
									   FROM ORDER_LEDGER o
									   where cancel_flag = '0' and finished_flag = '0' and delete_flag = '0' ".$tmp."
									   group by order_no,item_code) a
						left join (
				             SELECT order_no
				             	  , item_code 
				             	  , sum(order_qty) as deli_qty
				             	  , delivery_reason
									   FROM DELIVERY_LEDGER d
									   where cancel_flag = '0' and delete_flag = '0'  and order_no = '".$query."'
									   group by order_no,item_code) b
				    on a.item_code = b.item_code and a.order_no = b.order_no
				  ) x
				  WHERE remain_withdraw_qty > 0
				) y
				LEFT JOIN
				( 
						SELECT finv.item_code, IFNULL(finv.current_stock_qty,0) - IFNULL(binv.wait_qty,0) as current_stock_qty
						FROM (
						SELECT item_code, IFNULL(sum(iv.current_stock_qty) ,0) as current_stock_qty
						  FROM INVENTORY_MASTER iv
						  WHERE location_code like 'K%'
						  group by iv.item_code
						) finv
						LEFT JOIN (
							SELECT d.item_code,sum(d.order_qty) as wait_qty
							FROM (SELECT * FROM DELIVERY_LEDGER WHERE cancel_flag = '0' and delete_flag = '0' and order_no = '".$query."' ) d
							LEFT JOIN ISSUE_LEDGER isu ON isu.order_no = d.delivery_no and isu.item_code = d.item_code
							WHERE isu.item_code is null and d.cancel_flag = '0' and d.delete_flag = '0'
							group by d.item_code
						) binv ON finv.item_code = binv.item_code
				) i ON i.item_code = y.item_code";

		return $this->db->query($sql);
    }
       
    function getMaxSeqDeliNo($no){
    	$sql = "SELECT SUBSTR(MAX(delivery_no),11,2) as seq 
    			FROM DELIVERY_LEDGER d
		 		WHERE d.delivery_no like '".$no."%'";

		return $this->db->query($sql);
    }
}