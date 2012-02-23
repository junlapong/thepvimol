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
//_/_/__/_/__/_/__/_/_  Editor Name Define area _/_/__/_/__/_/__/_/__/_/__/_/_
var addClick = false;
var isEdit = false;
var <?=${$gname."Editor"}?> = new Ext.ux.grid.RowEditor({ saveText: 'Update' });
    <?=${$gname."Editor"}?>.on(
		'canceledit',function(roweditor, forced){
			if(addClick){
				addClick = false;
				grid<?=$gname?>.getStore().removeAt(0); 
				<?=${$gname."Editor"}?>.startEditing(0);
				<?=${$gname."Editor"}?>.stopEditing();
			}
			isEdit = false;
			
		}
		,this
	);
	
    <?=${$gname."Editor"}?>.on( 'beforeedit',function(roweditor, forced){ isEdit = true; },this);
    <?=${$gname."Editor"}?>.on( 'afteredit',function(roweditor, forced){ isEdit = false; addClick = false; },this);



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

//_/_/__/_/__/_/__/_/_  JSON Proxy Define area _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	api: {
		read    : '<?=${$gname."URL"}?>/view',
		create  : '<?=${$gname."URL"}?>/create',
		update  : '<?=${$gname."URL"}?>/update',
		destroy : '<?=${$gname."URL"}?>/destroy'
	},
	method: 'POST'
});

//_/_/__/_/__/_/__/_/_  JSON Writer Define area _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>Writer = new Ext.data.JsonWriter({
    encode: true,
    writeAllFields: false
});
    
//_/_/__/_/__/_/__/_/_  JSON Main Define area _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>DataStore = new Ext.data.JsonStore({
	name: '<?=$gname?>Datastore',
    root: 'data',
    idProperty: '<?=${$gname."PK"}?>',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: <?=$gname?>Record,
    proxy: <?=$gname?>Proxy,
    writer: <?=$gname?>Writer,
    autoSave: true 
});
<?php 
	if($initialLoad)    
		echo $gname."DataStore.load({params: {start: 0, limit: pageLimit} });";
?>
//_/_/__/_/__/_/__/_/_  Grid Header Define _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>ColumnModel = new Ext.grid.ColumnModel({
	// specify any defaults for each column
	defaults: {sortable: true},
	columns: [
				new Ext.grid.RowNumberer(),
				<?php 
				// Print out {header: '<?=lang("menu_code")?\>',dataIndex: 'menu_code',editor: {xtype: 'textfield', allowBlank: false }}	
				for($i=0; $i < count(${$gname}) ; $i++){
					if($i != 0) echo ",";
					echo "{header: '" . lang(${$gname}[$i]["name"]) . "'";
					echo ",dataIndex: '" . ${$gname}[$i]["name"] . "'";
					if(${$gname}[$i]["editor"] != "") echo ",editor: " . ${$gname}[$i]["editor"];
					if( (strpos(${$gname}[$i]["name"],'qty') !== false) ) echo ",renderer: num_rend,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'physical_unit') !== false) ) echo ",renderer: num_rend8d,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'ratio') !== false) ) echo ",renderer: num_rend5d,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'safty_stock') !== false) ) echo ",renderer: num_rend,align:'right'";
					if( (strpos(${$gname}[$i]["name"],'order_status') !== false) ) echo ",renderer: order_status,align:'left'";
					
					if( $i >= count(${$gname}) - 6)    echo ",hidden: true";
					echo "}";
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
	cm: <?=$gname?>ColumnModel,
	store: <?=$gname?>DataStore,
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

	<?php 
		// Hide if permission is not allow to update
		if(($permCode & 0x2) > 0 ){
			echo "plugins: [".${$gname."Editor"}."],";
		}
	?>
	<?php
		// Check permission for Create and Delete
		if(($permCode & 0x9) > 0 ){
			echo "tbar: [";			
			//Check permission for Create
			if(($permCode & 0x8) > 0 ){
				echo "{
				text : 'Add',
				iconCls: 'silk-add',	
				itemId: 'addAction".$gname."',	
				handler: function(btn, ev) { addEvent".$gname."(btn,ev); }	
				},";
			}
			
			//Check permission for Delete
			if(($permCode & 0x1) > 0 ){
				echo "'-',{
				text : 'Delete',
				iconCls: 'silk-delete',	
				itemId: 'deleteAction".$gname."',	
				handler: function(btn, ev) { deleteEvent".$gname."(btn,ev); }	
				},";
			}
			
			echo "'-' ],";
		}
	?>
	viewConfig: {},//forceFit: true 
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
});    
