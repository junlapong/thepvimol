
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PP0080";
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
	${$col}[11]=array("name"=>"p_lost_qty","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );
	${$col}[12]=array("name"=>"t_lost_qty","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );

	${$col}[13]=array("name"=>"frame_length","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );
	${$col}[14]=array("name"=>"mat_length","type"=>"number","editor"=>"textFieldBlank,width:80" ,"df"=>"" );
	
	
	${$col}[15]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[16]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[17]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[18]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[19]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[20]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );

	$col = "vacDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = $screenId."_detail1";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"production_date","type"=>"string","editor"=>"textFieldBlank,width:70","df"=>"" );
	${$col}[1]		=	array("name"=>"machine_code","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[2]		=	array("name"=>"mat_code","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[3]		=	array("name"=>"input_lot","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[4]		=	array("name"=>"input_pp_date","type"=>"string","editor"=>"textFieldBlank,width:70","df"=>"" );
	${$col}[5]		=	array("name"=>"input_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[6]		=	array("name"=>"total_mat_weight_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[7]		=	array("name"=>"finish_A_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[8]		=	array("name"=>"finish_B_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[9]		=	array("name"=>"lost_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	
	${$col}[10]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[11]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[12]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[13]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[14]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[15]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
	$col = "cutDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = $screenId."_detail1";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"production_date","type"=>"string","editor"=>"textFieldBlank,width:70","df"=>"" );
	${$col}[1]		=	array("name"=>"machine_code","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[2]		=	array("name"=>"machine_side","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	${$col}[3]		=	array("name"=>"finish_A_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[4]		=	array("name"=>"finish_B_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[5]		=	array("name"=>"lost_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	
	${$col}[6]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[7]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[8]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[9]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[10]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[11]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );

	$col = "kaeDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = $screenId."_detail1";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"production_date","type"=>"string","editor"=>"textFieldBlank,width:70","df"=>"" );
	${$col}[1]		=	array("name"=>"packing_qty","type"=>"string","editor"=>"textFieldBlank,width:90","df"=>"" );
	${$col}[2]		=	array("name"=>"finish_A_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[3]		=	array("name"=>"finish_B_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[4]		=	array("name"=>"lost_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	
	${$col}[5]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[6]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[7]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[8]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[9]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[10]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){

Ext.QuickTips.init();

// Global
var selItem = "";
var selReqQty = 0;
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR

var finDate  = formDateField1(false,false,'finished_date','<?=lang('finished_date')?>',new Date(),'Y-m-d');	
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true,true,'0');	

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [];
	var rightComp = [];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
	<?php 
		$gname = "pResult";
		$width = "auto";
		$height = "200";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;

		var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["job_no"] = values["job_no"];
	    
	    vacDetailDataStore.removeAll();
	    vacDetailDataStore.load(obj);
	    cutDetailDataStore.removeAll();
	    cutDetailDataStore.load(obj);
	    kaeDetailDataStore.removeAll();
	    kaeDetailDataStore.load(obj);
	}
	// Grid vvv
	<?php 
		$gname = "vacDetail";
		$view = "getVacDetail";
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$enableCollapse = true;
		$title = "ข้อมูลการแวค";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}
	// Grid vvv
	<?php 
		$gname = "cutDetail";
		$view = "getCutDetail";
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$enableCollapse = true;
		$title = "ข้อมูลการตัด";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}	
	// Grid vvv
	<?php 
		$gname = "kaeDetail";
		$view = "getKaeDetail";
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$enableCollapse = true;
		$title = "ข้อมูลการแกะ";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}	
	// Final panel	
	<?php 
		$panelItem = "";
		$gname	= "pResult";
		$gname2	= "vacDetail";
		$gname3	= "cutDetail";
		$gname4	= "kaeDetail";
		$render = $screenId;
		include(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>