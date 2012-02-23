
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "SL0050"; 
	$pkId = "id";
	
	$col = "item";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]  = array("name" => "order_no","type" => "string", "editor" => "textFieldNBlank,width:110","df"=>"" );
	${$col}[2]  = array("name" => "customer_code","type" => "string", "editor" => "textFieldBlank ,width:80" ,"df"=>"");
	${$col}[3]  = array("name" => "vendor_name","type" => "string", "editor" => "textFieldBlank,width:150" ,"df"=>"");
	${$col}[4]  = array("name" => "item_code","type" => "string", "editor" => "textFieldBlank" ,"df"=>"");
	${$col}[5]  = array("name" => "delivery_qty","type" => "string", "editor" => "textFieldBlank,width:90","df"=>"" );
	${$col}[6]  = array("name" => "r_issue_qty","type" => "string", "editor" => "textFieldBlank,width:90","df"=>"" );
	${$col}[7]  = array("name" => "issue_date","type" => "datetime", "editor" => "textFieldNBlank,width:110" ,"df"=>"");
	${$col}[8]  = array("name" => "ref_doc","type" => "string", "editor" => "textFieldNBlank,width:110,hidden: true","df"=>"" );
	${$col}[9]  = array("name" => "sale_price_qty","type" => "string", "editor" => "textFieldNBlank,width:110","df"=>"" );
	${$col}[10]  = array("name" => "discount_qty","type" => "string", "editor" => "textFieldNBlank,width:110","df"=>"" );
	${$col}[11]  = array("name" => "total_price_qty","type" => "string", "editor" => "textFieldNBlank,width:110","df"=>"" );
	
	//${$col}[9]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );
	//${$col}[10]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );
	//${$col}[11]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );
	//${$col}[12]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );
	//${$col}[13]=array("name"=>"created_user","type"=>"string","editor"=>"","df"=>"" );
	//${$col}[14]=array("name"=>"updated_user","type"=>"string","editor"=>"","df"=>"" );

	include_once(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component Define Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Row Editor Components vvv
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);		

//var saleCode = formTextField1(false,false,'sale_code','<?=lang('sale_code')?>');	
<?php // Delivery No
		 $cname = "sale";
		 $pk = "sale_code";
		 $fname = "sale_code";
		 $dname = "sale_name";
		 $vname = "sale_code";
		 $url = $screenId."/getSaleCodeList";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = true;
		 $initParam ="";
		 $width = 200;
		 
		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{

	}
var startDate = formDateField1(false,false,'start_issue_date','<?=lang('start_issue_date')?>',new Date(),'Y-m-d');	
var endDate = formDateField1(false,false,'end_issue_date','<?=lang('end_issue_date')?>',new Date(),'Y-m-d');


    Ext.QuickTips.init();

	// Search
	<?php 
		$gname = "item";
		$leftComp = "saleCombo";
		$rightComp = "startDate,endDate";
		$render = $screenId."_search";
		include_once(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
	pageLimit = 400;
	// Grid
	<?php 
			$gname = "item";
			$width = "auto";
			$height = "513";
			$initialLoad = false;
			$enableCollapse = false;
			$title = "";
			$autoSave = "false";
			$groupField = "ref_doc";
			include_once(APPPATH.'/views/common/simpleReadOnlyGroupGrid1'.EXT);

	?>

	// Final panel	
	<?php 
			$panelItem = "";
			$gname	= "item";
			$render = $screenId;
			include_once(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>

});

</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>