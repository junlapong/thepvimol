
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "SL0010"; 
	$pkId = "id";
	
	$orderURL = "SL0010";
	$orderPK = "id";
	$orderRender = $screenId;
	$orderEditor = "orderEditor";
	$order = array();
	$order[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	$order[1]		=	array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank","df"=>"selItem" );
	$order[2]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank","df"=>"0" );
	$order[3]		=	array("name"=>"order_qty","type"=>"number","editor"=>"textFieldBlank","df"=>"" );
	$order[4]		=	array("name"=>"po_no","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[5]		=	array("name"=>"ref_doc","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[6]		=	array("name"=>"customer_code","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[7]		=	array("name"=>"delivery_code","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[8]		=	array("name"=>"order_date","type"=>"datetime","editor"=>"textFieldBlank","df"=>"0000-00-00 00:00:00" );
	$order[9]		=	array("name"=>"delivery_date","type"=>"datetime","editor"=>"textFieldBlank","df"=>"0000-00-00 00:00:00" );
	$order[10]		=	array("name"=>"s_packing_qty","type"=>"number","editor"=>"textFieldBlank","df"=>"" );
	$order[11]		=	array("name"=>"s_packing_style","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[12]		=	array("name"=>"b_packing_qty","type"=>"number","editor"=>"textFieldBlank","df"=>"" );
	$order[13]		=	array("name"=>"b_packing_style","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[14]		=	array("name"=>"cancel_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[15]		=	array("name"=>"cancel_reason","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[16]		=	array("name"=>"cancel_date","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	$order[17]		=	array("name"=>"cancel_staff","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
	
	$order[18]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	$order[19]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	$order[20]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	$order[21]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	$order[22]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	$order[23]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
	include(APPPATH.'/views/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);


// <-- End Grid Header 

Ext.onReady(function(){
    Ext.QuickTips.init();

	<?php 
		$gname = "order";
		$leftComp = "";
		$rightComp = "";
		$render = $screenId."_search";
		include(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>   
    
	<?php 
		$gname = "order";
		$width = "auto";
		$height = "513";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleGrid1'.EXT);
		include(APPPATH.'/views/common/simpleAddEvent1'.EXT);
		include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
	?>
 	 
    function actionAfterEvent(){
    	grid<?=$gname?>.doLayout();
    }
    
    Ext.EventManager.onWindowResize(actionAfterEvent, grid<?=$gname?>); 
    
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->
</head>

<!-- /_/_/_/_/_/_/_/_/_ HTML START HERE /_/_/_/_/_/_/_/_/_ -->
<body>
<!-- DIV MESSAGE BOX -->
	<script type="text/javascript" src="<?=base_url()?>system/scripts/notifyMessage.js"></script>	
<!-- END DIV MESSAGE BOX -->

<!-- /_/_/_/_/_/_/_/_/_ START PAGE HEADER /_/_/_/_/_/_/_/_/_-->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td id="page_header" width="100%"><?= lang($screenId . '_PAGE_HEADER') ?></td>
		<td>
			<img src="<?=base_url()?>system/images/icon/help.png" />
		</td>
		<td class="fontNormal" nowrap="nowrap">&nbsp;<?= lang('HELP') ?>&nbsp;</td>
	</tr>
</table>
<!-- END PAGE HEADER -->

<!-- /_/_/_/_/_/_/_/_/_ START DIV DETAIL /_/_/_/_/_/_/_/_/_-->

<div id="page_detail">

	<!-- START SEARCH CONDITION  -->
	<!-- END SEARCH CONDITION --> 

	<!-- START PAGE BUTTONS -->
	<!-- END PAGE BUTTONS --> 
	
	<!--  div class="line"><img src="<?=base_url()?>system/images/blank.gif" /></div-->

	<!-- START DIV RESULT  -->
	<div id="div_result" <?= ($show_result == FALSE)? "style='display: none;'" : ''?>>
	<?php 
		if($has_result == TRUE)
		{
	?>
		<!-- ********** START RESULT TABLE **********-->
		<div id="<?=$screenId?>_search"></div>	
		<div id="<?=$screenId?>"></div>

		<!-- END RESULT TABLE -->
	<?php 
		} 
		else
		{
	?>
		<!-- ********** START DATA NOT FOUND BLOCK **********-->
		<div id="div_empty"/>
		<!-- END DATA NOT FOUND BLOCK -->
	<?php 
		} 
	?>
	</div>
	<!-- END DIV RESULT  -->

</div>

<!-- END DIV DETAIL -->
</body>
</html>