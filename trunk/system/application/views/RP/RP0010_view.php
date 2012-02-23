
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "RP0010";
	$pkId = "id";
	
	$col = "pResult";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]=array("name"=>"customer_name","type"=>"string","editor"=>"textFieldBlank,width:100,hidden: true","df"=>"" );			
	${$col}[1]=array("name"=>"customer_deli","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );			
	${$col}[2]=array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:120" ,"df"=>"" );
	${$col}[3]=array("name"=>"order_qty","type"=>"string","editor"=>"textFieldBlank,width:80" ,"df"=>"" );
	${$col}[4]=array("name"=>"delivery_date","type"=>"datetime","editor"=>"textFieldBlank,width:55" ,"df"=>"0" );	
	${$col}[5]=array("name"=>"po_no","type"=>"string","editor"=>"textFieldBlank,width:80" ,"df"=>"" );			
	${$col}[6]=array("name"=>"ref_doc","type"=>"string","editor"=>"textFieldBlank,width:80" ,"df"=>"" );			

	
//	${$col}[6]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
//	${$col}[7]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
//	${$col}[8]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
//	${$col}[9]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
//	${$col}[10]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
//	${$col}[11]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){

Ext.QuickTips.init();

// Global
var selItem = "";
var selReqQty = 0;
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
<?php // unplan reason combo
	 $cname = "orDate";
	 $pk = "order_date";
	 $fname = "order_date";
	 $dname = "order_date";
	 $vname = "order_date";
	 $url = $screenId."/getOrderDateCombo";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $value = "";
	 $readonly = false;
	 $initParam ="";
     $width = "200";
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
		var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["start"] = 0;
	    obj["params"]["limit"] = 500;
	    obj["params"]["order_date"] = combo.getValue();
	    
	    pResultDataStore.removeAll();
	    pResultDataStore.load(obj);
}

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true,true,'0');	

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [orDateCombo];
	var rightComp = [];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
	<?php 
		$gname = "pResult";
		$width = "auto";
		$height = "900";
		$initialLoad = false;
		$enableCollapse = false;
		$title = "";
		$autoSave = "false";
		$groupField = "customer_name";
		include(APPPATH.'/views/common/simpleReadOnlyGroupGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}

	// Final panel	
	<?php 
		$fpanel = "maindata";
		$panelItem = "";
		$gname	= "pResult";
		$render = $screenId;
		include(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>