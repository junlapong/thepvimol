<?php
class SL0011_model extends MY_Model {  
	
    function SL0011_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  
    
	function getRowCount($limit,$offset,$conditions){  
		$sql = "SELECT count(*) as count FROM ( ".$this->genQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];  
	}	

    function getDataLimit($limit,$offset,$conditions){
    	$sql = $this->genQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
	}	
	
	function getDetailRowCount($limit,$offset,$conditions){  
		$sql = "SELECT count(*) as count FROM ( ".$this->genDetailQuery($conditions).") cnt";
    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];  
	}	

    function getDataDetailLimit($limit,$offset,$conditions){
		$sql = $this->genDetailQuery($conditions);   	
		return $this->db->query($sql);
	}
	
	/*
	 * Query for search order status
	 * 
	 */
	function genQuery($conditions)
	{
        $tmp = ""; $having ="";
    	$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $key != 'order_status_v' && $value != ''){
				if( $i == 0 ) { 
					$tmp = $tmp . " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
				
				if( $key == 'trader_short_name' )
				{
					$pkey = "v.";
				}else{
					$pkey = "y.";
				}
								
				$tmp = $tmp . "".$pkey .$key . " like '%".$value."%' ";
				$i++;
			}
			if($key == 'order_status_v' && $value != '')
			{
				if( $value != 'all')
					$having = " having order_status = '".$value."'";
			}
		}
		if($this->session->userdata('username') != 'admin' ){
				if( $i == 0 ) { 
					$tmp = $tmp . " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
				
				$tmp = $tmp . " y.delete_flag = '0'";
		}
		    	
    	$sql = "SELECT IF( y.cancel_flag = '1' , 'ยกเลิก'
				       , IF ( y.finished_flag = '1' , 'ปิด'
					   , IF ( sum(y.wait_issue_qty) = 0 , 'รอใบเบิก'
				       , IF(sum(y.req_order_qty) > sum(y.wait_issue_qty) 
				       , IF(sum(y.issue_qty) <> sum(y.wait_issue_qty) , 'รอส่ง', 'ส่งบางส่วน' )
					   , IF(sum(y.issue_qty) <> sum(y.wait_issue_qty),'รอส่ง', 'รอปิด' ) ) ) ) )  as order_status
				       , y.order_no
				       , sum(y.req_order_qty)
				       , sum(y.wait_issue_qty)
				       , sum(y.issue_qty)
				      , y.po_no
				      , y.delivery_no
				      , y.inv_no
				      , y.order_date
				      , y.plan_delivery_date
				      , y.SL0011_delivery_date
				      , y.ref_doc
				      , y.customer_code
				      , y.delivery_code
				      , y.cancel_flag
				      , y.cancel_reason
				      , y.cancel_date
				      , y.cancel_staff
				      , y.finished_flag
				      , y.finished_reason
				      , y.finished_date
				      , y.finished_approver
				      , y.remark
				      , y.memo_date
				      , y.memo_staff
				      , y.notes
				      , y.delete_flag
				      , y.created_date
				      , y.updated_date
				      , y.created_user
				      , y.updated_user	
				       ,v.trader_short_name
				       ,d.delivery_name
				       ,d.address_1
				       ,d.address_2
				       ,d.address_3
				FROM
				(
				  SELECT
					           o.order_no
				              ,o.item_code
				              ,IFNULL( (o.order_qty), 0) as req_order_qty
				              ,IFNULL( sum(x.order_qty), 0) as wait_issue_qty
				              ,IFNULL( sum(x.issue_qty), 0) as issue_qty
								      , po_no
								      , delivery_no
								      , inv_no
								      , DATE_FORMAT(order_date,'%Y-%m-%d') as order_date
								      , DATE_FORMAT(o.delivery_date,'%Y-%m-%d') as plan_delivery_date
								      , DATE_FORMAT(x.delivery_date,'%Y-%m-%d') as SL0011_delivery_date
								      , ref_doc
								      , customer_code
								      , delivery_code
								      , cancel_flag
								      , cancel_reason
								      , DATE_FORMAT(cancel_date,'%Y-%m-%d') as cancel_date
								      , cancel_staff
								      , finished_flag
								      , finished_reason
								      , DATE_FORMAT(finished_date,'%Y-%m-%d') as finished_date
								      , finished_approver
								      , notes as remark
								      , created_date as memo_date
								      , created_user as memo_staff
								      , notes
								      , delete_flag
								      , created_date
								      , updated_date
								      , created_user
								      , updated_user
								FROM (SELECT * FROM ORDER_LEDGER WHERE cancel_flag = '0' and delete_flag = '0' and finished_flag = '0') o
								left join (
								  select d.delivery_no,
								         d.item_code,
								         d.order_qty,
								         d.order_no,
								         i.issue_no,
								         i.issue_qty,
								         d.delivery_date,
								         ref_doc as inv_no
								  from (SELECT * FROM DELIVERY_LEDGER WHERE cancel_flag = '0' and delete_flag = '0') d
								  left join (SELECT issue_no, order_no ,sum(issue_qty) as issue_qty, item_code FROM ISSUE_LEDGER where cancel_flag = '0' and delete_flag = '0' group by issue_no,order_no,item_code) i ON i.order_no = d.delivery_no and i.item_code = d.item_code
								) x on o.order_no = x.order_no  and o.item_code = x.item_code
				        group by order_no, item_code
								order by  order_no,SL0011_delivery_date , plan_delivery_date
								) y
				join VENDOR_MASTER v on v.vendor_code = y.customer_code
				join DELIVERY_MASTER d on d.delivery_code = y.delivery_code
				". $tmp ."
				group by order_no
				".$having."
				order by order_status desc";
    
    	return $sql;
	}
	
	/*
	 * Query for search order detail
	 * 
	 */
	function genDetailQuery($conditions)
	{
    	$tmp = "";
    	$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $value != ''){
				$tmp = $tmp . " AND ";
				$tmp = $tmp . "o." .$key . " like '%".$value."%' ";
			}
			$i++;
		}
		    	
    	$sql = "SELECT y.order_no
    	              ,y.item_code
                      ,req_qty
    	              ,IFNULL(y.remain_withdraw_qty,0) as remain_withdraw_qty
    	              ,IFNULL(y.deli_qty,0) as delivery_qty
    	              ,IFNULL(current_stock_qty ,0) as stock_qty
    	              ,IFNULL(plan_qty,0) as plan_qty
    	              ,(IFNULL(plan_qty,0) + IFNULL(current_stock_qty,0)) as available_qty
				FROM (
				  SELECT order_no
			              ,req_qty
			              ,deli_qty
							  		,item_code
							  		,remain_withdraw_qty
							      	,(SELECT IF( ( (sum(order_qty) - sum(finish_order_qty)) < 0 ) , 0 , sum(order_qty) - sum(finish_order_qty)) FROM JOB_LEDGER where item_code = x.item_code and cancel_flag = '0' and finish_flag = '0') as plan_qty
							  FROM (
									select a.order_no,
									       a.item_code,
									       a.order_qty as req_qty,
									       b.deli_qty ,
							           a.order_qty - IFNULL(b.deli_qty,0) as remain_withdraw_qty
									from
												(  SELECT order_no,
												          item_code,
												          sum(order_qty) as order_qty
												   FROM ORDER_LEDGER o
												   where cancel_flag = '0' and delete_flag = '0' ".$tmp."
												   group by order_no,item_code) a
									left join (
							             SELECT order_no, item_code ,sum(order_qty) as deli_qty
												   FROM DELIVERY_LEDGER o
												   where cancel_flag = '0' and delete_flag = '0' ".$tmp."
												   group by order_no,item_code) b
							    on a.item_code = b.item_code and a.order_no = b.order_no
							  ) x
							  -- WHERE remain_withdraw_qty > 0
							) y
							LEFT JOIN
							( 
									SELECT finv.item_code, IFNULL(finv.current_stock_qty,0) - IFNULL(binv.wait_qty,0) as current_stock_qty
									FROM (
									SELECT item_code, IFNULL(sum(iv.current_stock_qty) ,0) as current_stock_qty
									  FROM INVENTORY_MASTER iv
									  group by iv.item_code
									) finv
									LEFT JOIN (
										SELECT d.item_code,sum(d.order_qty) as wait_qty
										FROM (SELECT * FROM DELIVERY_LEDGER o where cancel_flag = '0' and delete_flag = '0' ".$tmp." ) d
										LEFT JOIN ISSUE_LEDGER isu ON isu.order_no = d.delivery_no and isu.item_code = d.item_code
										WHERE isu.item_code is null and d.cancel_flag = '0' and d.delete_flag = '0'
										group by d.item_code
			      ) binv ON finv.item_code = binv.item_code
				  ) i ON i.item_code = y.item_code";		
    	return $sql;
	}

}