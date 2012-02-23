
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "MT0131"; 
	$pkId = "delivery_code";
	
	//left array						
	$col = "delivery";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	${$col}[0]=array("name"=>"vendor_code","type"=>"string" ,"editor"=>"textFieldBlank,width:100");		
	${$col}[1]=array("name"=>"trader_name","type"=>"string" ,"editor"=>"textFieldBlank,width:250");		
	${$col}[2]=array("name"=>"delivery_code","type"=>"string" ,"editor"=>"textFieldBlank,width:100");		
	${$col}[3]=array("name"=>"delivery_name","type"=>"string" ,"editor"=>"textFieldBlank,width:100");		
	
	${$col}[4]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[5]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[6]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[8]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[9]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );								
	
	//right array CUSTOMER ITEM
	$col = "customer";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = 'id';
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"");
	${$col}[1]=array("name"=>"vendor_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selVendor");
	${$col}[2]=array("name"=>"delivery_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selDeli");
	
	${$col}[3]=array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:150","df"=>"" );
	
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

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldRead = rowEditTextField1(true,true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	
	
var venCodeField = formTextField1(true,false,'vendor_code','<?=lang('vendor_code')?>');		
var venNameField = formTextField1(true,false,'trader_name','<?=lang('trader_name')?>');		

<?php // item FORM
	 $cname = "item";
	 $pk = "item_code";
	 $fname = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = "../common/ITEM/getItemCodeList";
	 $editable = "true";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $mode = "remote";
	 $initParam ="";
	 
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{

}

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();
	var selVendor = "";
	var selDeli = "";
	
	// Search
	<?php 
		$gname = "delivery";
		$leftComp = "venCodeField";
		$rightComp = "venNameField";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	
	// ReadOnly Grid
	<?php 
		$gname = "delivery";
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
        obj["params"]["vendor_code"] = values['vendor_code'];
        obj["params"]["delivery_code"] = values['delivery_code'];
        selVendor = values['vendor_code'];
        selDeli = values['delivery_code'];
        
        customerDataStore.load(obj); // Update data
        customerEnableButton(false); // Enable Button

	}

	// Right Grid (Editable)
	<?php $gname = "customer"; ?>
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
	 	$leftWidth = 0.6;
	 	$rightWidth = 0.4;
	 	$leftComp = "delivery";
	 	$rightComp = "customer";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel2'.EXT);
	?>
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>