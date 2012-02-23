
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
// Korat Job_control
$screenId = "PP0811";
$pkId = "item_code";

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
<?php // item FORM
	 $cname = "item";
	 $pk = "item_code";
	 $fname = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = $screenId."/itemCodeList";
	 $editable = "true";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $mode = "remote";
	 $initParam ="";
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{

}

var jobNo	 = formTextField1(true,true,'job_no','<?=lang('job_no')?>');	
var ref_doc = formTextField1(true,false,'ref_doc','<?=lang('ref_doc')?>');
var jobDate  = formDateField1(false,false,'job_date','<?=lang('job_date')?>',"",'Y-m-d');	
var jobQty 	 = formNumField1(false,false,'job_qty','<?=lang('job_qty')?>');
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [jobNo,itemCombo,notes];
	var rightComp = [jobDate,jobQty,ref_doc];
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

	                           if( jsonData["success"] == true )
	                            {
	                               	alert("หมายเลข Job คือ" + jsonData["job_no"]);
	   								fp.form.reset();
	                            }else{
	                            	alert(jsonData["message"]);
	                            }	
                             
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