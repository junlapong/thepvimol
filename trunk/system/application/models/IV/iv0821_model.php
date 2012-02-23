<?php
class IV0821_model extends MY_Model {  
	
    function IV0821_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'ISSUE_LEDGER';
    	$this->pkId = "id";
    }  
    
   function getItemList($con){
    	
     	$query = "	SELECT item_code,order_qty
					FROM DELIVERY_LEDGER
					where cancel_flag = '0' and delete_flag = '0' and delivery_no = '".$con."'";
     
    	return $this->db->query($query); 
    }
    
   function getDeliveryNoList($con){
     	$query = "	SELECT delivery_no,
					       DATE_FORMAT(MIN(delivery_date),'%Y-%m-%d') as delivery_date,
					       CONCAT(delivery_no,':',DATE_FORMAT(MIN(delivery_date),'%Y-%m-%d')) as delivery_name
					FROM DELIVERY_LEDGER d
					WHERE " . // d.created_date >= DATE_SUB(CURDATE(), INTERVAL 5 DAY) 
						"issue_flag = 0
						and delivery_no like 'DK%'
						and delivery_no not in ( SELECT order_no from ISSUE_LEDGER ) and cancel_flag = '0'
					group by delivery_no
					order by delivery_date,delivery_no";
    	return $this->db->query($query); 
    }
    
	function getDeliveryDetail($con){
     	$query = "	select a.*,
					       dm.delivery_name,
					       dm.address_1,
					       dm.address_2,
					       dm.address_3,
					       dm.zip_code
					from (
							select d.delivery_no,
							       d.delivery_date,
							       d.order_no,
							       o.po_no,
							       o.order_date,
							       o.customer_code,
							       o.delivery_code,
							       (SELECT trader_name from VENDOR_MASTER where vendor_code = o.customer_code) as customer_name
							from
							  (SELECT delivery_no,order_no,delivery_date
							  FROM DELIVERY_LEDGER
							  where cancel_flag = '0' and delete_flag = '0' and delivery_no = '".$con."'
							  group by delivery_no,order_no) d
							JOIN
							  (SELECT order_no,order_date,customer_code,delivery_code,po_no
							  FROM ORDER_LEDGER
							  where cancel_flag = '0' and delete_flag = '0'
							  group by order_no) o
							ON o.order_no = d.order_no
					) a
					JOIN DELIVERY_MASTER dm ON dm.delivery_code = a.delivery_code";
    	return $this->db->query($query); 
    }

   function getInvFIFO($con){
    	
     	$query = "	select item_code, location_code, lot_no, seq_no, current_stock_qty
					from INVENTORY_LOT_MASTER ilm
					where ilm.item_code = '".$con."' and current_stock_qty > 0 and location_code like 'K%'
					order by last_received_date, lot_no";  
    	return $this->db->query($query); 
    }
    
    function getReqOrderQty($deli,$item,$order){
    	
    	$this->db->select('order_qty');
		$this->db->where('delivery_no',$deli);
    	$this->db->where('item_code',$item);
		$this->db->where('order_no',$order);
		$this->db->where('delete_flag','0');
		$this->db->where('cancel_flag','0');
		return $this->db->get('DELIVERY_LEDGER');
    }
    
    function getLotNo($item,$loca){
    	
    	$this->db->select('lot_no');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('delete_flag','0');
    	return $this->db->get('INVENTORY_LOT_MASTER');
    }
        
    function getSeqNo($item,$loca,$lot){
    	
    	$this->db->select('seq_no');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('delete_flag','0');
    	return $this->db->get('INVENTORY_LOT_MASTER');
    }    

    function getCurrentInvQty($item,$loca,$lot,$seq){
    	$this->db->select('current_stock_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
		$this->db->where('delete_flag','0');
    	return $this->db->get('INVENTORY_LOT_MASTER');
    	
    }
        
    function locationCodeList($con){
    	$this->db->select('location_code');
		$this->db->like('location_code','K','after');
    	$this->db->like('location_code',$con,'after');
    	return $this->db->get($this->tbl_menu);
    }

    function getMAXUR(){
		$this->db->select_max('issue_no');
    	$this->db->like('issue_no','PI','after');  
    	return $this->db->get($this->tbl_menu);  
	} 
	
    function getIssueQty($item,$loca){
    	$this->db->select_sum('issue_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		return $this->db->get('ISSUE_LEDGER');
    }
    
    function getReceiveQty($item,$loca){
    	$this->db->select_sum('received_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		return $this->db->get('RECEIVE_LEDGER');
    }

    function getStartQty($item,$loca){
    	$this->db->select_sum('start_stock_qty');
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		return $this->db->get('INVENTORY_MASTER');
    }
        
    function updateInventory($item,$loca,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
    	$this->db->update('INVENTORY_MASTER', $arr); 
    }
    
    function getRecordCount($item,$loca,$lot,$seq){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
		return $this->db->count_all_results('INVENTORY_LOT_MASTER');   
    } 

    function getLotQty($item,$loca,$lot,$seq){
    	$this->db->select_sum('current_stock_qty');
    	$this->db->where('item_code',$item);
    	$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
		return $this->db->get('INVENTORY_LOT_MASTER');
    }
    
    function updateLotInv($item,$loca,$lot,$seq,$arr){
		$this->db->where('item_code',$item);
		$this->db->where('location_code',$loca);
		$this->db->where('lot_no',$lot);
		$this->db->where('seq_no',$seq);
    	$this->db->update('INVENTORY_LOT_MASTER', $arr); 
    }
    
    function updateDeliveryLedger($deliNo,$item,$arr){
		$this->db->where('delivery_no',$deliNo);
		$this->db->where('item_code',$item);
    	$this->db->update('DELIVERY_LEDGER', $arr); 
    }
       
	function insertLotInv($data){
		$this->db->insert('INVENTORY_LOT_MASTER', $data); 
	}
}