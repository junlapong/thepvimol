
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "SL0011";
	$pkId = "id";
	
	$col = "order";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]=array("name"=>"order_status","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"0" );			
	${$col}[1]=array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );			
	${$col}[2]=array("name"=>"po_no","type"=>"string","editor"=>"textFieldBlank,width:110" ,"df"=>"" );			
	${$col}[3]=array("name"=>"ref_doc","type"=>"string","editor"=>"textFieldBlank,width:80" ,"df"=>"0" );
	${$col}[4]=array("name"=>"delivery_no","type"=>"string","editor"=>"textFieldBlank,width:110, hidden: true , hideable: false" ,"df"=>"" );
	${$col}[5]=array("name"=>"inv_no","type"=>"string","editor"=>"textFieldBlank,width:80, hidden: true , hideable: false" ,"df"=>"" );
	${$col}[6]=array("name"=>"order_date","type"=>"datetime","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[7]=array("name"=>"plan_delivery_date","type"=>"datetime","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[8]=array("name"=>"SL0011_delivery_date","type"=>"datetime","editor"=>"textFieldBlank,width:100" ,"df"=>"0" );			
	
	${$col}[9]=array("name"=>"trader_short_name","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"0" );
	${$col}[10]=array("name"=>"delivery_name","type"=>"string","editor"=>"textFieldBlank,width:110" ,"df"=>"0" );
	${$col}[11]=array("name"=>"address_1","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"0" );
	${$col}[12]=array("name"=>"address_2","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"0" );
	${$col}[13]=array("name"=>"address_3","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"0" );
	
	${$col}[14]=array("name"=>"cancel_flag","type"=>"bool","editor"=>"textFieldBlank,width:55" ,"df"=>"0" );			
	${$col}[15]=array("name"=>"cancel_reason","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"" );			
	${$col}[16]=array("name"=>"cancel_date","type"=>"datetime","editor"=>"textFieldBlank,width:100","df"=>"0000-00-00 00:00:00"  );			
	${$col}[17]=array("name"=>"cancel_staff","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>""  );			

	${$col}[18]=array("name"=>"finished_flag","type"=>"bool","editor"=>"textFieldBlank,width:55" ,"df"=>"0" );			
	${$col}[19]=array("name"=>"finished_reason","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"" );			
	${$col}[20]=array("name"=>"finished_date","type"=>"datetime","editor"=>"textFieldBlank,width:100","df"=>"0000-00-00 00:00:00"  );			
	${$col}[21]=array("name"=>"finished_approver","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>""  );	
	
	${$col}[22]=array("name"=>"remark","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"0" );
	${$col}[23]=array("name"=>"memo_date","type"=>"datetime","editor"=>"textFieldBlank,width:150" ,"df"=>"0" );
	${$col}[24]=array("name"=>"memo_staff","type"=>"string","editor"=>"textFieldBlank,width:100" ,"df"=>"0" );
	
	
	${$col}[25]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[26]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[27]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[28]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[29]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[30]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
	$col = "orderDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = $screenId."_detail1";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[1]		=	array("name"=>"stock_qty","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[2]		=	array("name"=>"plan_qty","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[3]		=	array("name"=>"available_qty","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	
	${$col}[4]		=	array("name"=>"req_qty","type"=>"number","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[5]		=	array("name"=>"remain_withdraw_qty","type"=>"number","editor"=>"textFieldBlank,width:110","df"=>"" );
	${$col}[6]		=	array("name"=>"delivery_qty","type"=>"number","editor"=>"textFieldBlank,width:110","df"=>"" );
	
	${$col}[7]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[8]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[9]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[10]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[11]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[12]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );

include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
var orStatusStore = new Ext.data.SimpleStore({
    fields:['order_status_v', 'order_status_n']
   ,data:[
        ['all', 'ทั้งหมด']
       ,['ยกเลิก', 'ยกเลิก']
       ,['ส่งบางส่วน', 'ส่งบางส่วน']
       ,['รอใบเบิก', 'รอใบเบิก']
       ,['รอส่ง', 'รอส่ง']
       ,['รอปิด', 'รอปิด']
       ,['ปิด', 'ปิด']
   ]
});

Ext.onReady(function(){
Ext.QuickTips.init();

// Global
var selItem = "";
var selReqQty = 0;
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
var orderStatus = formCombo1('order_status','<?=lang('order_status')?>','order_status_n','order_status_v','all',orStatusStore);		
var traderName = formTextField2(true,false,'trader_short_name','<?=lang('trader_short_name')?>');
var poNo = formTextField2(true,false,'po_no','<?=lang('po_no')?>');
var invNo = formTextField2(true,false,'inv_no','<?=lang('inv_no')?>');

var finDate  = formDateField1(false,false,'finished_date','<?=lang('finished_date')?>',new Date(),'Y-m-d');	
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true,true,'0');	

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	// Search
	<?php 
		$gname = "order";
		$leftComp = "orderStatus";
		$rightComp = "traderName,poNo";
		$render = $screenId."_search";
		include(APPPATH.'/views/common/simpleSearchPanel1'.EXT);
	?>  
    
// Grid vvv
	<?php 
		$gname = "order";
		$width = "auto";
		$height = "500";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;

		var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["order_no"] = values["order_no"];
	    
	    orderDetailDataStore.removeAll();
	    orderDetailDataStore.load(obj);

	}

	// Grid vvv
	<?php 
		$gname = "orderDetail";
		$view = "getOrderDetail";
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$enableCollapse = true;
		$title = "";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}

	// Final panel	
	<?php 
		$panelItem = "";
		$gname	= "order";
		$gname2	= "orderDetail";
		$render = $screenId;
		include(APPPATH.'/views/common/simpleFinalPanel1'.EXT);
	?>

});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>