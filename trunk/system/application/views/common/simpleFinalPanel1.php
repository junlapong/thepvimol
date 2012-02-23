<?php 
	/*
	 *  Require Variable
	 *
	 *  $panelItem = item in panel
	 *  $gname	= grid Name
	 *  $render = Render to
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
        items: [
                <?php 
                	if( isset($fpanel) && $fpanel != "") {
                		echo  $fpanel . ",";
                	}
                ?>
                
        	grid<?=$gname?>
        	
        	<?php 
        		if($panelItem != "" )
	            	echo "," . $panelItem;
	         ?>
                <?php if( isset($gname2) && $gname2 != "") {?>
                , grid<?=$gname2?>
                <?php }?>
                <?php if( isset($gname3) && $gname3 != "") {?>
                , grid<?=$gname3?>
                <?php }?>
                <?php if( isset($gname4) && $gname4 != "") {?>
                , grid<?=$gname4?>
                <?php }?>

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
    	
    	grid<?=$gname?>.setWidth(width-55);    		
    	grid<?=$gname?>.doLayout();
        <?php if( isset($gname2) && $gname2 != "") {?>
    	grid<?=$gname2?>.setWidth(width-55);    		
    	grid<?=$gname2?>.doLayout();
        <?php }?>
        
        <?php if( isset($gname3) && $gname3 != "") {?>
    	grid<?=$gname3?>.setWidth(width-55);    		
    	grid<?=$gname3?>.doLayout();
        <?php }?>
        <?php if( isset($gname4) && $gname4 != "") {?>
    	grid<?=$gname4?>.setWidth(width-55);    		
    	grid<?=$gname4?>.doLayout();
        <?php }?>        
    	fp.doLayout();
    	
    }
    
    Ext.EventManager.onWindowResize(actionAfterEvent, fp); 
    actionAfterEvent();