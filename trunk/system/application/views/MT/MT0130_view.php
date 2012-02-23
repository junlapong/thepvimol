
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0130"; 
	$pkId = "id";
	
	$col = "customer";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]=array("name"=>"vendor_code","type"=>"string","editor"=>"vendorCombo,width:150","df"=>"" );
	${$col}[2]=array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:150","df"=>"" );
	${$col}[3]=array("name"=>"delivery_code","type"=>"string","editor"=>"deliveryCombo,width:150","df"=>"" );

	${$col}[4]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[5]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[6]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[8]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[9]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
	include(APPPATH.'/views/common/h_include'.EXT);
?>
<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
// Form field
//var vendorCode = formTextField1(true,false,'vendor_code','<?=lang('vendor_code')?>');	
//var vendorName = formTextField1(true,false,'trader_name','<?=lang('trader_name')?>');	
var countryCode = formTextField1(true,false,'country_code','<?=lang('country_code')?>');	
// Row Editor ^^^

<?php 
	// Generate RowEdit itemCombo
	 $cname = "vendor";
	 $pk = "vendor_code";
	 $dname = "vendor_code";
	 $vname = "vendor_code";
	 $url = "MT0070/vendorCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	selItem = combo.getValue();
	var deliCom = Ext.getCmp('ext-comp-1016'); 
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["query"] = selItem;
    deliCom.clearValue(); 
	deliveryStore.load(obj);
}

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

}

<?php 
	// Generate RowEdit itemCombo
	 $cname = "delivery";
	 $pk = "id";
	 $dname = "delivery_code";
	 $vname = "delivery_code";
	 $url = "MT0120/deliveryCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList2'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
//	selItem = combo.getValue();
//	Do something
	//alert(combo.getId());
}
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
    	
	// Search
	<?php 
		$gname = "customer";
		$leftComp = "";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

	// Grid
	<?php 
		$gname = "customer";
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
		$gname	= "customer";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>