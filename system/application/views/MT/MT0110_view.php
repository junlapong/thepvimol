
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0110"; 
	$pkId = "id";
	
	$col = "unit";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=	array("name"=>"unit_code","type"=>"string","editor"=>"textFieldNBlank","df"=>"0" );
	${$col}[1]=	array("name"=>"unit_name","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[2]=	array("name"=>"customer_flag","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"0" );
	${$col}[3]=	array("name"=>"unit_category","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[4]=	array("name"=>"standard_unit_code","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[5]=	array("name"=>"unit_ratio","type"=>"number","editor"=>"numFieldBlank,width:120","df"=>"" );
	${$col}[6]=	array("name"=>"round_code","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[7]=	array("name"=>"decimal_digit","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	
	${$col}[8]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[9]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[10]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[11]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[12]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[13]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
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
var numFieldBlank = rowEditNumField1(true);

// Form field
var unitCode = formTextField1(true,false,'unit_code','<?=lang('unit_code')?>');	


// Row Editor ^^^

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
    	
	// Search
	<?php 
		$gname = "unit";
		$leftComp = "unitCode";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

	// Grid
	<?php 
		$gname = "unit";
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
		$gname	= "unit";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>