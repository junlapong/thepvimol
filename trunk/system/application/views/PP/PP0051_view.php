
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
$screenId = "PP0051";
$pkId = "item_code";

include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){

Ext.QuickTips.init();

// Global
var selItem = "";
var selOrder = "";
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
<?php // item FORM
	 $cname = "refDoc";
	 $pk = "ref_doc";
	 $fname = "ref_doc";
	 $dname = "ref_doc";
	 $vname = "ref_doc";
	 $url = $screenId."/refDocList";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $mode = "remote";
	 $initParam ="";
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	var qty = Ext.getCmp('ext-comp-1013');
	qty.setValue( "" );
    itemStore.removeAll();
	selOrder = combo.getValue();
	var itemCom = Ext.getCmp('ext-comp-1008'); 
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["query"] = selOrder;
    itemCom.clearValue(); 
    itemStore.load(obj);
    
}

<?php // item FORM
	 $cname = "item";
	 $pk = "item_code";
	 $fname = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = $screenId."/itemCodeList";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = false;
	 $mode = "local";
	 $initParam ="";
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
    if( selOrder != "STOCK" )
    {
        Ext.Ajax.request({
            url : '<?=$screenId?>/getOrderQty',
            method: 'POST',
            params : {item:combo.getValue(), order:selOrder},
            success: function ( result, request ) {
                        var jsonData = Ext.util.JSON.decode(result.responseText);
                        var qty = Ext.getCmp('ext-comp-1013'); 
                        qty.setValue( jsonData["data"][0]["order_qty"]);                    
                  },
                     failure: function ( result, request ) {
                      var jsonData = Ext.util.JSON.decode(result.responseText);
                      var resultMessage = jsonData.data.result;
    					 alert(resultMessage);
                  }
         });

    }
}

//var jobNo	 = formTextField1(false,false,'job_no','<?=lang('job_no')?>');	
//var ref_doc = formTextField1(false,false,'ref_doc','<?=lang('ref_doc')?>');
var jobDate  = formDateField1(false,false,'job_date','<?=lang('job_date')?>',new Date(),'Y-m-d');	
var jobQty 	 = formNumField1(false,false,'job_qty','<?=lang('job_qty')?>');
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [refDocCombo,itemCombo,notes];
	var rightComp = [jobDate,jobQty];
    var maindata = formMain1(leftComp,rightComp);
	
// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$gname	= "";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
	Ext.getCmp('UpdateActionorder').setDisabled(true);
    function updateEvent(){
    	//Ext.getCmp('UpdateActionorder').setDisabled(true); 
        if (fp.form.isValid()) {
        	var reqQtyTxt = Ext.getCmp('ext-comp-1013');
			if( reqQtyTxt.getValue() <= 0 )
			{
				alert("จำนวนสั่งผลิตไม่ถูกต้อง");
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

                            alert("หมายเลข Job คือ" + jsonData["job_no"]);
                            var jobNoTxt = Ext.getCmp('ext-comp-1007');
							jobNoTxt.setValue("");
							fp.getForm().reset(); 
                             
                      },
                         failure: function ( result, request ) {
                          var jsonData = Ext.util.JSON.decode(result.responseText);
                          var resultMessage = jsonData.data.result;
        					 alert(resultMessage);
                      }
             });

        }
    }

});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

	<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>