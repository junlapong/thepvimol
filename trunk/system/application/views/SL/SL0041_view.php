
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
$screenId = "SL0041";
$pkId = "item_code";

$col = "order";
${$col."URL"} 	 = $screenId;
${$col."PK"} 	 = $pkId;
${$col."Render"} = "none";
${$col."Editor"} = $col."Editor";
${$col} = array();
//	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
//	${$col}[1]		=	array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );

${$col}[0]		=	array("name"=>"inv_no","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );
${$col}[1]		=	array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
${$col}[2]		=	array("name"=>"order_date","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
${$col}[3]		=	array("name"=>"sale_price","type"=>"number","editor"=>"numFieldBlank,width:120","df"=>"" );
${$col}[4]		=	array("name"=>"customer_code","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );
${$col}[5]		=	array("name"=>"customer_name","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );
${$col}[6]		=	array("name"=>"sale_name","type"=>"string","editor"=>"textFieldBlank,width:100","df"=>"" );

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
pageLimit = 1500;
Ext.onReady(function(){

Ext.QuickTips.init();

// Global Define parameter and function
var selOrderNo = "";
var selInvNo = "";
var selPayPrice = 0;

function setCach(flag)
{
	if( flag )
	{
		Ext.getCmp('ext-comp-1035').enable();
		Ext.getCmp('ext-comp-1036').disable();
		Ext.getCmp('ext-comp-1037').disable();
		Ext.getCmp('ext-comp-1038').disable();
	
		Ext.getCmp('ext-comp-1044').disable();
		Ext.getCmp('ext-comp-1045').disable();
		Ext.getCmp('ext-comp-1046').disable();
	}else{
		Ext.getCmp('ext-comp-1035').disable();
		Ext.getCmp('ext-comp-1036').enable();
		Ext.getCmp('ext-comp-1037').enable();
		Ext.getCmp('ext-comp-1038').enable();
	
		Ext.getCmp('ext-comp-1044').enable();
		Ext.getCmp('ext-comp-1045').enable();
		Ext.getCmp('ext-comp-1046').enable();		
	}
}	
function setCHQ(flag)
{
	if( flag )
	{
		Ext.getCmp('ext-comp-1035').enable();
		Ext.getCmp('ext-comp-1036').enable();
		Ext.getCmp('ext-comp-1037').enable();
		Ext.getCmp('ext-comp-1038').enable();
	
		Ext.getCmp('ext-comp-1044').enable();
		Ext.getCmp('ext-comp-1045').enable();
		Ext.getCmp('ext-comp-1046').enable();
	}else{
		Ext.getCmp('ext-comp-1035').disable();
		Ext.getCmp('ext-comp-1036').disable();
		Ext.getCmp('ext-comp-1037').disable();
		Ext.getCmp('ext-comp-1038').disable();
	
		Ext.getCmp('ext-comp-1044').disable();
		Ext.getCmp('ext-comp-1045').disable();
		Ext.getCmp('ext-comp-1046').disable();		
	}
}

function setTrans(flag)
{
	if( flag )
	{
		Ext.getCmp('ext-comp-1035').disable();
		Ext.getCmp('ext-comp-1036').disable();
		Ext.getCmp('ext-comp-1037').disable();
		Ext.getCmp('ext-comp-1038').disable();
	
		Ext.getCmp('ext-comp-1044').enable();
		Ext.getCmp('ext-comp-1045').enable();
		Ext.getCmp('ext-comp-1046').enable();
	}else{
		Ext.getCmp('ext-comp-1035').enable();
		Ext.getCmp('ext-comp-1036').enable();
		Ext.getCmp('ext-comp-1037').enable();
		Ext.getCmp('ext-comp-1038').enable();
	
		Ext.getCmp('ext-comp-1045').disable();
		Ext.getCmp('ext-comp-1046').disable();
		Ext.getCmp('ext-comp-1047').disable();		
	}

}
var CHQBankStore = new Ext.data.SimpleStore({
    fields:['CHQ_bank_name']
   ,data:[	['BAY']
           ,['KTB']
           ,['SCB']
           ,['SCIB']
           ,['IBANK']
           ,['KBANK']
           ,['TMB']
           ,['UOB']
           ,['TISCO']
           ,['ACL']
           ,['BTB']
           ,['Kiatnakin']
           ,['SCNB']
           ,['TNC']
           ,['LHBANK']
           ,['CITI']
           ,['HSBC']
         ]
});
var paymentCondition = new Ext.data.SimpleStore({
    fields:['pay_con_v', 'pay_con_n']
   ,data:[['0','เงินสด'],['1', 'โอนเงิน'],['2', 'CHQ']]
});

var companyAccountStore = new Ext.data.SimpleStore({
    fields:['transfer_to']
   ,data:[
            ['สด']            	
           ,['107-0-69784-0']
           ,['107-3-08091-1']
           ,['777-0-00979-1']
           ,['026-2-05001-9']
           ,['210-3-00886-4']
          ]
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR

var orderNo	 		 = formTextField1(false,true,'order_no','<?=lang('order_no')?>');	
var invNo 			 = formTextField1(false,true,'inv_no','<?=lang('inv_no')?>');
var paymentNo  		 = formTextField1(false,false,'payment_no','<?=lang('payment_no')?>');	
var paymentTypeCombo = new Object();		
	paymentTypeCombo["xtype"] = 'combo';
	paymentTypeCombo["displayField"] = 'pay_con_n';
	paymentTypeCombo["valueField"] = 'pay_con_v';
	paymentTypeCombo["hiddenName"] = 'pay_con_v';
	paymentTypeCombo["allowBlank"] = false;
	paymentTypeCombo["editable"] = false;
	paymentTypeCombo["typeAhead"] = true;
	paymentTypeCombo["mode"] = 'local';
	paymentTypeCombo["triggerAction"] = 'all';
	paymentTypeCombo["store"] = paymentCondition;
	paymentTypeCombo["selectOnFocus"] = true;
	paymentTypeCombo["forceSelection"] = true;
	paymentTypeCombo["minChars"] = 2;
	paymentTypeCombo["name"] = 'payment_type';
	paymentTypeCombo["fieldLabel"] = '<?=lang('payment_type')?>';	
	paymentTypeCombo["listeners"] = {
		select:{fn:function(combo, value) {
			selPaymentType = parseInt( combo.getValue() );
			switch(selPaymentType)
			{
				case 0 : setCach(true);
						 break;
				case 1 : setTrans(true);
						 break;
				case 2 : setCHQ(true);
						 break;
				default: break;	
			}
		}}
	};

// var paymentType 	 = formTextField1(false,false,'job_no','<?=lang('payment_type')?>');
var planPrice 	 	 = formNumField1(false,true,'plan_price','<?=lang('plan_price')?>');
var actualPrice 	 = formNumField1(false,false,'payment','<?=lang('payment')?>');

//var accountNo  		 = formTextField1(false,false,'job_no','<?=lang('transfer_to')?>');	
var accountNoCombo = new Object();		
	accountNoCombo["xtype"] = 'combo';
	accountNoCombo["displayField"] = 'transfer_to';
	accountNoCombo["valueField"] = 'transfer_to';
	accountNoCombo["hiddenName"] = 'transfer_to';
	accountNoCombo["allowBlank"] = false;
	accountNoCombo["editable"] = false;
	accountNoCombo["typeAhead"] = true;
	accountNoCombo["mode"] = 'local';
	accountNoCombo["triggerAction"] = 'all';
	accountNoCombo["store"] = companyAccountStore;
	accountNoCombo["selectOnFocus"] = true;
	accountNoCombo["forceSelection"] = true;
	accountNoCombo["minChars"] = 2;
	accountNoCombo["name"] = 'transfer_to';
	accountNoCombo["fieldLabel"] = '<?=lang('transfer_to')?>';	
	accountNoCombo["listeners"] = {
			select:{fn:function(combo, value) {
	
			}}
		};
var accountRefNo	 = formTextField1(false,false,'trans_ref_code','<?=lang('trans_ref_code')?>');
var transferDate	 = formDateField1(false,false,'transfer_date','<?=lang('transfer_date')?>',new Date(),'Y-m-d');

var chqNo			 = formTextField1(false,false,'CHQ_NO','<?=lang('CHQ_NO')?>');
//var chqBank			 = formTextField1(false,false,'job_no','<?=lang('CHQ_bank_name')?>');
var chqBankCombo = new Object();		
	chqBankCombo["xtype"] = 'combo';
	chqBankCombo["displayField"] = 'CHQ_bank_name';
	chqBankCombo["valueField"] = 'CHQ_bank_name';
	chqBankCombo["hiddenName"] = 'CHQ_bank_name';
	chqBankCombo["allowBlank"] = false;
	chqBankCombo["editable"] = false;
	chqBankCombo["typeAhead"] = true;
	chqBankCombo["mode"] = 'local';
	chqBankCombo["triggerAction"] = 'all';
	chqBankCombo["store"] = CHQBankStore;
	chqBankCombo["selectOnFocus"] = true;
	chqBankCombo["forceSelection"] = true;
	chqBankCombo["minChars"] = 2;
	chqBankCombo["name"] = 'CHQ_bank_name';
	chqBankCombo["fieldLabel"] = '<?=lang('CHQ_bank_name')?>';	
	chqBankCombo["listeners"] = {
			select:{fn:function(combo, value) {
	
			}}
		};

var chqDate			 = formDateField1(false,false,'CHQ_date','<?=lang('CHQ_date')?>',new Date(),'Y-m-d');
var recvDate		 = formDateField1(false,false,'received_date','<?=lang('received_date')?>',new Date(),'Y-m-d');

var notes		 	 = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true,true,'0');	

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [orderNo,paymentNo,recvDate,chqDate,chqNo,chqBankCombo,notes];
	var rightComp = [invNo,paymentTypeCombo,transferDate,accountNoCombo,accountRefNo,planPrice,actualPrice];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
	<?php 
		$gname = "order";
		$width = "auto";
		$height = "300";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "กรุณาเลือกสินค้าที่ต้องการสั่งผลิต";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        //var obj = new Object();
        //obj["params"] = new Object();
        //obj["params"]["item_code"] = values['item_code'];
        selOrderNo = values['order_no'];
        selInvNo = values['inv_no'];
        selPayPrice = values['sale_price'];

        Ext.getCmp('ext-comp-1033').setValue(selOrderNo);
        Ext.getCmp('ext-comp-1042').setValue(selInvNo);
        Ext.getCmp('ext-comp-1047').setValue(selPayPrice);

    	Ext.getCmp('UpdateActionorder').setDisabled(false);
        
        //gpmenuDataStore.load(obj); // Update data
        //gpmenuEnableButton(false); // Enable Button

	}
	
// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$gname	= "order";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
	Ext.getCmp('UpdateActionorder').setDisabled(true);
    function updateEvent(){
    	//Ext.getCmp('UpdateActionorder').setDisabled(true); 
        if (fp.form.isValid()) {
        	var note = Ext.getCmp('ext-comp-1039').getValue() ;
        	var reqPrice = parseFloat( Ext.getCmp('ext-comp-1047').getValue() ).toFixed(2);
        	var payPrice = parseFloat( Ext.getCmp('ext-comp-1048').getValue() ).toFixed(2);
        	var vatPrice = parseFloat( reqPrice * 1.07 ).toFixed(2);
        	
			if( ( (vatPrice != payPrice) && (reqPrice != payPrice ) ) && note == "" )
			{
				alert("จำนวนเงินไม่ตรงกัน และ ไม่ได้ใส่หมายเหตุ");
				return;
			}
            
            var obj = new Object();
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
                obj[key] = value;
            }, this);

            Ext.Ajax.request({
                url : '<?=$screenId?>/updateJob',
                method: 'POST',
                params : obj,
                success: function ( result, request ) {
                            var jsonData = Ext.util.JSON.decode(result.responseText);

                            if( jsonData["success"] == true )
                            {
	                            orderDataStore.load({params: {start: 0, limit: pageLimit} });
	                            alert("หมายเลขใบกำกับ คือ " + jsonData["job_no"]);
	                            //var jobNoTxt = Ext.getCmp('ext-comp-1033');
								//jobNoTxt.setValue("");
							    fp.getForm().reset(); 
                            }else{
                            	alert(jsonData["message"]);
                            }							
                            //qtyTxt.setValue(jsonData["data"][0]["qty"]);
                             
                      },
                         failure: function ( result, request ) {
                          var jsonData = Ext.util.JSON.decode(result.responseText);
                          var resultMessage = jsonData.data.result;
        					 alert(resultMessage);
                      }
             });
	        //orderDataStore.save();
    		//orderDataStore.removeAll();	

        }else{
            alert("กรอกข้อมูลไม่ครบ กรุณาตรวจสอบข้อมูลใหม่");
        }
    }
    
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

	<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>