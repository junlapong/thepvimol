
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "SL0000"; 
	$pkId = "id";
	
	$col = "sale";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	= array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]  = array("name" => "vendor_code","type" => "string", "editor" => "textFieldBlank ,width:50" ,"df"=>"");
	${$col}[2]  = array("name" => "vendor_name","type" => "string", "editor" => "textFieldBlank,width:180" ,"df"=>"");
	
	${$col}[3]  = array("name" => "item_code","type" => "string", "editor" => "textFieldBlank,width:100" ,"df"=>"");
	${$col}[4]  = array("name" => "price_std","type" => "number", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[5]  = array("name" => "price_csh","type" => "number", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[6]  = array("name" => "price_crd","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");	
	
	${$col}[7]  = array("name" => "step1_discount","type" => "number", "editor" => "numFieldBlank,width:60","df"=>"" );
	${$col}[8]  = array("name" => "step1_discount_rate","type" => "number", "editor" => "numFieldBlank,width:60","df"=>"" );
	${$col}[9]  = array("name" => "step2_discount","type" => "number", "editor" => "numFieldBlank,width:60","df"=>"" );
	${$col}[10] = array("name" => "step2_discount_rate","type" => "number", "editor" => "numFieldBlank,width:60","df"=>"" );
	${$col}[11] = array("name" => "step3_discount","type" => "number", "editor" => "numFieldBlank,width:60","df"=>"" );
	${$col}[12] = array("name" => "step3_discount_rate","type" => "number", "editor" => "numFieldBlank,width:60","df"=>"" );
	
	
	${$col}[13] = array("name" => "start_price_date","type" => "datetime", "editor" => "textFieldNBlank,width:80" ,"df"=>"");
	${$col}[14] = array("name" => "end_price_date","type" => "datetime", "editor" => "textFieldNBlank,width:80" ,"df"=>"");
	
	${$col}[15]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );
	${$col}[16]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[17]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[18]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[19]=array("name"=>"created_user","type"=>"string","editor"=>"","df"=>"" );
	${$col}[20]=array("name"=>"updated_user","type"=>"string","editor"=>"","df"=>"" );

	include_once(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component Define Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);		

var itemSearch = formTextField1(true,false,'item_code','<?=lang('item_code')?>');	
var vendorSearch = formTextField1(true,false,'vendor_code','<?=lang('vendor_code')?>');	
var vendorNSearch = formTextField1(true,false,'vendor_name','<?=lang('vendor_name')?>');	

    Ext.QuickTips.init();

	// Search
	<?php 
		$gname = "sale";
		$leftComp = "itemSearch,vendorSearch";
		$rightComp = "vendorNSearch";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// Grid
	<?php 
			$gname = "sale";
			$width = "auto";
			$height = "513";
			$initialLoad = true;
			$enableCollapse = false;
			$title = "";
			include_once(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);

	?>

	// Final panel	
	<?php 
			$panelItem = "";
			$gname	= "sale";
			$render = $screenId;
			include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>

});

</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>