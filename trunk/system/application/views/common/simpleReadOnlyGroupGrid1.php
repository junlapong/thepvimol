<?php 
	/*
	 * 	ReadOnly Grid and have *** multiple header ***
	 *  Require Variable
	 *  ${$gname} = Configuration Array (eg. Header name, etc.)
	 *  $gname = Grid Name
	 *  $view = JSON view function
	 *  $title = title of Grid
	 *  ${$gname."URL"} = JSON URL
	 *  ${$gname."PK"} = PK
	 *  ${$gname."Render"} = Render area
	 *  $width = Grid Height
	 *  $height = Grid width
	 *  $initialLoad = default load data? true = yes ; false = no
	 *  $enableCollapse = Can Collapse? true = yes ; false = no
	 *  $groupField = Field for grouping
	 */

?>
//_/_/__/_/__/_/__/_/_  Field for DAO Define area _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>Record = new Ext.data.Record.create([
<?php 
	// Print out {name: 'colname', type: 'string'}	
	for($i=0; $i < count(${$gname}) ; $i++){
		if($i != 0) echo ",";
	   	echo "{name: '" . ${$gname}[$i]["name"] . "',type: '" . ${$gname}[$i]["type"] . "'}";
	}
?>
    ]);
    
//_/_/__/_/__/_/__/_/_  JSON Main Define area _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>DataStore = new Ext.data.GroupingStore({
<?php 
	if( isset($view) && $view != "" )
	{
		echo "url    : '".${$gname."URL"}."/".$view."',";
	}else{
		echo "url    : '".${$gname."URL"}."/view',";
	}

?>	
	reader: new Ext.data.JsonReader({ // <-- fixed
		id: '<?=${$gname."PK"}?>',
		totalProperty: 'total',
		root: 'data',
		fields: <?=$gname?>Record,
	}),

	name: '<?=$gname?>Datastore',
    groupField:'<?=$groupField?>'
    
});
<?php 
	if($initialLoad)    
		echo $gname."DataStore.load({params: {start: 0, limit: pageLimit} });";
?>
//_/_/__/_/__/_/__/_/_  Grid Header Define _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>ColumnModel = new Ext.ux.grid.LockingColumnModel({
	// specify any defaults for each column
	defaults: {sortable: true},
	columns: [
				// new Ext.grid.RowNumberer(),
				<?php 
				// Print out {header: '<?=lang("menu_code")?\>',dataIndex: 'menu_code',editor: {xtype: 'textfield', allowBlank: false }}	
				for($i=0; $i < count(${$gname}) ; $i++){
					if($i != 0) echo ",";
					
					if( ${$gname}[$i]["type"] == "bool" ){
						echo "new Ext.grid.CheckColumn({";
					}else{
						echo "{";
					}	
					
					if( $screenId == "PP0061" && ${$gname}[$i]["name"] == "order_qty"){
						echo "header: '" . lang("job_qty") . "'";
					}else{
						echo "header: '" . lang(${$gname}[$i]["name"]) . "'";
					}
					echo ",dataIndex: '" . ${$gname}[$i]["name"] . "'";
					
					if( ${$gname}[$i]["editor"] != "" ) echo ",editor: " . ${$gname}[$i]["editor"];
					if( (strpos(${$gname}[$i]["name"],'qty') !== false) ) echo ",renderer: num_rend,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'physical_unit') !== false) ) echo ",renderer: num_rend8d,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'ratio') !== false) ) echo ",renderer: num_rend5d,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'safty_stock') !== false) ) echo ",renderer: num_rend,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'order_status') !== false) ) echo ",renderer: order_status,align:'left'";
					
					//if( $i >= count(${$gname}) - 6)    echo ",hidden: true";

					if( ${$gname}[$i]["type"] == "bool" ){
					    echo "})";
					}else{
						echo "}";
					}
				}
				?>
         ]

});


var elementWidth = (window.screen.width < 800) ? 800 : window.screen.width-295;
var grid<?=$gname?> = new Ext.grid.GridPanel({
	<?php 
		if($title != "")
		{
			echo "title : '".$title."',";
		}
	?>
	//id: '<?=$gname?>Grid',
	<?php 
		if(${$gname."Render"} != "none")
		{
			echo "renderTo: '".${$gname."Render"}."',";			
		}
	?>
	store: <?=$gname?>DataStore,
	colModel: <?=$gname?>ColumnModel,
	<?php 
		if($width == "auto")
			echo "width: elementWidth,";
		else
			echo "width: ".$width.",";
	?>
	<?php 
		if($height == "auto")
			echo "autoHeight: true,";
		else
			echo "height: ".$height.",";
	?>
	enableColumnMove: true,
	frame: true,
	autoScroll: true,
	<?php 
		if($enableCollapse)
		{
			echo "collapsed: false,";
			echo "collapsible: true,";
		}
	?>
	
	view: new Ext.grid.GroupingView({
            forceFit:true,
            groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})'
        }),
	
	
	sm: new Ext.grid.RowSelectionModel({
            singleSelect: true,
            listeners: {
                rowselect: function(sm, row, rec) { onSelectEvent<?=$gname?>(sm,row,rec); }
            }
	}),
	
	bbar: new Ext.PagingToolbar({
		pageSize:pageLimit,
		store: <?=$gname?>DataStore,
		displayInfo: true,
		displayMsg: 'Displaying Data {0} - {1} of {2}',
		emptyMsg: "No Data found"
	})
	,tbar : []
});    
var exportButton = new Ext.ux.Exporter.Button({
  component: grid<?=$gname?>,
  text     : "Download as .xls"
});
//Add download button to the top grid toolbar
grid<?=$gname?>.getTopToolbar().add(exportButton);
