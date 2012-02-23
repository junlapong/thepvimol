
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0800"; 
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
	$col = "balance";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"ri_no"	,"type"=>	"string"	,"editor"=>"textFieldBlank,width:80","df"=>"" );						
//	${$col}[1]	=	array("name"=>	"item_code"	,"type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );
//	${$col}[2]	=	array("name"=>	"location_code"	,"type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[1]	=	array("name"=>	"ri_date"	,"type"=>	"datetime","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[2]	=	array("name"=>	"received_qty"	,"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[3]	=	array("name"=>	"issue_qty"	,"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[4]	=	array("name"=>	"balance_qty"	,"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	
	${$col}[5]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[6]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[7]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[8]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[9]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[10]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	
	
	//right array
	$col = "lot";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"lot_no","type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
//	${$col}[1]	=	array("name"=>	"seq_no","type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[1]	=	array("name"=>	"qty"	,"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );

	${$col}[2]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[3]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[4]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[5]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[7]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	

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
        obj["params"]["location_code"] = "K%";//selLoca;
        
        //locationDataStore.load(obj); // Update data
        lotDataStore.removeAll();
        lotDataStore.load(obj);
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
		var values = rec.data;
        var field, id;
        selLoca = values['lot_no'];
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
        obj["params"]["item_code"] = selItem;
        obj["params"]["lot_no"] = selLoca;
        
        balanceDataStore.load(obj); // Update data
	}
	
	// ReadOnly Grid
	<?php 
		$gname = "balance";
		$width = "auto";
		$height = "513";
		$initialLoad = false;
		$view = "viewBalance";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){


	}
	
	// Final panel	
	<?php 
		$render = $screenId;
	 	$leftWidth = 0.25;
	 	$centerWidth = 0.25;
	 	$rightWidth = 0.5;
	 	$leftComp = "item";
	 	$centerComp = "lot";
	 	$rightComp = "balance";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel5'.EXT);
	?>
	
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>