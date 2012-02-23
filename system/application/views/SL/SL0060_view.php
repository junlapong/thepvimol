
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "SL0060"; 
	$pkId = "item_code";
	
	$col = "selectOrder";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = 'order_no';
	${$col."Render"} = "";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	${$col}[0]		=	array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );
	${$col}[1]		=	array("name"=>"plan_order_date","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"0" );
	${$col}[2]		=	array("name"=>"order_date","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );
	
	${$col}[3]		=	array("name"=>"po_no","type"=>"string","editor"=>"readTextFieldBlank,width:110","df"=>"" );
	${$col}[4]		=	array("name"=>"ref_doc","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );

	${$col}[5]		=	array("name"=>"trader_name","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[6]		=	array("name"=>"delivery_name","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );
	${$col}[7]		=	array("name"=>"address_1","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[8]		=	array("name"=>"address_2","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	${$col}[9]		=	array("name"=>"address_3","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
	
	${$col}[10]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[11]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[12]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[13]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[14]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[15]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
	$col = "order";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]		=	array("name"=>"item_code","type"=>"string","editor"=>"readTextFieldBlank,width:110","df"=>"" );
	${$col}[1]		=	array("name"=>"stock_qty","type"=>"string","editor"=>"readNumFieldBlank,width:110","df"=>"" );
	${$col}[2]		=	array("name"=>"plan_qty","type"=>"string","editor"=>"readNumFieldBlank,width:110","df"=>"" );
	${$col}[3]		=	array("name"=>"available_qty","type"=>"string","editor"=>"readNumFieldBlank,width:110","df"=>"" );
	
	${$col}[4]		=	array("name"=>"remain_withdraw_qty","type"=>"number","editor"=>"readNumFieldBlank,width:110","df"=>"" );
	${$col}[5]		=	array("name"=>"delivery_qty","type"=>"number","editor"=>"numFieldBlank,width:110","df"=>"" );
	${$col}[6]		=	array("name"=>"delivery_reason","type"=>"string","editor"=>"dlReasonCombo,width:150","df"=>"" );
	
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
Ext.onReady(function(){
    Ext.QuickTips.init();
    
// Global
var selOrder = "";
var selValue = "";
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
var deliDate = formDateField1(false,false,'delivery_date','<?=lang($screenId.'_delivery_date')?>','','Y-m-d');	
var refDoc = formTextField2(false,false,'ref_doc','<?=lang('ref_doc')?>','');
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(false,false,'','issueQty');	
var readTextFieldBlank = rowEditTextField1(false,true);
var readNumFieldBlank = rowEditNumField1(false,true);

<?php 
	// Generate RowEdit itemCombo
	 $cname = "dlReason";
	 $pk = "dl_reason_val";
	 $dname = "dl_reason_disp";
	 $vname = "dl_reason_val";
	 $url = $screenId."/getDlReasonCombo";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList2'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{

}
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
var isLoaded = false;
Ext.apply(Ext.form.VTypes, {
   issueQty: function(value, field)
   {
      if (value > Ext.getCmp('ext-comp-1037').getValue())
      {
           if( !isLoaded )
           {
	        	var reason = Ext.getCmp('ext-comp-1039');
				reason.allowBlank = false;
	        	
    	    	var obj = new Object();
    	    	obj["params"] = new Object();
    	    	obj["params"]["query"] = "";
    	    	dlReasonStore.load(obj);
        		isLoaded = true;
           }
		return true;
      }
      else if (value == Ext.getCmp('ext-comp-1037').getValue())
      {
      	var reason = Ext.getCmp('ext-comp-1039');
		reason.allowBlank = true;
		reason.setValue("");
		
		isLoaded = false;
		return true;
      } else {
          if( !isLoaded )
          {
	        	var reason = Ext.getCmp('ext-comp-1039');
				reason.allowBlank = false;
	        	
   	    	var obj = new Object();
   	    	obj["params"] = new Object();
   	    	obj["params"]["query"] = "";
   	    	dlReasonStore.load(obj);
       		isLoaded = true;
          }
  		  return true;
      }
   },
 
   issueQtyText: '<?=lang('ER0001')?>'
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [deliDate,notes];
	var rightComp = [refDoc];
    var maindata = formMain1(leftComp,rightComp);

 // Grid vvv
	<?php 
		$gname = "selectOrder";
		$width = "auto";
		$height = "200";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
		selValue = values;
		selOrder = values["order_no"];

		var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["query"] = selOrder;
	    
	    orderDataStore.removeAll();
		orderDataStore.load(obj);

	}
    
// Grid vvv
	<?php $gname = "order"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	  		read    : '<?=${$gname."URL"}?>/orderNoList'
	  	},
	  	method: 'POST'
	});  
	<?php 
		$width = "auto";
		$height = "200";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleGrid2'.EXT);
		include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleInitialButton1'.EXT);
	?>
	<?=$gname?>EnableButton(true);

// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$gname	= "selectOrder";
		$gname2	= "order";
		$fitem  = "maindata";
		$render = $screenId;
		include(APPPATH.'/views/common/simpleFinalPanel4'.EXT);
	?>

	function updateEvent(){
        if (fp.form.isValid() && !isEdit) {
            
            var obj = selValue;
            Ext.iterate(fp.form.getValues(), function(key, value) { obj[key] = value; }, this);

            obj["data"] = new Object();
            var j = 0;
            var isNotEnough = false;

     	    for(var i = 0 ; i < orderDataStore.getCount() ; i++)
    	    {
				if( parseFloat( orderDataStore.getAt(i).get("delivery_qty") ) == 0 )
					continue;
        	    
        	    obj["data"][j] = new Object();
        	    obj["data"][j]["item_code"] = orderDataStore.getAt(i).get("item_code");
        	    obj["data"][j]["order_qty"] = parseFloat( orderDataStore.getAt(i).get("delivery_qty") );
        	    obj["data"][j]["delivery_reason"] = orderDataStore.getAt(i).get("delivery_reason");

        	    // Delivery Qty  > Stock Qty  ของในคลังไม่พอ
				if( parseFloat( orderDataStore.getAt(i).get("delivery_qty") ) > parseFloat( orderDataStore.getAt(i).get("stock_qty") ) 
					|| isNaN(parseFloat( orderDataStore.getAt(i).get("stock_qty"))	)
				   )
				{
					isNotEnough = true;
				}	
        	    j++;
    	    } 
    	    if( j == 0){
        	    alert("ไม่มีการทำรายการ");
    	    	return; 
    	    }

     	   obj["data"] = Ext.util.JSON.encode(obj["data"]);
        	
		   if(isNotEnough){
			   
	     	   Ext.Msg.show({
	        		title:'ยืนยันการทำรายการ',
	        		msg: 'ของในคลัง(STORE) มีไม่พอ คุณต้องการที่จะทำรายการ ?',
	        		buttons: Ext.Msg.YESNO, icon: Ext.Msg.QUESTION,
	        		fn: function(btn, text) { if(btn == 'yes') { submitData(obj);} }
	       		});
	       		
		   }else{
			   submitData(obj);
		   }
        }else{
	     	   Ext.Msg.show({
	        		title:'ตรวจสอบรายการ',
	        		msg: 'คุณทำรายการไม่ถูก',
	                icon: Ext.MessageBox.ERROR,
	                buttons: Ext.Msg.OK
//	        		fn: function(btn, text) { if(btn == 'yes') { submitData(obj);} }
	       		});
        }
    }

    function submitData(obj){
        Ext.Ajax.request({
            url : '<?=$screenId?>/updateDelivery',
            method: 'POST',
            params : obj,
            success: function ( result, request ) {
                        var jsonData = Ext.util.JSON.decode(result.responseText);

                        alert("หมายเลขใบส่งของ คือ " + jsonData["deliNo"]);

						// Remove Updated Item                        
                        orderDataStore.removeAll();
                        
                		// Refresh Select Order list
                        selectOrderDataStore.load({params: {start: 0, limit: pageLimit} });

		        	    fp.getForm().reset(); 
                         
                  },
                     failure: function ( result, request ) {
                      var jsonData = Ext.util.JSON.decode(result.responseText);
                      var resultMessage = jsonData.data.result;
    					 alert(resultMessage);
                  }
         });        
    }

});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>