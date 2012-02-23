<?php 
	/*
	 *  Require Variable
	 *
	 *  $render = Render to
	 *  $leftWidth = left width 0.1
	 *  $rightWidth = right width 0.9
	 *  $leftComp = Left Component
	 *  $rightComp = Right Component
	 */

?>
   // Final Panel
    var fp1 = new Ext.FormPanel({
    	<?php if ( $title != "") {?>
    	title: '<?=$title?>',
    	<?php }else{?>
    	title: 'แสดงรายการของที่ต้องสั่งซื้อ / หมายเลข PR',
    	<?php }?>
        frame: true,
        labelWidth: 110,
		autowidth: true,
        collapsed: false,   
        collapsible: true,
        renderTo:'<?=$render?>',
        bodyStyle: 'padding:0 10px 0;',
        layout: 'column',    // Specifies that the items will now be arranged in columns

        items: [
        	{
	            columnWidth: <?=$leftWidth?>,
	            layout: 'fit',
	            items: grid<?=$leftComp?>
	        },
        	{
            	columnWidth: <?=$rightWidth?>,
	            layout: 'fit',
	            items: grid<?=$rightComp?>
        	}
        ]
    });		
    
    function actionAfterEventForm(){
    	
    	var width = 0;
    	var main = window.top.document.getElementById("mainFrame");;
    	if(typeof main.width != 'undefined')
    		width = main.width;
    	else{
    		if( main.clientWidth ) width = main.clientWidth;
    		if( main.offsetWidth ) width = main.offsetWidth;
    	}
    	   	
    	if(typeof searchPanel != 'undefined')
    		searchPanel.setWidth(width-25);

    	grid<?=$leftComp?>.setWidth((width-55)*<?=$leftWidth?>);    		
    	grid<?=$rightComp?>.setWidth((width-55)*<?=$rightWidth?>);    		

    	grid<?=$leftComp?>.doLayout();
    	grid<?=$rightComp?>.doLayout();
    	fp1.doLayout();
    	
    }
    
    Ext.EventManager.onWindowResize(actionAfterEventForm, fp1); 
    actionAfterEventForm();