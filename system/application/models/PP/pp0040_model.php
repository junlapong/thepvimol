<?php
class PP0040_model extends MY_Model {  
	
    function PP0040_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  
    
    // GET ORDER LIST
    function getJobOrderList(){
    	$sql = "select *
				      , IF((current_qty + plan_qty-safty_qty) - order_remain_qty > 0 , 0 , abs((current_qty+plan_qty-safty_qty) - order_remain_qty)) as req_pp_qty
				from(
						select order_no
						      ,item_code
						      ,DATE_FORMAT(MIN(delivery_date),'%Y-%m-%d') as req_date
						      ,sum(order_qty) as order_qty
						      ,sum(delivery_qty)
						      ,sum(issue_qty)
						      ,sum(delivery_remain_qty)
						      ,IF( sum(order_qty) - sum(issue_qty) < 0 , 0 ,sum(order_qty) - sum(issue_qty))  as order_remain_qty
						      ,IFNULL((SELECT sum(order_qty) - sum(finish_order_qty) as plan_qty FROM JOB_LEDGER j WHERE (order_qty > finish_order_qty) and delete_flag = 0 and j.finish_flag = 0 and j.cancel_flag = 0 and j.item_code = a.item_code),0) as plan_qty
						      ,IFNULL((select sum(current_stock_qty) as current_qty  from INVENTORY_MASTER i where i.item_code = a.item_code),0) as current_qty
						      ,IFNULL((select sum(safty_stock) as safty_stock from INVENTORY_MASTER i where i.item_code = a.item_code),0) as safty_qty
						from (
								select o.order_no
								      , o.item_code
								      , o.order_qty
								      , o.delivery_date
								      , IFNULL(di.delivery_qty,0) as delivery_qty
								      , IFNULL(di.issue_qty,0) as issue_qty
								      , IFNULL(di.delivery_remain_qty,0) as delivery_remain_qty
								from (SELECT order_no,item_code,sum(order_qty) as order_qty,min(delivery_date) as delivery_date FROM ORDER_LEDGER where cancel_flag = 0 and finished_flag = 0 and delete_flag = 0 group by order_no,item_code) o
								LEFT JOIN (select d.order_no
								            ,d.item_code
								            ,sum(d.order_qty) as delivery_qty
								            ,sum(IFNULL(i.issue_qty,0)) as issue_qty
								            ,sum(d.order_qty) - sum(IFNULL(i.issue_qty,0)) as delivery_remain_qty
								      from (SELECT * FROM DELIVERY_LEDGER where cancel_flag = 0 and delete_flag = 0) d
								      LEFT JOIN (SELECT issue_no
								                        ,order_no
								                        ,item_code
								                        ,sum(issue_qty) as issue_qty
								                  FROM ISSUE_LEDGER where cancel_flag = 0 and delete_flag = 0 group by issue_no,order_no,item_code) i
								                  ON i.order_no = d.delivery_no and i.item_code = d.item_code and d.order_qty = i.issue_qty
								                  group by d.order_no,d.item_code ) di
								ON o.order_no = di.order_no and o.item_code = di.item_code
						) a
						group by item_code
				)b
				order by req_date";
    	
		return $this->db->query($sql);
    }
    
}