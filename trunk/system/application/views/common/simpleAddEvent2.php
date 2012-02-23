<?php 
	/*  Add Button with no Auto save
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
    function addEvent<?=$gname?>(btn,ev){
        var u = new <?=$gname?>DataStore.recordType({
            <?php
		        for($i=0; $i < count(${$gname}) ; $i++){
		            if($i != 0) echo ",";
		            echo ${$gname}[$i]["name"] . ": ";
		        		            if( ${$gname}[$i]["type"] == "number" )
		            {
		            	echo "'0'";
		            }
		            else
		            {
		            	if( (strpos(${$gname}[$i]["df"],'*DF*') !== false) )
		            	{
		            		echo str_replace("*DF*", "", ${$gname}[$i]["df"]);	
		            	}
		            	else
		            	{
		            		echo "'" . ${$gname}[$i]["df"] . "'";
		            	}
		            }
		        }
		    ?>
       });
       addClick = true;
        <?=${$gname."Editor"}?>.stopEditing();
        <?=$gname?>DataStore.insert(0, u);
        grid<?=$gname?>.getView().refresh();
        <?=${$gname."Editor"}?>.startEditing(0,1);
    }