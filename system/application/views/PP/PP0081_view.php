
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PP0081";
	$pkId = "id";
	
	$col = "pResult";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]=array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );			
	${$col}[1]=array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:120" ,"df"=>"" );
	${$col}[2]=array("name"=>"piece_mol","type"=>"string","editor"=>"textFieldBlank,width:80" ,"df"=>"" );
	${$col}[3]=array("name"=>"finish_flag","type"=>"bool","editor"=>"textFieldBlank,width:55" ,"df"=>"0" );	
	${$col}[4]=array("name"=>"pp_qty","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );			
	${$col}[5]=array("name"=>"store_qty","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );			
	${$col}[6]=array("name"=>"roll_qty","type"=>"number","editor"=>"textFieldBlank,width:50" ,"df"=>"" );			
	${$col}[7]=array("name"=>"roll_weight_tt_qty","type"=>"number","editor"=>"textFieldBlank,width:50" ,"df"=>"" );			
	${$col}[8]=array("name"=>"vac_qty","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );			
	${$col}[9]=array("name"=>"cut_qty","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );			
	${$col}[10]=array("name"=>"kae_qty","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );
	
	${$col}[11]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[12]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[13]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[14]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[15]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[16]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );

	$col = "vacDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = $screenId."_detail1";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	
	${$col}[1]		=	array("name"=>"MCVF1_ROLL_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	${$col}[2]		=	array("name"=>"MCVF1_A_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[3]		=	array("name"=>"MCVF1_B_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[4]		=	array("name"=>"MCVF1_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	
	${$col}[5]		=	array("name"=>"MCVF2_ROLL_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	${$col}[6]		=	array("name"=>"MCVF2_A_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[7]		=	array("name"=>"MCVF2_B_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[8]		=	array("name"=>"MCVF2_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );

	${$col}[9]		=	array("name"=>"MCVF3_ROLL_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	${$col}[10]		=	array("name"=>"MCVF3_A_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[11]		=	array("name"=>"MCVF3_B_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[12]		=	array("name"=>"MCVF3_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	
	${$col}[13]		=	array("name"=>"total_roll_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	${$col}[14]		=	array("name"=>"total_pp_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[15]		=	array("name"=>"total_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	
	${$col}[16]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[17]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[18]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[19]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[20]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[21]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
	$col = "cutDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = $screenId."_detail1";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	
	${$col}[1]		=	array("name"=>"MC1_A_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[2]		=	array("name"=>"MC1_B_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[3]		=	array("name"=>"MC1_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	
	${$col}[4]		=	array("name"=>"MC2_A_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[5]		=	array("name"=>"MC2_B_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[6]		=	array("name"=>"MC2_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );

	${$col}[7]		=	array("name"=>"MC3_A_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[8]		=	array("name"=>"MC3_B_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[9]		=	array("name"=>"MC3_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );

	${$col}[10]		=	array("name"=>"MC8_A_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[11]		=	array("name"=>"MC8_B_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[12]		=	array("name"=>"MC8_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	
	${$col}[13]		=	array("name"=>"total_pp_qty","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[14]		=	array("name"=>"total_lost_qty","type"=>"string","editor"=>"textFieldBlank,width:40","df"=>"" );
	
	${$col}[15]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[16]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[17]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[18]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[19]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[20]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
	$col = "kaeDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = $screenId."_detail1";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[1]		=	array("name"=>"finish_A_qty","type"=>"string","editor"=>"textFieldBlank,width:90","df"=>"" );
	${$col}[2]		=	array("name"=>"finish_B_qty","type"=>"string","editor"=>"textFieldBlank,width:90","df"=>"" );
	${$col}[3]		=	array("name"=>"lost_qty","type"=>"string","editor"=>"textFieldBlank,width:90","df"=>"" );
	
	${$col}[4]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[5]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[6]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[7]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[8]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[9]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){

Ext.QuickTips.init();

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
<?php // unplan reason combo
	 $cname = "ppDate";
	 $pk = "production_date";
	 $fname = "production_date";
	 $dname = "production_date";
	 $vname = "production_date";
	 $url = $screenId."/getProductionDateCombo";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $value = "";
	 $readonly = false;
	 $initParam ="";
     $width = "200";
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
		var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["production_date"] = combo.getValue();
	    
	    vacDetailDataStore.removeAll();
	    vacDetailDataStore.load(obj);
	    cutDetailDataStore.removeAll();
	    cutDetailDataStore.load(obj);
	    kaeDetailDataStore.removeAll();
	    kaeDetailDataStore.load(obj);
}

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true,true,'0');	

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [ppDateCombo];
	var rightComp = [];
    var maindata = formMain1(leftComp,rightComp);

	// Grid vvv
	var vacHead =   [
     				{header: '', colspan: 2, align: 'center'},
     				{header: 'MCVF1', colspan: 4, align: 'center'},
     				{header: 'MCVF2', colspan: 4, align: 'center'},
     				{header: 'MCVF3', colspan: 4, align: 'center'},
     				{header: 'รวม (เฟรม)', colspan: 3, align: 'center'},
     				{header: '', colspan: 6, align: 'center'}
     				
   				 	]
	<?php 
		$multiHeader = "vacHead";
		$gname = "vacDetail";
		$view = "getVacDetail";
		$width = "auto";
		$height = "250";
		$initialLoad = false;
		$enableCollapse = true;
		$title = "ข้อมูลการแวค";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid2'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}
	// Grid vvv
	var cutHead =   [
     				{header: '', colspan: 2, align: 'center'},
     				{header: 'MC1', colspan: 3, align: 'center'},
     				{header: 'MC2', colspan: 3, align: 'center'},
     				{header: 'MC3', colspan: 3, align: 'center'},
     				{header: 'MC8', colspan: 3, align: 'center'},
     				{header: 'รวม (เฟรม)', colspan: 2, align: 'center'},
     				{header: '', colspan: 6, align: 'center'}
     				
   				 	]
	<?php 
		$multiHeader = "cutHead";
		$gname = "cutDetail";
		$view = "getCutDetail";
		$width = "auto";
		$height = "250";
		$initialLoad = false;
		$enableCollapse = true;
		$title = "ข้อมูลการตัด";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid2'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}	
	// Grid vvv
	var kaeHead =   [
     				{header: '', colspan: 2, align: 'center'},
     				{header: 'รวม (ชิ้น)', colspan: 3, align: 'center'},
     				{header: '', colspan: 6, align: 'center'}
     				
   				 	]
	<?php 
		$multiHeader = "kaeHead";
		$gname = "kaeDetail";
		$view = "getKaeDetail";
		$width = "auto";
		$height = "250";
		$initialLoad = false;
		$enableCollapse = true;
		$title = "ข้อมูลการแกะ";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid2'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}	
	// Final panel	
	<?php 
		$fpanel = "maindata";
		$panelItem = "";
		$gname	= "vacDetail";
		$gname2	= "cutDetail";
		$gname3	= "kaeDetail";
		$render = $screenId;
		include(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>