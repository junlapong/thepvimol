
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "SL0020"; 
	$pkId = "id";
	
	$col = "order";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]		=	array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	
	${$col}[2]		=	array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:150","df"=>"" );
	${$col}[3]		=	array("name"=>"order_qty","type"=>"number","editor"=>"orderQty,width:110","df"=>"" );

	${$col}[4]		=	array("name"=>"sale_condition","type"=>"number","editor"=>"saleConCombo,width:60","df"=>"" );
	${$col}[5]		=	array("name"=>"sale_price","type"=>"number","editor"=>"numReadFieldBlank,width:60","df"=>"" );
	${$col}[6]		=	array("name"=>"discount1","type"=>"number","editor"=>"numReadFieldBlank,width:50","df"=>"" );
	
	${$col}[7]		=	array("name"=>"po_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[8]		=	array("name"=>"customer_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[9]		=	array("name"=>"delivery_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[10]		=	array("name"=>"order_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[11]		=	array("name"=>"delivery_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );

	${$col}[12]		=	array("name"=>"s_packing_qty","type"=>"number","editor"=>"numFieldBlank,width:120","df"=>"" );
	${$col}[13]		=	array("name"=>"s_packing_style","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	${$col}[14]		=	array("name"=>"b_packing_qty","type"=>"number","editor"=>"numFieldBlank,width:120","df"=>"" );
	${$col}[15]		=	array("name"=>"b_packing_style","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );
	
	${$col}[16]		=	array("name"=>"cancel_flag","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[17]		=	array("name"=>"cancel_reason","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[18]		=	array("name"=>"cancel_date","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[19]		=	array("name"=>"cancel_staff","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );

	${$col}[20]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[21]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[22]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[23]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[24]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[25]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
    
// Global
var selItem = "";
var selVendor = "";
var selDeli = "";
var saleCon = 0;
var orderQty_g = 0;

var saleConStore = new Ext.data.SimpleStore({
    fields:['sale_con_v', 'sale_con_n']
   ,data:[['-1','ของแถม'],['0', 'Cash'],['1', 'Credit']]
});
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
<?php // Customer FORM
	 $cname = "customer";
	 $pk = "vendor_code";
	 $fname = "vendor_code";
	 $dname = "vendor_name";
	 $vname = "vendor_code";
	 $url = $screenId."/customerCodeList";
	 $editable = "true";
	 $mode = "remote";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $initParam ="";
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
//	alert(combo.getId());
	selVendor = combo.getValue();
	var deliCom = Ext.getCmp('ext-comp-1054'); 
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["query"] = selVendor;
    deliCom.clearValue(); 
	deliveryStore.load(obj);
}

<?php // Generate Delivery Combo
	 $cname = "delivery";
	 $pk = "delivery_code";
	 $fname = "delivery_code";
	 $dname = "delivery_name";
	 $vname = "delivery_code";
	 $url = "../MT/MT0120/deliveryCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = false;
	 $mode = "local";
	 $initParam ="";
	 
	 include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	selDeli = combo.getValue();
	var itemCom = Ext.getCmp('ext-comp-1006'); 
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["vendor_code"] = selVendor;
    obj["params"]["delivery_code"] = selDeli;
    itemCom.clearValue(); 
	itemStore.load(obj);
	selItem = "";
	
}
var orderNo	=  formTextField1(true,true,'order_no','<?=lang('order_no')?>');	
var poNo = formTextField1(false,false,'po_no','<?=lang('po_no')?>');
var orderDate = formDateField1(false,false,'order_date','<?=lang('order_date')?>',new Date(),'Y-m-d');	
var deliveryDate = formDateField1(false,false,'delivery_date','<?=lang('delivery_date')?>',(new Date()).addDays(7),'Y-m-d');	
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);
var refDoc = formTextField2(false,false,'ref_doc','<?=lang('ref_doc')?>','');

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	
var numReadFieldBlank = rowEditNumField1(false,true);	
<?php 
	// Generate RowEdit itemCombo
	 $cname = "item";
	 $pk = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = "../MT/MT0130/itemCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList2'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	var vendorCom = Ext.getCmp('ext-comp-1053'); 
	var deliCom = Ext.getCmp('ext-comp-1054'); 

	var orderQ = Ext.getCmp('ext-comp-1007');
	orderQty_g = parseFloat( orderQ.getValue() );
	
    Ext.Ajax.request({
        url : '<?=$screenId?>/getPaymentType',
        method: 'POST',
        params :{item:combo.getValue(), deliCom: deliCom.getValue(), vendorCode:selVendor},
        success: function ( result, request ) {
            		//alert("hello");

            		 var jsonData = Ext.util.JSON.decode(result.responseText);
                     var payType = jsonData.payType;
                 	(Ext.getCmp('ext-comp-1008')).setValue(payType);
              },
                 failure: function ( result, request ) {
                  var jsonData = Ext.util.JSON.decode(result.responseText);
                  var resultMessage = jsonData.data.result;
					 alert(resultMessage);
              }
      });

    Ext.Ajax.request({
        url : '<?=$screenId?>/getPacking',
        method: 'POST',
        params :{item:combo.getValue()},
        success: function ( result, request ) {
            		//alert("hello");

            		 var jsonData = Ext.util.JSON.decode(result.responseText);
                     var packing = jsonData.packing;
                 	(Ext.getCmp('ext-comp-1016')).setValue(packing);
              },
                 failure: function ( result, request ) {
                  var jsonData = Ext.util.JSON.decode(result.responseText);
                  var resultMessage = jsonData.data.result;
					 alert(resultMessage);
              }
      });
	saleCon = parseInt( (Ext.getCmp('ext-comp-1008')).getValue() );

	setPriceNDiscount(combo.getValue(),saleCon,orderQty_g);
	
	vendorCom.setReadOnly(true);
	deliCom.setReadOnly(true);
}

var saleConCombo = new Object();		
saleConCombo["xtype"] = 'combo';
saleConCombo["displayField"] = 'sale_con_n';
saleConCombo["valueField"] = 'sale_con_v';
saleConCombo["hiddenName"] = 'sale_con_v';
saleConCombo["allowBlank"] = false;
saleConCombo["editable"] = false;
saleConCombo["typeAhead"] = true;
saleConCombo["mode"] = 'local';
saleConCombo["triggerAction"] = 'all';
saleConCombo["store"] = saleConStore;
saleConCombo["selectOnFocus"] = true;
saleConCombo["forceSelection"] = true;
saleConCombo["minChars"] = 2;

saleConCombo["listeners"] = {
	select:{fn:function(combo, value) {
		var orderQ = Ext.getCmp('ext-comp-1007');
		selItem = Ext.getCmp('ext-comp-1006');
		saleCon = parseInt( combo.getValue() );
		orderQty_g = parseFloat( orderQ.getValue());
		
		setPriceNDiscount(selItem.getValue(),saleCon,orderQty_g);
	}}
};

var orderQty = new Object();	
orderQty["xtype"] = "numberfield";
orderQty["allowBlank"] = false;
orderQty["readOnly"] = false;
orderQty["value"] = "0";
orderQty["enableKeyEvents"] = true;

orderQty["listeners"] = {
		change:{fn:function(text, n,o) {
			var salePrice = Ext.getCmp('ext-comp-1009');
			salePrice.setValue("");

			var qty = text.getValue();
			selItem = Ext.getCmp('ext-comp-1006');
			saleCon = parseInt( (Ext.getCmp('ext-comp-1008')).getValue() );

			(Ext.getCmp('ext-comp-1017')).setValue( parseInt( qty )  / parseInt( Ext.getCmp('ext-comp-1016').getValue() ));
			
			setPriceNDiscount(selItem.getValue(),saleCon,qty);

	    }}
		//,focus:{fn:function(text) {
	    //}}
	};
function setPriceNDiscount(item,con,qty)
{
	if( isNaN(qty ))
		qty = 0;
	
	var salePrice = Ext.getCmp('ext-comp-1009');
	var saleDis = Ext.getCmp('ext-comp-1010');
	
    Ext.Ajax.request({
        url : '<?=$screenId?>/getPriceCondition',
        method: 'POST',
        params :{item:item, con:con, qty: qty, vendorCode:selVendor},
        success: function ( result, request ) {
            		//alert("hello");

            		var jsonData = Ext.util.JSON.decode(result.responseText);
                     var price = jsonData.price;
                     var dis = jsonData.discount;
                     salePrice.setValue(price);
                     saleDis.setValue(dis);
              },
                 failure: function ( result, request ) {
                  var jsonData = Ext.util.JSON.decode(result.responseText);
                  var resultMessage = jsonData.data.result;
					 alert(resultMessage);
              }
      });

    
}

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

Ext.apply(Ext.form.VTypes, {
   issueQty: function(value, field)
   {
      if (value > Ext.getCmp('ext-comp-1012').getValue())
		return false;
      else
		return true; 
   },
 
   issueQtyText: '<?=lang('ER0001')?>'
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [orderNo,customerCombo,deliveryCombo,notes];
	var rightComp = [orderDate,poNo,deliveryDate,refDoc];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
	<?php $gname = "order"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	  		read    : '<?=${$gname."URL"}?>/view',  //<-- Not use
	  		create  : '<?=${$gname."URL"}?>/insertLedger',
	  		update  : '<?=${$gname."URL"}?>/update',
	  		destroy : '<?=${$gname."URL"}?>/destroy'
	  	},
	  	method: 'POST'
	});  
	<?php 
			$width = "auto";
			$height = "300";
			$initialLoad = true;
			$enableCollapse = false;
			$title = "";
			$autoSave = "false";
			include(APPPATH.'/views/common/simpleGrid2'.EXT);
			include(APPPATH.'/views/common/simpleAddEvent2'.EXT);
			include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
			include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
		?>

// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$gname	= "order";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
    function updateEvent(){
        if (fp.form.isValid()) {
            
            var obj = new Object();
            obj["params"] = new Object();
            obj["params"]["start"] = 0;
            obj["params"]["limit"] = pageLimit;
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
                orderDataStore.setBaseParam(key, value);
            }, this);

            orderDataStore.save();

        }
    }
    
    Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {

    	tmp = res.data;

  	   	Ext.Msg.show({
   		title:'หมายเลข Order',
   		msg: 'หมายเลข Order คือ ' + tmp[0]["order_no"],
           icon: Ext.MessageBox.INFO,
           buttons: Ext.Msg.OK
  		});
		
	    orderDataStore.removeAll();
	    
		var vendorCom = Ext.getCmp('ext-comp-1053'); 
		var deliCom = Ext.getCmp('ext-comp-1054');     	    
		vendorCom.setReadOnly(false);
		deliCom.setReadOnly(false);

	    fp.getForm().reset(); 
    });
        
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>