
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	// Screen for update Inventory
	$screenId = "IV0000"; 
	//$rowLimit = 100;
	//$pkId = "id";
//include(APPPATH.'path/to/file'.EXT);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?= lang($screenId . '_PAGE_HEADER') ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- /_/_/_/_/_/_/_/_/_ START COMMON CSS /_/_/_/_/_/_/_/_/_-->
<link href="<?=base_url()?>system/styles/common.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>system/styles/ext-all.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>system/styles/RowEditor.css" rel="stylesheet" type="text/css" />

<!-- END COMMON CSS -->

<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<style>
.x-grid3-col {
    border-left:  1px solid #EEEEEE;
    border-right: 1px solid #D2D2D2;
}
 
.x-grid3-row td, .x-grid3-summary-row td {
    padding-left: 0px;
    padding-right: 0px;
}
</style>
<!-- END USER CSS -->

<!-- /_/_/_/_/_/_/_/_/_ START COMMON JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript" src="<?=base_url()?>system/scripts/common.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/ext-all.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/App.js"></script>
<script type="text/javascript" src="<?=base_url()?>system/scripts/ux-all.js"></script>
<!-- END COMMON JAVASCRIPT -->

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
// Define App tool for popup message
var App = new Ext.App({});

// JSON Define area

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();

    // FormPanel
    var fp = new Ext.FormPanel({
    	title: 'Update Current inventory qty',
        frame: true,
        labelWidth: 110,
		height: 150,
		width: 300,
        //autowidth: true,
        //collapsed: false,   
        //collapsible: true,
        renderTo:'<?=$screenId?>',
        bodyStyle: 'padding:0 10px 0;',
        items: [{
            xtype: 'button',
            id: 'basic-button',
            text: 'Update Inventory Current Qty',
            handler: function() {
              
          	  fp.form.submit({url:'IV0000/updateCurrentQty', 
              	  			  waitMsg:'Update Data...',
                  	  		  success:  function(f,a) {
                  						Ext.Msg.alert('Success', 'finish');
              							},
              				  failure:  function(f,a) {
                						Ext.Msg.alert('Warning', 'Error');
              							}
                  	  		   });
        	}
        }
        ]
        
    });
    function actionAfterEvent(){
    	fp.doLayout();
    }
    
    Ext.EventManager.onWindowResize(actionAfterEvent, grid); 
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
	<?php 
		$show_result = true; // First Load Search
		$has_result = true;  // Search result
	?>
	<div id="div_result" <?= ($show_result == FALSE)? "style='display: none;'" : ''?>>
	<?php 
		if($has_result == TRUE)
		{
	?>
		<!-- ********** START RESULT TABLE **********-->

		<!-- div id="<?=$screenId?>_search"></div-->	
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