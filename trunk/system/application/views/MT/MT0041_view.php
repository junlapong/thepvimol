
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0041"; 
	$pkId = "item_code";
	
	$col = "item";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	//left array						
	${$col}[0]	=	array("name"=>	"item_code",	  "type"=>	"string" ,"editor"=>"textFieldBlank,width:150");		
	${$col}[1]	=	array("name"=>	"item_name",	  "type"=>	"string" ,"editor"=>"textFieldBlank,width:150");		
	${$col}[2]	=	array("name"=>	"item_short_name","type"=>	"string" ,"editor"=>"textFieldBlank,width:150");		
	
	${$col}[3]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[4]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[5]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[8]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );								
	
	//right array
	$col = "inventory";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = 'id';
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	//, hidden: true , hideable: false
	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"");						
	${$col}[1]=array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selItem" );						
	${$col}[2]=array("name"=>"location_code","type"=>"string","editor"=>"locaCombo,width:180","df"=>"" );						
	${$col}[3]=array("name"=>"location_name","type"=>"string","editor"=>"textFieldRead,width:180","df"=>"" );						
	
	${$col}[4]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[5]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[6]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[8]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[9]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
	include(APPPATH.'/views/common/h_include'.EXT);	
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
    
var locaProxy = new Ext.data.HttpProxy({
    api: {
    	read    : '<?=$screenId?>/getLocationList'
	},
	method: 'POST'
});

var locaStore = new Ext.data.JsonStore({
    root: 'data',
    idProperty: 'location_code',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: 'location_code'},{name: 'location_name'} ],
	autoLoad: false,
	proxy: locaProxy
});


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldRead = rowEditTextField1(true,true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	

var itemField = formTextField1(true,false,'item_code','<?=lang('item_code')?>');		

var locaCombo = new Object();		
locaCombo["xtype"] = 'combo';
locaCombo["displayField"] = 'location_name';
locaCombo["valueField"] = 'location_code';
locaCombo["hiddenName"] = 'location_code';
locaCombo["mode"] = 'local';
locaCombo["allowBlank"] = false;
locaCombo["typeAhead"] = true;
locaCombo["triggerAction"] = 'all';
locaCombo["store"] = locaStore;
locaCombo["selectOnFocus"] = true;
locaCombo["forceSelection"] = true;
locaCombo["minChars"] = 2;
locaCombo["editable"] = false;
locaCombo["listeners"] = {show:{fn:function(combo) {
	var leftGrid = griditem;
   	var rec = leftGrid.getSelectionModel().getSelected(); 
   	var values = rec.data;
	var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item_code"] = values['item_code'];
	    
	    locaStore.load(obj);
    }}
};

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

	var selItem = "";

	// Search
	<?php 
		$gname = "item";
		$leftComp = "itemField";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// ReadOnly Grid
	<?php 
		$gname = "item";
		$width = "auto";
		$height = "513";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		include_once(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["item_code"] = values['item_code'];
        selItem = values['item_code'];
        
        inventoryDataStore.load(obj); // Update data
        inventoryEnableButton(false); // Enable Button

	}

	// Right Grid (Editable)
	<?php $gname = "inventory"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	  		read    : '<?=${$gname."URL"}?>/viewDetail',  
	  		create  : '<?=${$gname."URL"}?>/createD',
	  		update  : '<?=${$gname."URL"}?>/updateD',
	  		destroy : '<?=${$gname."URL"}?>/destroyD'
	  	},
	  	method: 'POST'
	});  
	<?php 
		$width = "auto";
		$height = "513";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		$autoSave = "true";
		include(APPPATH.'/views/common/simpleGrid2'.EXT);
		include(APPPATH.'/views/common/simpleAddEvent1'.EXT);
		include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleInitialButton1'.EXT);
	?>
	<?=$gname?>EnableButton(true);
    

	// Final panel	
	<?php 
		$render = $screenId;
	 	$leftWidth = 0.5;
	 	$rightWidth = 0.5;
	 	$leftComp = "item";
	 	$rightComp = "inventory";
	 		
		include(APPPATH.'/views/common/simpleFinalPanel2'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>