
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0150"; 
	$pkId = "sale_code";

	$col = "saleman";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=array("name"=>"sale_code","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"");
	${$col}[1]=array("name"=>"id_card_no","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[2]=array("name"=>"firstname","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[3]=array("name"=>"lastname","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[4]=array("name"=>"nickname","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[5]=array("name"=>"add1","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[6]=array("name"=>"add2","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[7]=array("name"=>"add3","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[8]=array("name"=>"home_tel","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[9]=array("name"=>"fax","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[10]=array("name"=>"contact","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[11]=array("name"=>"account1","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[12]=array("name"=>"account2","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[13]=array("name"=>"account3","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[14]=array("name"=>"commission","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	
	${$col}[15]=array("name"=>"start_date","type"=>"datetime","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[16]=array("name"=>"end_date","type"=>"datetime","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[17]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );
	${$col}[18]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[19]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[20]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[21]=array("name"=>"created_user","type"=>"string","editor"=>"","df"=>"" );
	${$col}[22]=array("name"=>"updated_user","type"=>"string","editor"=>"","df"=>"" );

	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
    
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component Define Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	

//Search fields
var empCode = formTextField1(true,false,'employee_code','<?=lang('employee_code')?>');
var empFname = formTextField1(true,false,'employee_firstname','<?=lang('employee_firstname')?>');
var empNname = formTextField1(true,false,'employee_nickname','<?=lang('employee_nickname')?>');
var empLname = formTextField2(true,false,'employee_lastname','<?=lang('employee_lastname')?>','',180);

var startDate = formDateField1(true,false,'start_date','<?=lang('start_date')?>','','Y-m-d');	
var endDate = formDateField1(true,false,'end_date','<?=lang('end_date')?>','','Y-m-d');	
var items = [ startDate, endDate ];
var empDate = formComposit1('','<?=lang('emp_date')?>',items);


    	

	// Search
	<?php 
		$gname = "saleman";
		$leftComp = "";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
    
	// Grid
	<?php 
		$gname = "saleman";
		$width = "auto";
		$height = "513";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		include_once(APPPATH.'/views/common/simpleGrid1'.EXT);
		include_once(APPPATH.'/views/common/simpleAddEvent1'.EXT);
		include_once(APPPATH.'/views/common/simpleDelEvent1'.EXT);
		include_once(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
	?>

	// Final panel	
	<?php 
		$panelItem = "";
		$gname	= "saleman";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>