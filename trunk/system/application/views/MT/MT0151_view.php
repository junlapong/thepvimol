
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0151"; 
	$pkId = "sale_code";
	
	$col = "sale";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	//left array						
	${$col}[0]	=	array("name"=>	"sale_code","type"=>	"string" ,"editor"=>"textFieldBlank,width:80");		
	${$col}[1]	=	array("name"=>	"firstname","type"=>	"string" ,"editor"=>"textFieldBlank,width:80");		
	${$col}[2]	=	array("name"=>	"lastname","type"=>	"string" ,"editor"=>"textFieldBlank,width:80");		
	${$col}[3]	=	array("name"=>	"nickname","type"=>	"string" ,"editor"=>"textFieldBlank,width:50");		
	
	${$col}[4]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[5]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[6]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[8]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[9]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );								
	
	//right array
	$col = "saleCus";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = 'id';
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	//, hidden: true , hideable: false
	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"");						
	${$col}[1]=array("name"=>"sale_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selItem" );						
	${$col}[2]=array("name"=>"vendor_code","type"=>"string","editor"=>"locaCombo,width:180","df"=>"" );						
	${$col}[3]=array("name"=>"trader_name","type"=>"string","editor"=>"textFieldRead,width:180","df"=>"" );						
	
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
    idProperty: 'vendor_code',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: 'vendor_code'},{name: 'trader_name'} ],
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

var itemField = formTextField1(true,false,'sale_code','<?=lang('sale_code')?>');		

var locaCombo = new Object();		
locaCombo["xtype"] = 'combo';
locaCombo["displayField"] = 'trader_name';
locaCombo["valueField"] = 'vendor_code';
locaCombo["hiddenName"] = 'vendor_code';
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
	var leftGrid = gridsale;
   	var rec = leftGrid.getSelectionModel().getSelected(); 
   	var values = rec.data;
	var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["sale_code"] = values['sale_code'];
	    
	    locaStore.load(obj);
    }}
};

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

	var selItem = "";

	// Search
	<?php 
		$gname = "sale";
		$leftComp = "itemField";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// ReadOnly Grid
	<?php 
		$gname = "sale";
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
        obj["params"]["sale_code"] = values['sale_code'];
        selItem = values['sale_code'];
        
        saleCusDataStore.load(obj); // Update data
        saleCusEnableButton(false); // Enable Button

	}

	// Right Grid (Editable)
	<?php $gname = "saleCus"; ?>
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
	 	$leftComp = "sale";
	 	$rightComp = "saleCus";
	 		
		include(APPPATH.'/views/common/simpleFinalPanel2'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>