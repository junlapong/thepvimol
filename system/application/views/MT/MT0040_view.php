
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0040"; 
	$pkId = "id";

	$col = "inventory";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=array("name"=>"id","type"=>"number","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );			
	${$col}[1]=array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:110","df"=>"" );			
	${$col}[2]=array("name"=>"location_code","type"=>"string","editor"=>"locaCombo,width:100" ,"df"=>"" );			
	${$col}[3]=array("name"=>"min_stock","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[4]=array("name"=>"max_stock","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[5]=array("name"=>"safty_stock","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[6]=array("name"=>"start_stock_qty","type"=>"number","editor"=>	"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[7]=array("name"=>"order_qty","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[8]=array("name"=>"planing_qty","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[9]=array("name"=>"current_stock_qty","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[10]=array("name"=>"last_received_date","type"=>"datetime","editor"=>"textFieldBlank,width:150","df"=>"0000-00-00 00:00:00"  );			
	${$col}[11]=array("name"=>"last_issue_date","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"0000-00-00 00:00:00"  );			
	${$col}[12]=array("name"=>"last_stock_taking_date","type"=>"datetime","editor"=>"textFieldBlank,width:150","df"=>"0000-00-00 00:00:00"  );			

	${$col}[13]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[14]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[15]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[16]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[17]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[18]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );

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
	 $url = "../common/ITEM/getItemCodeList";
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
		$gname = "inventory";
		$leftComp = "itemComboSearch";
		$rightComp = "locaComboSearch";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

    
	// Grid
	<?php 
		$gname = "inventory";
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
		$gname	= "inventory";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});

</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>