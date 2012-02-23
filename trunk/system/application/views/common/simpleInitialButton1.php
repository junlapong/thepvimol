<?php 
	/*  Add Button with no Auto save
	 *  Require Variable
	 *  $gname = Grid Name
	 *  ${$gname."URL"} = JSON URL
	 *  ${$gname."PK"} = PK
	 *  ${$gname."Render"} = Render area
	 *  ${$gname."Editor"} = EditorName
	 *  $width = Grid Height
	 *  $height = Grid width
	 *  $initialLoad = default load data? true = yes ; false = no
	 *  $enableCollapse = Can Collapse? true = yes ; false = no
	 */

?>
	function <?=$gname?>EnableButton(flag)
	{
	   	<?php if(($permCode & 0x9) > 0 ){ ?>
		   	var top = grid<?=$gname?>.getTopToolbar();
		   	<?php if(($permCode & 0x8) > 0 ) {?>
	   			top.getComponent('addAction<?=$gname?>').setDisabled(flag);   
		   	<?php } ?>
	   		<?php if(($permCode & 0x1) > 0 ) {?>
	   			top.getComponent('deleteAction<?=$gname?>').setDisabled(flag);
		   	<?php } ?>
	   	<?php } ?>
    }