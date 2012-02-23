
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0041"; 
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
	$col = "lot";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"lot_no","type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[1]	=	array("name"=>	"seq_no","type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[2]	=	array("name"=>	"qty"	,"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );

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
        lotDataStore.removeAll();
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
        
        lotDataStore.load(obj); // Update data

	}
	
	// ReadOnly Grid
	<?php 
		$gname = "lot";
		$width = "auto";
		$height = "513";
		$initialLoad = false;
		$view = "viewLot";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){


	}
	

	// Final panel	
	<?php 
		$render = $screenId;
	 	$leftWidth = 0.3;
	 	$centerWidth = 0.3;
	 	$rightWidth = 0.4;
	 	$leftComp = "item";
	 	$centerComp = "location";
	 	$rightComp = "lot";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel5'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>