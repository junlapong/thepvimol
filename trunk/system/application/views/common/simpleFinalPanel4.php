<?php 
	/*	Final Panel for Form Input with grid
	 *  Require Variable
	 *
	 *	$title = Title name (blank for ignore)
	 *  $panelItem = item in panel
	 *  $gname	= grid Name (blank for no grid)
	 *  $gname2	= grid Name (blank for no grid) (Option)
	 *  $fitem	= form Items
	 *  $render = Render to
	 */

?>
    var fp = new Ext.FormPanel({
    	<?php if ( $title != "") {?>
    	title: '<?=$title?>',
    	<?php }?>
        frame: true,
        labelWidth: 110,
		autowidth: true,
        renderTo:'<?=$render?>',
        bodyStyle: 'padding:0 10px 0;',
        
        items: [
                {
                	layout:'column',
                    border: false,
                    defaults: {columnWidth: '.5',border: false},   
                	items : <?=$fitem?>
                }
                <?php if($gname != "") {?>
                , grid<?=$gname?>
                <?php }?>
                <?php if( isset($gname2) && $gname2 != "") {?>
                , grid<?=$gname2?>
                <?php }?>
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
    	
        <?php if($gname != "") {?>
    	grid<?=$gname?>.setWidth(width-55);    		
    	grid<?=$gname?>.doLayout();
        <?php }?>
        <?php if( isset($gname2) && $gname2 != "") {?>
    	grid<?=$gname2?>.setWidth(width-55);    		
    	grid<?=$gname2?>.doLayout();
        <?php }?>

    	fp.doLayout();
    	
    }
    
    Ext.EventManager.onWindowResize(actionAfterEvent, fp); 
    actionAfterEvent();