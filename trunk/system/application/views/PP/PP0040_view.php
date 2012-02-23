
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
$screenId = "PP0040";
$pkId = "item_code";

$col = "order";
${$col."URL"} 	 = $screenId;
${$col."PK"} 	 = $pkId;
${$col."Render"} = "none";
${$col."Editor"} = $col."Editor";
${$col} = array();
//	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
//	${$col}[1]		=	array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );

${$col}[0]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
${$col}[1]		=	array("name"=>"req_date","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
${$col}[2]		=	array("name"=>"order_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[3]		=	array("name"=>"order_remain_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[4]		=	array("name"=>"plan_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[5]		=	array("name"=>"current_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[6]		=	array("name"=>"safty_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[7]		=	array("name"=>"req_pp_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );

${$col}[8]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
${$col}[9]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
${$col}[10]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[11]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[12]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
${$col}[13]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );

include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//           Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	

Ext.onReady(function(){

Ext.QuickTips.init();

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_


// Grid vvv
	<?php 
		$gname = "order";
		$width = "auto";
		$height = "500";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "รายการสินค้าระหว่างดำเนินการ";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
		include_once(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
	?>
	
	// Final panel	
	<?php 
		$panelItem = "";
		$gname	= "order";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>