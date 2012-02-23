<?php
class PP0080_model extends MY_Model {  
	
    function PP0080_model(){  
    	parent::MY_Model();
    	$this->tbl_menu = 'JOB_LEDGER';
    	$this->pkId = "id";
    }  

	function getRowCount($limit,$offset,$conditions){  
		$sql = "SELECT count(*) as count FROM ( ".$this->getQuery($conditions).") cnt";

    	$result = $this->db->query($sql)->result_array(); 
 		return $result[0]["count"];    
	}
    
    function getProductionResultList($limit,$offset,$conditions){
    	$sql = $this->getQuery($conditions)."	LIMIT ".$offset.",".$limit;
    	
		return $this->db->query($sql);
    }

	function getQuery($conditions){
    	$sql = "select *
				        , ((a.piece_mol * vac_qty) - (kae_qty)) /  (a.piece_mol * vac_qty) * 100 as p_lost_qty
                , p_lost + (((a.piece_mol * vac_qty) - (kae_qty)) /  (a.piece_mol * vac_qty) * 100) as t_lost_qty
				FROM (
				select 	 v.job_no
				    					,v.item_code
				    					,roll_qty
				    					,roll_weight_tt_qty
				    					,vac_qty
				    					,IFNULL(cut_qty,0) as cut_qty
				    					,IFNULL(kae_qty,0) as kae_qty
				    					,order_qty as pp_qty
				    					,finish_order_qty as store_qty
				    					,finish_flag
				    					,IFNULL(piece1,'0') as piece_mol
                      , mat_length
                      , frame_length
                      , frame_per_roll
                      , s_lost
                      , p_lost
								from (
										SELECT vl.job_no
													 ,vl.item_code
													 ,sum(vl.input_qty) as roll_qty
													 ,sum(vl.total_mat_weight_qty) as roll_weight_tt_qty
													 ,sum(vl.finish_A_qty) + sum(finish_B_qty) as vac_qty
													 ,sum(vl.lost_qty)
										       , avg(mat_length) as mat_length
										       , avg(frame_length) as frame_length
										       , avg(frame_per_roll) as frame_per_roll
										       , avg(s_lost) as s_lost
										       , avg(p_lost) as p_lost
										FROM  (
										        SELECT sv.item_code
										              ,sv.job_no
										              ,sv.mat_code
										              ,sv.machine_code
										              ,sv.input_qty
										              ,sv.total_mat_weight_qty
										              ,finish_A_qty
										              ,finish_B_qty
										              ,lost_qty
										              , mat_length
										              , frame_length
										              , frame_per_roll
										              ,(1 - (( finish_A_qty + finish_B_qty + lost_qty ) / (frame_per_roll * sv.input_qty))) * 100 as s_lost
										              ,(1 - (( finish_A_qty + finish_B_qty ) / (frame_per_roll * sv.input_qty))) * 100 as p_lost
										        FROM VAC_LEDGER sv
										        LEFT JOIN
										        (     SELECT  *
										                    , y.mat_length/y.frame_length/10 as frame_per_roll
													        FROM (
														          select item_code
														               , mat_code
														               , job_no
														               , machine_code
														               , (select item_length from ITEM_MASTER where item_code = mat_code) as mat_length
														               , avg(frame_length) as frame_length
														          from QC_VAC_LEDGER
														          where input_seq <> 0
														          group by item_code,mat_code,job_no,machine_code
										              ) y
												    ) x
										        ON x.item_code = sv.item_code and x.mat_code = sv.mat_code and x.job_no = sv.job_no and x.machine_code = sv.machine_code
										) vl
								      group by job_no ) v
								LEFT JOIN (
								      SELECT job_no
								            ,sum(finish_A_qty) + sum(finish_B_qty) as cut_qty
								            ,sum(lost_qty)
								      FROM CUT_LEDGER c
								      group by job_no ) c
								ON v.job_no = c.job_no
								LEFT JOIN (
								      SELECT job_no
								            ,sum(finish_A_qty*packing_qty) + sum(finish_B_qty*packing_qty) as kae_qty
								            ,sum(lost_qty*packing_qty)
								      FROM KAE_LEDGER k
								      group by job_no ) k
								ON v.job_no = k.job_no
								LEFT JOIN (
								      SELECT job_no,item_code,order_qty,finish_order_qty,finish_flag
								      FROM JOB_LEDGER
								      ) j
								ON v.job_no = j.job_no
								LEFT JOIN (
								      SELECT i.item_code,m.mol_code,m.piece1
								      FROM ITEM_MASTER i
								      JOIN MOL_MASTER m ON i.mol_code = m.mol_code
								) mo
								ON v.item_code = mo.item_code
				order by SUBSTRING(v.job_no,8,2) desc ,SUBSTRING(v.job_no,6,2) desc ,SUBSTRING(v.job_no,2,3) desc ) a
    			";
    	return $sql;		
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
								
				$tmp = $tmp . "" . $key . " like '%".$value."%' ";
				$i++;
			}

		}
		
    	$sql = "select   DATE_FORMAT(production_date,'%Y-%m-%d') as production_date
    					,machine_code
    					,mat_code
    					,input_lot
    					,DATE_FORMAT(input_pp_date,'%Y-%m-%d') as input_pp_date
    					,input_qty
    					,total_mat_weight_qty
    					,finish_A_qty
    					,finish_B_qty
    					,lost_qty
				FROM VAC_LEDGER v
				". $tmp ."
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
								
				$tmp = $tmp . "" . $key . " like '%".$value."%' ";
				$i++;
			}

		}
		
    	$sql = "select   DATE_FORMAT(production_date,'%Y-%m-%d') as production_date
						,machine_code
						,machine_side
						,finish_A_qty
						,finish_B_qty
						,lost_qty
				FROM CUT_LEDGER v
				". $tmp ."
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
								
				$tmp = $tmp . "" . $key . " like '%".$value."%' ";
				$i++;
			}

		}
		
    	$sql = "select   DATE_FORMAT(production_date,'%Y-%m-%d') as production_date
						,packing_qty
						,sum(finish_A_qty * packing_qty) as finish_A_qty
						,sum(finish_B_qty * packing_qty) as finish_B_qty
						,sum(lost_qty * packing_qty) as lost_qty
				FROM KAE_LEDGER v
				". $tmp ."
				group by production_date,packing_qty
				
    			";
    	return $sql;		
	}
}