
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0090"; 
	$pkId = "id";
	
	//left array
	$col = "item";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
						
	${$col}[0]	=	array("name"=>	"item_code"	,"type"=>	"string","editor"=>"textFieldBlank,width:100","df"=>""  );						
	${$col}[1]	=	array("name"=>	"qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						

	${$col}[2]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[3]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[4]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[5]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[7]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	
	//right array
	$col = "location";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"location_code"	,"type"=>	"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[1]	=	array("name"=>	"location_name"	,"type"=>	"string","editor"=>"textFieldBlank,width:100","df"=>"" );						
	${$col}[2]	=	array("name"=>	"qty"	,"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );

	${$col}[3]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[4]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[5]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[8]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	
	
	//right array
	$col = "lotNo";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"id",		"type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[1]	=	array("name"=>	"item_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selItem" );						
	${$col}[2]	=	array("name"=>	"location_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selLoca" );						
	${$col}[3]	=	array("name"=>	"lot_no",	"type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[4]	=	array("name"=>	"seq_no",	"type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[5]	=	array("name"=>	"qty"	,	"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[6]	=	array("name"=>	"new_qty",	"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	
	${$col}[7] =array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[8] =array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[9] =array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[10]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[11]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[12]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	

	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();

    // After updated do sth.
	Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
        var obj = new Object();		
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
 
        lotNoDataStore.autoSave = false;
    	itemDataStore.reload(obj);
    	locationDataStore.removeAll();
        lotNoDataStore.removeAll(true);
        lotNoDataStore.removeAll();
        gridlotNo.removeAll();
    });
    var selItem = "";
    var selLoca = "";
    
	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//Component define area  
	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//Row Editor Components vvv
	var textFieldBlank = rowEditTextField1(true);		
	var textFieldNBlank = rowEditTextField1(false);
	var numFieldBlank = rowEditNumField1(true);	
	
	
	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//             Start Grid Area  
	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

	// ReadOnly Grid
	<?php 
		$gname = "item";
		$width = "auto";
		$height = "513";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        selItem = values['item_code'];
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
        obj["params"]["item_code"] = selItem;
        
        locationDataStore.load(obj); // Update data
        lotNoDataStore.autoSave = false;
        lotNoDataStore.removeAll(true);
        lotNoDataStore.removeAll();
        gridlotNo.removeAll();
	}
	
	// ReadOnly Grid
	<?php 
		$gname = "location";
		$width = "auto";
		$height = "513";
		$initialLoad = false;
		$view = "viewLocation";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        selLoca = values['location_code'];
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
        obj["params"]["item_code"] = selItem;
        obj["params"]["location_code"] = selLoca;
        
        lotNoDataStore.load(obj); // Update data
        lotNoEnableButton(false);
        lotNoDataStore.autoSave = true;
        
	}
	
	// Right Grid (Editable)
	<?php $gname = "lotNo"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	  		read    : '<?=${$gname."URL"}?>/viewLot',  
	  		create  : '<?=${$gname."URL"}?>/createInitialLot',
	  		update  : '<?=${$gname."URL"}?>/updateLotQty',
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
	 	$leftWidth = 0.3;
	 	$centerWidth = 0.3;
	 	$rightWidth = 0.4;
	 	$leftComp = "item";
	 	$centerComp = "location";
	 	$rightComp = "lotNo";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel5'.EXT);
	?>
	
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>