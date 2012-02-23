
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0010"; 
	$pkId = "item_code";
	
	$col = "item";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]  = array("name" => "item_code","type" => "string", "editor" => "textFieldNBlank,width:110","df"=>"" );
	${$col}[1]  = array("name" => "item_name","type" => "string", "editor" => "textFieldBlank ,width:150" ,"df"=>"");
	${$col}[2]  = array("name" => "item_short_name","type" => "string", "editor" => "textFieldBlank,width:100" ,"df"=>"");
	${$col}[3]  = array("name" => "sheet_code","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[4]  = array("name" => "mol_code","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false","df"=>"" );
	${$col}[5]  = array("name" => "color","type" => "string", "editor" => "textFieldBlank,width:50","df"=>"" );
	${$col}[6]  = array("name" => "item_width","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");
	${$col}[7]  = array("name" => "item_length","type" => "number", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[8]  = array("name" => "item_height","type" => "number", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[9]  = array("name" => "item_thickness","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");
	${$col}[10] = array("name" => "item_weight","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");
	${$col}[11] = array("name" => "vac_height","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");
	${$col}[12] = array("name" => "sheet_frame","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");
	${$col}[13] = array("name" => "in_out_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[14] = array("name" => "stock_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false","df"=>"" );
	${$col}[15] = array("name" => "purchase_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[16] = array("name" => "low_level_code","type" => "number", "editor" => "numFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[17] = array("name" => "need_reviewing_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[18] = array("name" => "default_small_packing_qty","type" => "number", "editor" => "numFieldBlank,width:80" ,"df"=>"");
	${$col}[19] = array("name" => "default_big_packing_qty","type" => "number", "editor" => "numFieldBlank,width:80" ,"df"=>"");
	${$col}[20] = array("name" => "default_final_pack_style","type" => "string", "editor" => "textFieldBlank,width:80" ,"df"=>"");
	${$col}[21] = array("name" => "LT","type" => "number", "editor" => "numFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[22] = array("name" => "item_unit","type" => "string", "editor" => "textFieldBlank,width:50" ,"df"=>"");
	${$col}[23] = array("name" => "secure_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false","df"=>"" );
	${$col}[24] = array("name" => "location_category","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[25]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );
	${$col}[26]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[27]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[28]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );
	${$col}[29]=array("name"=>"created_user","type"=>"string","editor"=>"","df"=>"" );
	${$col}[30]=array("name"=>"updated_user","type"=>"string","editor"=>"","df"=>"" );

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

    Ext.QuickTips.init();

	// Search
	<?php 
		$gname = "item";
		$leftComp = "itemSearch";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// Grid
	<?php 
			$gname = "item";
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
			$gname	= "item";
			$render = $screenId;
			include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>

});

</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>