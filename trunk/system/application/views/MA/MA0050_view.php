
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MA0050"; 
	$pkId = "username";
	
	$col = "ur";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	//left array						
	${$col}[0]	=	array("name"=>	"username","type"=>	"string" ,"editor"=>"textFieldBlank,width:150");										
	
	${$col}[1]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[2]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[3]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[4]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[5]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[6]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
		
	//right array
	$col = "urmenu";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = 'id';
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"");						
	${$col}[1]=array("name"=>"username","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selUser" );						
	${$col}[2]=array("name"=>"menu_code","type"=>"string","editor"=>"menuCombo,width:150","df"=>"" );						
	${$col}[3]=array("name"=>"permission","type"=>"number","editor"=>"textFieldBlank,width:150","df"=>"15" );		
					
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
var groupProxy = new Ext.data.HttpProxy({
    api: {
    	read    : '<?=$screenId?>/getGroupList'
	},
	method: 'POST'
});

var groupStore = new Ext.data.JsonStore({
    root: 'data',
    idProperty: 'menu_code',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: 'menu_code'}],
	autoLoad: false,
	proxy: groupProxy
});
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	

var userField = formTextField1(true,false,'username','<?=lang('username')?>');	

var menuCombo = new Object();		
menuCombo["xtype"] = 'combo';
menuCombo["displayField"] = 'menu_code';
menuCombo["valueField"] = 'menu_code';
menuCombo["mode"] = 'local';
menuCombo["allowBlank"] = false;
menuCombo["typeAhead"] = true;
menuCombo["triggerAction"] = 'all';
menuCombo["store"] = groupStore;
menuCombo["selectOnFocus"] = true;
menuCombo["forceSelection"] = true;
menuCombo["minChars"] = 2;
menuCombo["editable"] = false;
menuCombo["listeners"] = {show:{fn:function(combo) {
	var leftGrid = gridur;
   	var rec = leftGrid.getSelectionModel().getSelected(); 
   	var values = rec.data;
	var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["username"] = values['username'];
	    
		groupStore.load(obj);
    }}
};
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

	var selUser = "";

	// Search
	<?php 
		$gname = "ur";
		$leftComp = "userField";
		$rightComp = "";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// ReadOnly Grid
	<?php 
		$gname = "ur";
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
        obj["params"]["username"] = values['username'];
        selUser = values['username'];
        
        urmenuDataStore.load(obj); // Update data
        urmenuEnableButton(false); // Enable Button

	}

	// Right Grid (Editable)
	<?php $gname = "urmenu"; ?>
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
	 	$leftWidth = 0.2;
	 	$rightWidth = 0.8;
	 	$leftComp = "ur";
	 	$rightComp = "urmenu";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel2'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>