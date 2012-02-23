
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0070"; 
	$pkId = "vendor_code";
	
	$col = "vendor";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0] =array("name"=>	"vendor_code"	,"type"=>	"string","editor"=>	"textFieldNBlank,width:80","df"=>"" );
	${$col}[1] =array("name"=>	"trader_name"	,"type"=>	"string"	,"editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[2] =array("name"=>	"trader_en_name"	,"type"=>	"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[3] =array("name"=>	"trader_short_name"	,"type"=>	"string","editor"=>	"textFieldBlank,width:100","df"=>"" );
	${$col}[4] =array("name"=>	"trader_en_short_name","type"=>	"string","editor"=>	"textFieldBlank,width:100","df"=>"" );
	${$col}[5] =array("name"=>	"country_code","type"=>"string","editor"=>	"textFieldBlank,width:80","df"=>"" );
	${$col}[6] =array("name"=>	"zip_code"	,"type"=>"string","editor"=>	"textFieldBlank,width:80","df"=>"" );
	${$col}[7] =array("name"=>	"address_1"	,"type"=>"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[8] =array("name"=>	"address_2"	,"type"=>"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[9] =array("name"=>	"address_3"	,"type"=>"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[10]=array("name"=>	"address_en_1","type"=>	"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[11]=array("name"=>	"address_en_2","type"=>	"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[12]=array("name"=>	"address_en_3","type"=>	"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[13]=array("name"=>	"tel","type"=>"string","editor"=>	"textFieldBlank,width:100","df"=>"" );
	${$col}[14]=array("name"=>	"fax","type"=>"string","editor"=>	"textFieldBlank,width:100","df"=>"" );
	${$col}[15]=array("name"=>	"email","type"=>"string","editor"=>	"textFieldBlank,width:150","df"=>"" );
	${$col}[16]=array("name"=>	"website","type"=>"string","editor"=>	"textFieldBlank,width:150","df"=>"" );

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
var vendorCode = formTextField1(true,false,'vendor_code','<?=lang('vendor_code')?>');	
var vendorName = formTextField1(true,false,'trader_name','<?=lang('trader_name')?>');	
var countryCode = formTextField1(true,false,'country_code','<?=lang('country_code')?>');	
// Row Editor ^^^

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
    	
	// Search
	<?php 
		$gname = "vendor";
		$leftComp = "vendorCode,countryCode";
		$rightComp = "vendorName";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

	// Grid
	<?php 
		$gname = "vendor";
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
		$gname	= "vendor";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>