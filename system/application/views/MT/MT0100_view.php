
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0100"; 
	$pkId = "id";
	
	$col = "routing";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]		=	array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:120","df"=>"" );
	${$col}[2]		=	array("name"=>"routing_no","type"=>"number","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[3]		=	array("name"=>"routing_name","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[4]		=	array("name"=>"routing_description","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[5]		=	array("name"=>"work_shop_code","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );

	${$col}[6]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[7]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[8]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[9]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[10]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[11]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
	include(APPPATH.'/views/common/h_include'.EXT);
?>
<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">

var itemStore = new Ext.data.JsonStore({
    root: 'data',
    idProperty: 'item_code',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: 'item_code'}],
    url: '../common/ITEM/getItemCodeList'
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var itemCombo = formCombo2('item_code','<?=lang('item_code')?>','item_code','item_code','',itemStore);

// Form field
var itemCode = formTextField1(true,false,'item_code','<?=lang('item_code')?>');	


// Row Editor ^^^

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
	
	// Search
	<?php 
		$gname = "routing";
		$leftComp = "itemCode";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  

	// Grid
	<?php 
		$gname = "routing";
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
		$gname	= "routing";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>