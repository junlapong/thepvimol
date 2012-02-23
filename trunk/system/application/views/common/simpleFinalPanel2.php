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
    var fp = new Ext.FormPanel({
    	title: 'Results',
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
    
    function actionAfterEvent(){
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
    	fp.doLayout();
    	
    }
    
    Ext.EventManager.onWindowResize(actionAfterEvent, fp); 
    actionAfterEvent();