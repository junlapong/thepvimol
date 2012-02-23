
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PP0030"; 
	$pkId = "id";

	$col = "job";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=array("name"=>"id","type"=>"number","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );			
	${$col}[1]=array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );			
	${$col}[2]=array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[3]=array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[4]=array("name"=>"order_qty","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[5]=array("name"=>"finish_order_qty","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"0" );			
	${$col}[6]=array("name"=>"finish_flag","type"=>"string","editor"=>	"textFieldBlank,width:100" ,"df"=>"0" );			
	${$col}[7]=array("name"=>"job_date","type"=>"datetime","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[8]=array("name"=>"cancel_flag","type"=>"string","editor"=>"textFieldBlank,width:100" ,"df"=>"0" );			
	${$col}[9]=array("name"=>"cancel_reason","type"=>"string","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[10]=array("name"=>"cancel_date","type"=>"datetime","editor"=>"textFieldBlank,width:150","df"=>"0000-00-00 00:00:00"  );			
	${$col}[11]=array("name"=>"cancel_staff","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>""  );			

	${$col}[12]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[13]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[14]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[15]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[16]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[17]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );

	include(APPPATH.'/views/common/h_include'.EXT);
?>
<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	
<?php 
	// Generate RowEdit itemCombo
	 $cname = "item";
	 $pk = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = "MT0010/itemCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
//		selItem = combo.getValue();
//	 	Do something
}

<?php 
	// Generate RowEdit itemCombo
	 $cname = "loca";
	 $pk = "location_code";
	 $dname = "location_code";
	 $vname = "location_code";
	 $url = "MT0050/locationCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
//			selItem = combo.getValue();
//		 	Do something
}

var itemComboSearch = formCombo2('item_code','<?=lang('item_code')?>','item_code','item_code','',itemStore);
var locaComboSearch = formCombo2('location_code','<?=lang('location_code')?>','location_code','location_code','',locaStore);

// Row Editor ^^^

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
    	
	// Search
	<?php 
		$gname = "job";
		$leftComp = "";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

    
	// Grid
	<?php 
		$gname = "job";
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
		$gname	= "job";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});

</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>