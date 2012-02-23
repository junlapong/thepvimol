<?php 
	/*
	 *  Require Variable ( Support Only 1 Check Box )
	 *  ${$gname} = Configuration Array (eg. Header name, etc.)
	 *  $gname = Grid Name
	 *  $title = title of Grid
	 *  ${$gname."URL"} = JSON URL
	 *  ${$gname."PK"} = PK
	 *  ${$gname."Render"} = Render area
	 *  $width = Grid Height
	 *  $height = Grid width
	 *  $initialLoad = default load data? true = yes ; false = no
	 *  $enableCollapse = Can Collapse? true = yes ; false = no
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

//_/_/__/_/__/_/__/_/_  JSON Proxy Define area _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	api: {
		read    : '<?=${$gname."URL"}?>/view',
		create  : '<?=${$gname."URL"}?>/create',
		update  : '<?=${$gname."URL"}?>/update',
		destroy : '<?=${$gname."URL"}?>/destroy'
	},
	timeout: 90000,
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
	writer: <?=$gname?>Writer,
    proxy: <?=$gname?>Proxy,
    autoSave: false
});
<?php 
	if($initialLoad)    
		echo $gname."DataStore.load({params: {start: 0, limit: pageLimit} });";
?>

<?php for($i=0; $i < count(${$gname}) ; $i++){ ?>
<?php if( ${$gname}[$i]["editor"] == "editCheckBox" ){?>
var editCheckBox = new Ext.grid.CheckColumn({
						header: '<?=lang(${$gname}[$i]["name"])?>'
						,dataIndex: '<?=${$gname}[$i]["name"]?>'
						,width: 55
					});
<?php }?>
<?php }?>

//_/_/__/_/__/_/__/_/_  Grid Header Define _/_/__/_/__/_/__/_/__/_/__/_/_
var <?=$gname?>ColumnModel = new Ext.ux.grid.LockingColumnModel({
	// specify any defaults for each column
	defaults: {sortable: true},
	columns: [
				new Ext.grid.RowNumberer(),
				<?php 
				$isEditCheckBox = false;
				// Print out {header: '<?=lang("menu_code")?\>',dataIndex: 'menu_code',editor: {xtype: 'textfield', allowBlank: false }}	
				for($i=0; $i < count(${$gname}) ; $i++){
					if($i != 0) echo ",";
					
					if( ${$gname}[$i]["editor"] == "editCheckBox" ){
						echo "editCheckBox";
						$isEditCheckBox = true;
						continue;
					}
					
					if( ${$gname}[$i]["type"] == "bool" ){
						echo "new Ext.grid.CheckColumn({";
					}else{
						echo "{";
					}	
					
					if( $screenId == "PP0060" && ${$gname}[$i]["name"] == "order_qty"){
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
					
					if( $i >= count(${$gname}) - 6)    echo ",hidden: true";

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
var grid<?=$gname?> = new Ext.grid.EditorGridPanel({
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
	<?php 
		// Hide if permission is not allow to update
		if($isEditCheckBox ){
			echo "plugins: [editCheckBox],";
		}
	?>
	view: new Ext.ux.grid.LockingGridView(),
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
