
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PU0012"; 
	$pkId = "id";
	
	$col = "reciss";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();

	//left array						
	${$col}[0]=array("name"=>"id","type"=>"string" ,"editor"=>"textFieldBlank, hidden: true , hideable: false");		
	${$col}[1]=array("name"=>"item_code","type"=>"string" ,"editor"=>"textFieldBlank,width:110");		
	${$col}[2]=array("name"=>"item_name","type"=>"string" ,"editor"=>"textFieldBlank,width:200");		
	${$col}[3]=array("name"=>"order_qty","type"=>"string" ,"editor"=>"textFieldBlank,width:80");		
	${$col}[4]=array("name"=>"pr_count","type"=>"string" ,"editor"=>"textFieldBlank,width:50");		
	
	${$col}[5]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[6]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[7]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[8]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[9]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[10]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );						
	
	$col = "riDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]=array("name"=>"id","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"");						
	${$col}[1]=array("name"=>"vendor_code","type"=>"string","editor"=>"textFieldBlank,width:50","df"=>"" );						
	${$col}[2]=array("name"=>"vendor_name","type"=>"string","editor"=>"textFieldBlank,width:120","df"=>"" );						
	${$col}[3]=array("name"=>"price_qty","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[4]=array("name"=>"unit","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );						
	${$col}[5]=array("name"=>"step1_discount_rate","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );						
	${$col}[6]=array("name"=>"step2_discount_rate","type"=>"string","editor"=>"textFieldBlank,width:60","df"=>"" );
	
	${$col}[7]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[8]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[9]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[10]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[11]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[12]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	
	
	$col = "order";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]		=	array("name"=>"po_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	
	${$col}[2]		=	array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:200","df"=>"" );
	${$col}[3]		=	array("name"=>"request_qty","type"=>"number","editor"=>"numReadFieldBlank,width:80","df"=>"" );
	${$col}[4]		=	array("name"=>"order_qty","type"=>"number","editor"=>"numField,width:80","df"=>"" );
	${$col}[5]		=	array("name"=>"sale_price","type"=>"number","editor"=>"numReadFieldBlank,width:100","df"=>"" );
	${$col}[6]		=	array("name"=>"discount1","type"=>"number","editor"=>"numReadFieldBlank,width:100","df"=>"" );
	${$col}[7]		=	array("name"=>"discount2","type"=>"number","editor"=>"numReadFieldBlank,width:100","df"=>"" );
	
	${$col}[8]		=	array("name"=>"ref_doc","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[9]		=	array("name"=>"po_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[10]		=	array("name"=>"sale_condition","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[11]		=	array("name"=>"customer_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );	

	${$col}[12]		=	array("name"=>"finished_flag","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[13]		=	array("name"=>"finished_reason","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[14]		=	array("name"=>"finished_date","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[15]		=	array("name"=>"finished_approver","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	
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
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
var refDoc = formTextField2(false,false,'ref_doc','<?=lang('ref_doc')?>','');
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);
var poDate = formDateField1(false,false,'po_date','<?=lang('po_date')?>',new Date(),'Y-m-d');	


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
	selItem = "";
	selVendor = combo.getValue();
	var itemCom = Ext.getCmp('ext-comp-1056'); 
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["query"] = combo.getValue();
    itemCom.clearValue(); 
	itemStore.load(obj);
}

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	
var numReadFieldBlank = rowEditNumField1(false,true);	
var numField = rowEditNumField1(false,false,'','issueQty');
<?php 
	// Generate RowEdit itemCombo
	 $cname = "item";
	 $pk = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = "../common/ITEM/getRequestPurchaseItemByVendorList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList2'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	var vendorCom = Ext.getCmp('ext-comp-1119'); 
	var reqCom = Ext.getCmp('ext-comp-1057'); 
	var priceCom = Ext.getCmp('ext-comp-1059'); 
	var disCom = Ext.getCmp('ext-comp-1060'); 
	Ext.getCmp('ext-comp-1058').setValue("");
	reqCom.setValue("");
	priceCom.setValue("");
	disCom.setValue("");
    vendorCom.setReadOnly(true);
		
    Ext.Ajax.request({
        url : '../common/ITEM/getRequestPurchaseItemByVendorList',
        method: 'POST',
        params :{query:selVendor, item_code: combo.getValue()},
        success: function ( result, request ) {
            		 var jsonData = Ext.util.JSON.decode(result.responseText);
					reqCom.setValue(jsonData["data"][0]["order_qty"])
                    priceCom.setValue(jsonData["data"][0]["price"]);
                    disCom.setValue(jsonData["data"][0]["step1_discount_rate"]);
              },
                 failure: function ( result, request ) {
                  var jsonData = Ext.util.JSON.decode(result.responseText);
                  var resultMessage = jsonData.data.result;
					 alert(resultMessage);
              }
      });

	//saleCon = parseInt( (Ext.getCmp('ext-comp-1008')).getValue() );

	//setPriceNDiscount(combo.getValue(),saleCon,orderQty_g);
	
	//vendorCom.setReadOnly(true);
	//deliCom.setReadOnly(true);
	
}

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.apply(Ext.form.VTypes, {
   issueQty: function(value, field)
   {
      if (value < Ext.getCmp('ext-comp-1057').getValue())
		return false;
      else
		return true; 
   },
 
   issueQtyText: '<?=lang('ER0002')?>'
});
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [customerCombo,notes];
	var rightComp = [poDate,refDoc];
    var maindata = formMain1(leftComp,rightComp);


 // PR Grid vvv
	<?php 
		$gname = "reciss";
		$width = "auto";
		$height = "200";
		$initialLoad = true;
		$view = "viewPRItem";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["item_code"] = values['item_code'];
        
        riDetailDataStore.load(obj); // Update data
        //riDetailEnableButton(false); // Enable Button

	}

	// ReadOnly Grid
	<?php 
		$gname = "riDetail";
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$view = "viewVendor";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}
    
// PO Grid vvv
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
// FOR DETAIL 
	<?php 
		$render = $screenId;
	 	$leftWidth = 0.5;
	 	$rightWidth = 0.5;
	 	$leftComp = "reciss";
	 	$rightComp = "riDetail";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel2_diffName'.EXT);
	?>

	
// FOR PO CREATOR 
	<?php 
		$title = "เปิด PO";
		$panelItem = "";
		$gname	= "order";
		$fitem  = "maindata";
		$render = $screenId."_detail1";
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
    	Ext.getCmp('ext-comp-1119').setReadOnly(false);
    	Ext.getCmp('ext-comp-1119').clearValue(); 
    	Ext.getCmp('ext-comp-1056').clearValue();
    	tmp = res.data;
  	   	Ext.Msg.show({
   		title:'หมายเลข Order',
   		msg: 'หมายเลข Order คือ ' + tmp[0]["po_no"],
           icon: Ext.MessageBox.INFO,
           buttons: Ext.Msg.OK
  		});
	    orderDataStore.removeAll();
	    
	    fp.getForm().reset(); 
	    
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;

        customerStore.load(obj);
        recissDataStore.load(obj);
        
    });
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>