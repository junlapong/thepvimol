
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0042"; 
	$pkId = "item_code";
	
	$col = "location";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	//left array						
	${$col}[0]	=	array("name"=>	"location_code",	  "type"=>	"string" ,"editor"=>"textFieldBlank,width:150");		
	${$col}[1]	=	array("name"=>	"location_name",	  "type"=>	"string" ,"editor"=>"textFieldBlank,width:150");		
	
	${$col}[2]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[3]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[4]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[5]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[7]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );								
	
	//right array
	$col = "inventory";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = 'id';
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	//, hidden: true , hideable: false
	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"");						
	${$col}[1]=array("name"=>"location_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selItem" );						
	${$col}[2]=array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:180","df"=>"" );						
	
	${$col}[3]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[4]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[5]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[8]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
	include(APPPATH.'/views/common/h_include'.EXT);	
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
var itemProxy = new Ext.data.HttpProxy({
    api: {
    	read    : '<?=$screenId?>/getLocationList'
	},
	method: 'POST'
});

var itemStore = new Ext.data.JsonStore({
    root: 'data',
    idProperty: 'item_code',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: 'item_code'},{name: 'item_code'} ],
	autoLoad: false,
	proxy: itemProxy
});


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldRead = rowEditTextField1(true,true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	

var locaField = formTextField1(true,false,'location_code','<?=lang('location_code')?>');		

var itemCombo = new Object();		
itemCombo["xtype"] = 'combo';
itemCombo["displayField"] = 'item_code';
itemCombo["valueField"] = 'item_code';
itemCombo["hiddenName"] = 'item_code';
itemCombo["mode"] = 'local';
itemCombo["allowBlank"] = false;
itemCombo["typeAhead"] = true;
itemCombo["triggerAction"] = 'all';
itemCombo["store"] = itemStore;
itemCombo["selectOnFocus"] = true;
itemCombo["forceSelection"] = true;
itemCombo["minChars"] = 2;
itemCombo["editable"] = false;
itemCombo["listeners"] = {show:{fn:function(combo) {
	var leftGrid = gridlocation;
   	var rec = leftGrid.getSelectionModel().getSelected(); 
   	var values = rec.data;
	var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["location_code"] = values['location_code'];
	    
	    itemStore.load(obj);
    }}
};

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

	var selItem = "";

	// Search
	<?php 
		$gname = "location";
		$leftComp = "locaField";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// ReadOnly Grid
	<?php 
		$gname = "location";
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
        obj["params"]["location_code"] = values['location_code'];
        selItem = values['location_code'];
        
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
	 	$leftComp = "location";
	 	$rightComp = "inventory";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel2'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>