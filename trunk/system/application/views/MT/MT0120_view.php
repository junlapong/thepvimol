
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0120"; 
	$pkId = "delivery_code";
	
	$col = "delivery";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"delivery_code"	,"type"=>	"string"	,"editor"=>	"textFieldNBlank,width:120","df"=>"" );
	${$col}[1]	=	array("name"=>	"vendor_code"	,"type"=>	"string"	,"editor"=>	"vendorCombo,width:80","df"=>"" );
	${$col}[2]	=	array("name"=>	"seq_no"	,"type"=>	"string"	,"editor"=>	"textFieldNBlank,width:80","df"=>"" );
	${$col}[3]	=	array("name"=>	"delivery_name"	,"type"=>	"string"	,"editor"=>	"textFieldNBlank,width:150","df"=>"" );
	${$col}[4]	=	array("name"=>	"contact_person1"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[5]	=	array("name"=>	"contact_person2"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[6]	=	array("name"=>	"country_code"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:80","df"=>"" );
	${$col}[7]	=	array("name"=>	"zip_code"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:80","df"=>"" );
	${$col}[8]	=	array("name"=>	"address_1"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[9]	=	array("name"=>	"address_2"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[10]	=	array("name"=>	"address_3"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[11]	=	array("name"=>	"address_en_1"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[12]	=	array("name"=>	"address_en_2"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[13]	=	array("name"=>	"address_en_3"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[14]	=	array("name"=>	"tel"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:100","df"=>"" );
	${$col}[15]	=	array("name"=>	"fax"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:100","df"=>"" );
	${$col}[16]	=	array("name"=>	"email"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );

	${$col}[17]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[18]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[19]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[20]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[21]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[22]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
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
	 $url = "../MT/MT0070/vendorCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
//	selItem = combo.getValue();
// 	Do something
}
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
    	
	// Search
	<?php 
		$gname = "delivery";
		$leftComp = "countryCode";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

	// Grid
	<?php 
		$gname = "delivery";
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
		$gname	= "delivery";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>