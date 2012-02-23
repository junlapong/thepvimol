<?php
class SL0040_model extends MY_Model {  
	
    function SL0040_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ORDER_LEDGER';
    	$this->pkId = "order_no";
    }  
    
    // GET ORDER LIST
    function getJobOrderList(){
    	$sql = "SELECT od.order_no
				       , po_no
				       , (select trader_short_name from VENDOR_MASTER where vendor_code = customer_code ) as customer_name
				       , delivery_code
				       , total_qty
				       , finished_flag
				       , IFNULL(plan_delivery_qty,0) as plan_delivery_qty
				       , IFNULL(issue_qty,0) as delivery_qty
				       , IFNULL(total_qty - issue_qty,0) as remain_qty
				FROM
				(
				      SELECT *
				            , sum(order_qty) as total_qty
										, ( select sum(issue_qty) from ISSUE_LEDGER where order_ref_no = o.order_no) as issue_qty
				      FROM ORDER_LEDGER o
				      WHERE o.delete_flag = '0' and o.finished_flag = '0'
				      group by order_no
				) od
				LEFT JOIN
				(
				    SELECT order_no
				           ,IFNULL(sum( plan_delivery_qty),0) as plan_delivery_qty
				           -- ,IFNULL(sum( issue_qty),0) as issue_qty
				    FROM(
				        SELECT delivery_no
				              ,order_no
				              ,sum(order_qty) as plan_delivery_qty
				              -- ,( select sum(issue_qty) from ISSUE_LEDGER where order_no = d.delivery_no) as issue_qty
				        FROM DELIVERY_LEDGER d
				        where delete_flag = 0 and cancel_flag = 0
				        group by delivery_no
				        ) a
				    group by order_no
				) b
				ON od.order_no = b.order_no
				WHERE IFNULL(issue_qty,0) <> 0
				order by order_no
    			";
    	
		return $this->db->query($sql);
    }
    
}