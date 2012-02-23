
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0821"; 
	$pkId = "id";
	
	$col = "issue";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>"id","type"=>"number","editor"=>"numField, hidden: true , hideable: false","df"=>"0" );						
	${$col}[1]	=	array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:150","df"=>"" );						
	${$col}[2]	=	array("name"=>"location_code","type"=>"string","editor"=>"locaCombo,width:150" ,"df"=>"" );	
						
	${$col}[3]	=	array("name"=>	"issue_no"	,"type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[4]	=	array("name"=>	"ref_doc_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[5]	=	array("name"=>	"issue_date","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[6]	=	array("name"=>	"issue_staff","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						

	${$col}[7]	=	array("name"=>	"lot_no"	,"type"=>"string","editor"=>"lotCombo,width:100","df"=>"" );						
	${$col}[8]	=	array("name"=>	"seq_no"	,"type"=>"string","editor"=>"seqCombo,width:80","df"=>"" );						
	${$col}[9]	=	array("name"=>	"req_qty"	,"type"=>"number","editor"=>"invQty,width:150","df"=>"" );
	${$col}[10]	=	array("name"=>	"inv_qty"	,"type"=>"number","editor"=>"invQty,width:150","df"=>"" );
	${$col}[11]	=	array("name"=>	"issue_qty"	,"type"=>"number","editor"=>"numField,width:150","df"=>"" );	
						
	${$col}[12]	=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[13]	=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[14]	=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[15]	=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[16]	=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[17]	=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	
	include(APPPATH.'/views/common/h_include'.EXT);

?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();

    var isClick = false;
	var selItem = "";
	var selLoca = "";
	var selLot  = "";
	var selDeli = "";
	var selOrder = "";
	
	
	// DataProxy define area
	var issuStore = new Ext.data.SimpleStore({
	    fields:['issu_type_v', 'issu_type_n']
	   ,data:[
	   //     ['U', 'Unplan'],
	       ['P', 'Plan']
	   ]
	});

	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//             Component define area  
	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//formTextField1(Blank,Read,name,Label)
	var issueNo = formTextField1(true,true,'issue_no','<?=lang('issue_no')?>');		
	var refDocNo = formTextField1(false,false,'ref_doc_no','<?=lang('ref_doc_no')?>');			
	var issueDate = formDateField1(false,false,'issue_date','<?=lang('issue_date')?>','','Y-m-d');	
	var issuType = formCombo1('issu_type','<?=lang('issu_type')?>','issu_type_n','issu_type_v','P',issuStore);
	var orderNo = formTextField1(true,true,'order_no','<?=lang('order_no')?>');		
	var poNo = formTextField1(true,true,'po_no','<?=lang('po_no')?>');		
	var deliveryDate = formTextField1(true,true,'delivery_date','<?=lang('delivery_date')?>');		
	var cusName = formTextField2(true,true,'customer_name','<?=lang('customer_name')?>','',200);		
	var deliName = formTextField1(true,true,'delivery_name','<?=lang('delivery_name')?>');		
	var add1 = formTextField2(true,true,'address_1','<?=lang('address_1')?>','',200);		
	var add2 = formTextField2(true,true,'address_2','<?=lang('address_2')?>','',200);		
	var add3 = formTextField2(true,true,'address_3','<?=lang('address_3')?>','',200);		
	var zip = formTextField1(true,true,'zip_code','<?=lang('zip_code')?>');		


	<?php // Delivery No
		 $cname = "deli";
		 $pk = "deli_code";
		 $fname = "delivery_no";
		 $dname = "delivery_name";
		 $vname = "delivery_no";
		 $url = $screenId."/getDeliveryNoList";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = true;
		 $initParam ="";
		 $width = 200;
		 
		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		isEdit = false;
		addClick = false;
		issueEditor.stopEditing(0);

		selDeli = combo.getValue();
	    Ext.Ajax.request({
	        url : 'IV0080/getDeliveryDetail',
	        method: 'POST',
	        params :{query: selDeli},
	        success: function ( result, request ) {
	                     var jsonData = Ext.util.JSON.decode(result.responseText);
	 					 selOrder = jsonData["data"][0]["order_no"];
	                 	 var itemCom = Ext.getCmp('ext-comp-1005'); 
	                     var obj = new Object();
	                     obj["params"] = new Object();
	                     obj["params"]["query"] = selDeli;
	                     itemCom.clearValue(); 
	                     itemStore.load(obj);
	
	                     var obj = new Object();
	                     obj["params"] = new Object();
	                     obj["params"]["start"] = 0;
	                     obj["params"]["limit"] = pageLimit;
	                     obj["params"]["deli"] = selDeli;
	                     issueDataStore.removeAll();
	                     issueDataStore.load(obj);
	
	                     Ext.getCmp('ext-comp-1047').setValue(jsonData["data"][0]["order_no"]);
	                     Ext.getCmp('ext-comp-1048').setValue(jsonData["data"][0]["customer_name"]);
	                     Ext.getCmp('ext-comp-1049').setValue(jsonData["data"][0]["address_1"]);
	                     Ext.getCmp('ext-comp-1050').setValue(jsonData["data"][0]["address_3"]);
	
	                     Ext.getCmp('ext-comp-1055').setValue(jsonData["data"][0]["delivery_date"]);
	                     Ext.getCmp('ext-comp-1056').setValue(jsonData["data"][0]["po_no"]);
	                     Ext.getCmp('ext-comp-1057').setValue(jsonData["data"][0]["delivery_name"]);
	                     Ext.getCmp('ext-comp-1058').setValue(jsonData["data"][0]["address_2"]);
	                     Ext.getCmp('ext-comp-1059').setValue(jsonData["data"][0]["zip_code"]);
	
	
	        },
	                 failure: function ( result, request ) {
	                  var jsonData = Ext.util.JSON.decode(result.responseText);
	                  var resultMessage = jsonData.data.result;
					 alert(resultMessage);
	              }
	      });
	}

	//Component in rowEditor
	var textFieldBlank = rowEditTextField1(true);		
	var textFieldNBlank = rowEditTextField1(false);
	var invQty = rowEditNumField1(false,true);		
	var numField = rowEditNumField1(false,false,'','issueQty');


	<?php 
		// Generate RowEdit itemCombo
		 $cname = "item";
		 $pk = "item_code";
		 $dname = "item_code";
		 $vname = "item_code";
		 $optionField = ",{name:'order_qty'}";
		 $url = "IV0080/getItemList";
		 $editable = "true";
		 $allowBlank = "false";
		include(APPPATH.'/views/common/editRowComboList2'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		selItem = combo.getValue();
		var loCom = Ext.getCmp('ext-comp-1006'); 
	    var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item"] = selItem
		loCom.clearValue(); 
		locaStore.load(obj);
	
	    Ext.Ajax.request({
	        url : 'IV0080/getReqOrderQty',
	        method: 'POST',
	        params :{item:combo.getValue(), order:selOrder , deli: selDeli},
	        success: function ( result, request ) {
	                     var jsonData = Ext.util.JSON.decode(result.responseText);
	                     var resultMessage = jsonData["data"][0]["order_qty"];
	                     var reqTxt = Ext.getCmp('ext-comp-1013')
	                     reqTxt.setValue(resultMessage);
	
	              },
	                 failure: function ( result, request ) {
	                  var jsonData = Ext.util.JSON.decode(result.responseText);
	                  var resultMessage = jsonData.data.result;
						 alert(resultMessage);
	              }
	      });
		
	}
	
	<?php 
		// Generate RowEdit itemCombo
		 $cname = "loca";
		 $pk = "location_code";
		 $dname = "location_name";
		 $vname = "location_code";
		 $url = "../MT/MT0040/getLocaByItemK";
		 $editable = "true";
		 $allowBlank = "false";
		include(APPPATH.'/views/common/editRowComboList2'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		selLoca = combo.getValue();
		var lotCom = Ext.getCmp('ext-comp-1011'); 
	    var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item"] = selItem;
	    obj["params"]["loca"] = selLoca;
		lotCom.clearValue(); 
		lotStore.load(obj);
	}
	
	<?php 
		// Generate RowEdit itemCombo
		 $cname = "lot";
		 $pk = "lot_no";
		 $dname = "lot_no";
		 $vname = "lot_no";
		 $url = "IV0080/getLotNo";
		 $editable = "true";
		 $allowBlank = "false";
		include(APPPATH.'/views/common/editRowComboList2'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		selLot = combo.getValue();
		var seqCom = Ext.getCmp('ext-comp-1012'); 
	    var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item"] = selItem;
	    obj["params"]["loca"] = selLoca;
	    obj["params"]["lot"] = selLot;
	    seqCom.clearValue(); 
		seqStore.load(obj);
	}
	
	<?php 
		// Generate RowEdit itemCombo
		 $cname = "seq";
		 $pk = "seq_no";
		 $dname = "seq_no";
		 $vname = "seq_no";
		 $url = "IV0080/getSeqNo";
		 $editable = "true";
		 $allowBlank = "false";
		include(APPPATH.'/views/common/editRowComboList2'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	    Ext.Ajax.request({
	        url : 'IV0080/getInvQty',
	        method: 'POST',
	        params :{item:selItem, loca:selLoca, lot: selLot, seq: combo.getValue()},
	        success: function ( result, request ) {
	            		//alert("hello");
	                     var jsonData = Ext.util.JSON.decode(result.responseText);
	                     var resultMessage = jsonData.qty;
	                     var invTxt = Ext.getCmp('ext-comp-1014')
	                     invTxt.setValue(resultMessage);
	
	              },
	                 failure: function ( result, request ) {
	                  var jsonData = Ext.util.JSON.decode(result.responseText);
	                  var resultMessage = jsonData.data.result;
						 alert(resultMessage);
	              }
	      });
	}

// Row Editor ^^^
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

Ext.apply(Ext.form.VTypes, {
   issueQty: function(value, field)
   {
      if (value > Ext.getCmp('ext-comp-1014').getValue())
		return false;
      else
		return true; 
   },
 
   issueQtyText: '<?=lang('ER0001')?>'
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
	// <-- End Grid Header
	var leftComp  = [issueNo,refDocNo,deliCombo,orderNo,cusName,add1,add3];
	var rightComp = [issueDate,issuType,deliveryDate,poNo,deliName,add2,zip];
    var maindata = formMain1(leftComp,rightComp);
    
    // Grid vvv
	<?php $gname = "issue"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	    	read    : '<?=$screenId?>/forecastJobNo',
	    	create  : '<?=$screenId?>/insertLedger',
	    	update  : '<?=$screenId?>/updates',
	    	destroy : '<?=$screenId?>/destroys'
	  	},
	  	method: 'POST'
	});  
	<?php 
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$enableCollapse = false;
		$title = "";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleGrid2'.EXT);
		include(APPPATH.'/views/common/simpleAddEvent2'.EXT);
		include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
		//include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
	?>
	var selRow = 0;
    function onSelectEvent<?=$gname?>(sm,row,rec)
    {
		var values = rec.data;
        var field, id;
        var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item"] = selItem = values['item_code']
	    obj["params"]["loca"] = selLoca =  values['location_code'];
	    obj["params"]["lot"] = selLot = values['lot_no'];	                                           	                                             
		locaStore.load(obj);
		lotStore.load(obj);
		seqStore.load(obj);
		selRow = row;
    }
    
	// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$gname	= "issue";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>

	
    function updateEvent(){

        
        if (fp.form.isValid() && !isEdit) {

            //var obj = selValue;
            Ext.iterate(fp.form.getValues(), function(key, value) { obj[key] = value; }, this);

            obj["data"] = new Object();
            var j = 0;
            var isNotEnough = false;
            var hashCheck = new Array();

            for( var i = 0 ; i < itemStore.getCount(); i++ )
        	{
            	var itemCode = itemStore.getAt(i).get("item_code");
            	hashCheck[itemCode] = new Array(); 
               	hashCheck[itemCode]["req_qty"]  = itemStore.getAt(i).get("order_qty");               
            	hashCheck[itemCode]["issue_qty"]  = 0;
        	}

     	    for(var i = 0 ; i < issueDataStore.getCount() ; i++)
    	    {
				if( parseFloat( issueDataStore.getAt(i).get("issue_qty") ) == 0 || issueDataStore.getAt(i).get("issue_qty") == "" )
					continue;
        	    obj["data"][j] = new Object();
        	    obj["data"][j]["item_code"] = issueDataStore.getAt(i).get("item_code");
        	    obj["data"][j]["location_code"] = issueDataStore.getAt(i).get("location_code");
        	    obj["data"][j]["lot_no"] = issueDataStore.getAt(i).get("lot_no");
        	    obj["data"][j]["seq_no"] = issueDataStore.getAt(i).get("seq_no");
        	    obj["data"][j]["issue_qty"] = parseFloat( issueDataStore.getAt(i).get("issue_qty") );

				var locationLot = issueDataStore.getAt(i).get("lot_no") + issueDataStore.getAt(i).get("location_code");
        	    
        	    if( hashCheck[obj["data"][j]["item_code"]] == null ) hashCheck[obj["data"][j]["item_code"]] = new Array();
				if( hashCheck[obj["data"][j]["item_code"]]["issue_qty"] == null) hashCheck[obj["data"][j]["item_code"]]["issue_qty"] = 0;
				if( hashCheck[obj["data"][j]["item_code"]][locationLot] == null) hashCheck[obj["data"][j]["item_code"]][locationLot] = 0;

				hashCheck[obj["data"][j]["item_code"]]["req_qty"] = parseFloat( issueDataStore.getAt(i).get("req_qty") );
				hashCheck[obj["data"][j]["item_code"]]["issue_qty"] =  parseFloat(hashCheck[obj["data"][j]["item_code"]]["issue_qty"])  + parseFloat( issueDataStore.getAt(i).get("issue_qty") );
				hashCheck[obj["data"][j]["item_code"]][locationLot] = hashCheck[obj["data"][j]["item_code"]][locationLot] + 1;
				if ( hashCheck[obj["data"][j]["item_code"]][locationLot] > 1 )
				{
	     	     	Ext.Msg.show({
    	        		title:'ลง lot ซ้ำ',
    	        		msg: 'โปรดตรวจสอบหมายเลข Lot อีกที ',
    	                icon: Ext.MessageBox.ERROR,
    	                buttons: Ext.Msg.OK
	    	       	});
					return;
				}                       				
        	    j++;
    	    } 
    	    for( item in hashCheck ){
        		if ( typeof hashCheck[item].issue_qty != "undefined" && hashCheck[item].issue_qty != hashCheck[item].req_qty ){
     	     	   Ext.Msg.show({
    	        		title:'จำนวนที่นำออก ไม่เท่ากับจำนวนใบเบิก',
    	        		msg: 'กรุณาตรวจสอบสินค้า ' + item,
    	                icon: Ext.MessageBox.ERROR,
    	                buttons: Ext.Msg.OK
    	       		});

					return;
        		}
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
	            if( !isClick ){
	             	isClick = true; 
			   		submitData(obj);
	            }
		   }


        }else{
        	   //alert("Form validate " + fp.form.isValid() + " EditFlag " + isEdit )
	     	   Ext.Msg.show({
	        		title:'ตรวจสอบรายการ',
	        		msg: 'คุณทำรายการไม่ถูก',
	                icon: Ext.MessageBox.ERROR,
	                buttons: Ext.Msg.OK

	       		});
        }
    }
    
    function submitData(obj){
        Ext.Ajax.request({
            url : '<?=$screenId?>/insertLedger',
            method: 'POST',
            params : obj,
            success: function ( result, request ) {
                        var jsonData = Ext.util.JSON.decode(result.responseText);

                        alert("หมายเลขใบส่งของ คือ " + jsonData["issue_no"]);

						// Remove Updated Item                        
                        issueDataStore.removeAll();
                        
                		// Refresh Select Order list
                        deliStore.load({params: {query: ''} });

		        	    fp.getForm().reset(); 

		        	    isClick = false; 
                         
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