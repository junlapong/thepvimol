
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0020"; 
	$pkId = "mol_code";
	
	$col = "mol";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]  = array("name" => "mol_code",   "type" => "string", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[1]  = array("name" => "mol_description", "type" => "string", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[2]  = array("name" => "mol_short_name",   "type" => "string", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[3]  = array("name" => "product_type",    "type" => "number", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[4]  = array("name" => "mol_category","type" => "number", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[5]  = array("name" => "mol_width", "type" => "number", "editor" => "textFieldBlank,width:50" ,"df"=>"");
	${$col}[6]  = array("name" => "mol_length", "type" => "number", "editor" => "textFieldBlank,width:50" ,"df"=>"");
	${$col}[7]  = array("name" => "frame_length", "type" => "number", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[8]  = array("name" => "piece1", "type" => "number", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[9]  = array("name" => "piece2", "type" => "number", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[10] = array("name" => "location_code", "type" => "string", "editor" => "textFieldBlank,width:110" ,"df"=>"");
	${$col}[11]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );
	${$col}[12]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[13]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[14]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[15]=array("name"=>"created_user","type"=>"string","editor"=>"","df"=>"" );
	${$col}[16]=array("name"=>"updated_user","type"=>"string","editor"=>"","df"=>"" );

	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//			 Component Define Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);		


Ext.onReady(function(){
    Ext.QuickTips.init();

	// Search
	<?php 
		$gname = "mol";
		$leftComp = "";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// Grid
	<?php 
			$gname = "mol";
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
			$gname	= "mol";
			$render = $screenId;
			include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>

});
</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>