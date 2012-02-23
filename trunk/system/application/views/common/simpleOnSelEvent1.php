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
	var selRow = 0;
    function onSelectEvent<?=$gname?>(sm,row,rec)
    {
		var values = rec.data;
        var field, id;
        var obj = new Object();

        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
        //if ( values['item_code'] == "" )
        //    return;
        obj["params"]["item_code"] = values['item_code'];
		selRow = row;
    	//RootChange(values['item_code']);
    	//selItem = values['item_code'];
    	
	    //<?=$gname?>DataStore.load(obj);     
    }