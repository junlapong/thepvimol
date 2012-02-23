<?php 
	/*	Final Panel for Form Input with grid
	 *  Base on FinalPanel 3
	 *  Require Variable
	 *
	 *	$title = Title name (blank for ignore)
	 *  $panelItem = item in panel
	 *  $gname	= grid Name (blank for no grid)
	 *  $fitem	= form Items
	 *  $render = Render to
	 */

?>
    var fp = new Ext.FormPanel({
    	<?php if ( $title != "") {?>
    	title: '<?=$title?>',
    	<?php }?>
        frame: true,
        labelWidth: 150,
		autowidth: true,
        renderTo:'<?=$render?>',
        bodyStyle: 'padding:0 10px 0;',
        
        
        items: [
                {
                	layout:'column',
                    border: false,
                    defaults: {columnWidth: '.5',border: false},   
                	items : <?=$fitem?>
                },
				{
					layout:'column',
					items : [
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
			            
	        	}
        ]
<?php
        if(($permCode & 0x8) > 0 ) // can create or not
        	echo ", buttons: [ {text   : 'Update',
        						id: 'UpdateAction".$gname."' ,
        						handler: function() { updateEvent(); } } ]";
?>
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