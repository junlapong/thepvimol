<?php 
	/*
	 *  Require Variable
	 *  ${$gname} = Configuration Array (eg. Header name, etc.)
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
    function deleteEvent<?=$gname?>(btn,ev){
    	<?=${$gname."Editor"}?>.stopEditing(); 
        var s = grid<?=$gname?>.getSelectionModel().getSelections();  

        for(var i = 0, r; r = s[i]; i++){  
        	<?=$gname?>DataStore.remove(r);  
        }
        grid<?=$gname?>.getView().refresh();
    }