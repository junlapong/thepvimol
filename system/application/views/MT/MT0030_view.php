
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0030"; 
	$pkId = "employee_code";

	$col = "employee";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=array("name"=>"employee_code","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"");
	${$col}[1]=array("name"=>"employee_firstname","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[2]=array("name"=>"employee_lastname","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[3]=array("name"=>"employee_nickname","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[4]=array("name"=>"location","type"=>"string","editor"=>"{xtype:'combo', typeAhead: true,triggerAction: 'all',transform: 'location',lazyRender: true, listClass: 'x-combo-list-small'},width:80","df"=>"" );
	${$col}[5]=array("name"=>"start_date","type"=>"datetime","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[6]=array("name"=>"end_date","type"=>"datetime","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[7]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );
	${$col}[8]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[9]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[10]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[11]=array("name"=>"created_user","type"=>"string","editor"=>"","df"=>"" );
	${$col}[12]=array("name"=>"updated_user","type"=>"string","editor"=>"","df"=>"" );

	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
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

Ext.onReady(function(){
    Ext.QuickTips.init();
    	

	// Search
	<?php 
		$gname = "employee";
		$leftComp = "empCode,empFname,empNname";
		$rightComp = " empDate,empLname";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
    
	// Grid
	<?php 
		$gname = "employee";
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
		$gname	= "employee";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<select name="location" id="location" style="display: none;">
    <option value="BK_OF"><?= lang('BK_OF') ?></option>
    <option value="BK_FC"><?= lang('BK_FC') ?></option>
    <option value="KO_FC"><?= lang('KO_FC') ?></option>
</select>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>