<?php
class PP0081_model extends MY_Model {  
	
    function PP0081_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  

	function getProductionDateCombo(){
    	$sql = "SELECT DATE_FORMAT(production_date,'%Y-%m-%d') as production_date
				FROM VAC_LEDGER
				UNION
				SELECT DATE_FORMAT(production_date,'%Y-%m-%d') as production_date
				FROM CUT_LEDGER
				UNION
				SELECT DATE_FORMAT(production_date,'%Y-%m-%d') as production_date
				FROM KAE_LEDGER
				group by production_date
    			";
    	return $this->db->query($sql);		
	}

// ***********	
// GET VAC DATA	
// ***********	
	function getVacDetailRowCount($limit,$offset,$conditions){
		$sql = "SELECT count(*) as count FROM ( ".$this->getVacQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    		
	}
	
	function getVacDataDetailLimit($limit,$offset,$conditions){
    	$sql = $this->getVacQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);		
	}
	
	function getVacQuery($conditions){
		$tmp = "";
		$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $key != 'order_status_v' && $value != ''){
				if( $i == 0 ) { 
					$tmp = " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
								
				$tmp = $tmp . "v." . $key . " like '%".$value."%' ";
				$i++;
			}

		}
		
    	$sql = "SELECT *
				      ,a.MCVF1_roll_QTY + a.MCVF2_roll_QTY + a.MCVF3_roll_QTY as total_roll_qty
				      ,a.MCVF1_A_QTY + a.MCVF1_B_QTY + a.MCVF2_A_QTY + a.MCVF2_B_QTY + a.MCVF3_A_QTY + a.MCVF3_B_QTY as total_pp_qty
				      ,a.MCVF1_lost_QTY + a.MCVF2_lost_QTY + a.MCVF3_lost_QTY as total_lost_qty
				FROM(
				SELECT item_code
				      ,IFNULL((SELECT sum(input_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF1' group by machine_code),0) as MCVF1_ROLL_qty
				      ,IFNULL((SELECT sum(finish_A_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF1' group by machine_code),0) as MCVF1_A_qty
				      ,IFNULL((SELECT sum(finish_B_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF1' group by machine_code),0) as MCVF1_B_qty
				      ,IFNULL((SELECT sum(lost_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF1' group by machine_code),0) as MCVF1_lost_qty
				      ,IFNULL((SELECT sum(input_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF2' group by machine_code),0) as MCVF2_ROLL_qty
				      ,IFNULL((SELECT sum(finish_A_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF2' group by machine_code),0) as MCVF2_A_qty
				      ,IFNULL((SELECT sum(finish_B_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF2' group by machine_code),0) as MCVF2_B_qty
				      ,IFNULL((SELECT sum(lost_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF2' group by machine_code),0) as MCVF2_lost_qty
				      ,IFNULL((SELECT sum(input_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF3' group by machine_code),0) as MCVF3_ROLL_qty
				      ,IFNULL((SELECT sum(finish_A_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF3' group by machine_code),0) as MCVF3_A_qty
				      ,IFNULL((SELECT sum(finish_B_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF3' group by machine_code),0) as MCVF3_B_qty
				      ,IFNULL((SELECT sum(lost_qty) FROM VAC_LEDGER WHERE production_date = v.production_date and item_code = v.item_code and machine_code = 'MCVF3' group by machine_code),0) as MCVF3_lost_qty
				FROM VAC_LEDGER v
				". $tmp ."
				group by item_code
				order by item_code ) a
    			";
    	return $sql;		
	}
	
// ***********	
// GET CUT DATA	
// ***********	
	function getCutDetailRowCount($limit,$offset,$conditions){
		$sql = "SELECT count(*) as count FROM ( ".$this->getCutQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    		
	}
	
	function getCutDataDetailLimit($limit,$offset,$conditions){
    	$sql = $this->getCutQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);		
	}
	
	function getCutQuery($conditions){
		$tmp = "";
		$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $key != 'order_status_v' && $value != ''){
				if( $i == 0 ) { 
					$tmp = " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
								
				$tmp = $tmp . "v." . $key . " like '%".$value."%' ";
				$i++;
			}

		}
		
    	$sql = "SELECT *
				      ,a.MC1_A_QTY + a.MC1_B_QTY + a.MC2_A_QTY + a.MC2_B_QTY + a.MC3_A_QTY + a.MC3_B_QTY + a.MC8_A_QTY + a.MC8_B_QTY as total_pp_qty
				      ,a.MC1_lost_QTY + a.MC2_lost_QTY + a.MC3_lost_QTY + a.MC8_lost_QTY as total_lost_qty
				FROM (
				SELECT item_code
				      ,IFNULL((SELECT sum(finish_A_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC1'),0) as MC1_A_qty
				      ,IFNULL((SELECT sum(finish_B_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC1'),0) as MC1_B_qty
				      ,IFNULL((SELECT sum(lost_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC1'),0) as MC1_lost_qty
				      ,IFNULL((SELECT sum(finish_A_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC2'),0) as MC2_A_qty
				      ,IFNULL((SELECT sum(finish_B_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC2'),0) as MC2_B_qty
				      ,IFNULL((SELECT sum(lost_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC2'),0) as MC2_lost_qty
				      ,IFNULL((SELECT sum(finish_A_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC3'),0) as MC3_A_qty
				      ,IFNULL((SELECT sum(finish_B_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC3'),0) as MC3_B_qty
				      ,IFNULL((SELECT sum(lost_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC3'),0) as MC3_lost_qty
				      ,IFNULL((SELECT sum(finish_A_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC8'),0) as MC8_A_qty
				      ,IFNULL((SELECT sum(finish_B_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC8'),0) as MC8_B_qty
				      ,IFNULL((SELECT sum(lost_qty) FROM CUT_LEDGER group by production_date,item_code, machine_code HAVING production_date = v.production_date and item_code = v.item_code and machine_code = 'MC8'),0) as MC8_lost_qty
				FROM CUT_LEDGER v
				". $tmp ."
				group by item_code
				order by item_code ) a
    			";
    	return $sql;		
	}
	
// ***********	
// GET Kae DATA	
// ***********	
	function getKaeDetailRowCount($limit,$offset,$conditions){
		$sql = "SELECT count(*) as count FROM ( ".$this->getKaeQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    		
	}
	
	function getKaeDataDetailLimit($limit,$offset,$conditions){
    	$sql = $this->getKaeQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);		
	}
	
	function getKaeQuery($conditions){
		$tmp = "";
		$i = 0;
		foreach($conditions as $key=>$value){
			if($key != 'start' && $key != 'limit' && $key != 'order_status_v' && $value != ''){
				if( $i == 0 ) { 
					$tmp = " WHERE ";	
				}else{
					$tmp = $tmp . " AND ";
				}
								
				$tmp = $tmp . "v." . $key . " like '%".$value."%' ";
				$i++;
			}

		}
		
    	$sql = "SELECT item_code
				      ,sum(finish_A_qty*packing_qty) as finish_A_qty
				      ,sum(finish_B_qty*packing_qty) as finish_B_qty
				      ,sum(lost_qty*packing_qty) as lost_qty
				FROM KAE_LEDGER v
				". $tmp ."
				group by item_code
				order by item_code
				
    			";
    	return $sql;		
	}
}