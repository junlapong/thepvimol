
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
$screenId = "PP0020";
$pkId = "item_code";

$col = "order";
${$col."URL"} 	 = $screenId;
${$col."PK"} 	 = $pkId;
${$col."Render"} = "none";
${$col."Editor"} = $col."Editor";
${$col} = array();
//	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
//	${$col}[1]		=	array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );

${$col}[0]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
${$col}[1]		=	array("name"=>"req_date","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
${$col}[2]		=	array("name"=>"current_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[3]		=	array("name"=>"plan_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[4]		=	array("name"=>"order_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[5]		=	array("name"=>"safty_stock","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[6]		=	array("name"=>"req_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );

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
var selItem = "";
var selReqQty = 0;
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR

var jobNo	 = formTextField1(false,false,'job_no','<?=lang('job_no')?>');	
var itemCode = formTextField1(false,true,'item_code','<?=lang('item_code')?>');
var jobDate  = formDateField1(false,false,'job_date','<?=lang('job_date')?>',new Date(),'Y-m-d');	
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);
var jobQty 	 = formNumField1(true,false,'job_qty','<?=lang('job_qty')?>');


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
	var leftComp  = [jobNo,itemCode,notes];
	var rightComp = [jobDate,jobQty];
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
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["item_code"] = values['item_code'];
        selItem = values['item_code'];
        selReqQty = values['req_qty'];

        var itemTxt = Ext.getCmp('ext-comp-1034');
        var reqQtyTxt = Ext.getCmp('ext-comp-1039');

        itemTxt.setValue(selItem);
        reqQtyTxt.setValue(selReqQty);
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
        	var reqQtyTxt = Ext.getCmp('ext-comp-1039');
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
                               var jobNoTxt = Ext.getCmp('ext-comp-1033');
   							   jobNoTxt.setValue("");
                               alert("หมายเลข Job คือ" + jsonData["job_no"]);
                               orderDataStore.load({params: {start: 0, limit: pageLimit} });
                            }else{
                            	alert(jsonData["message"]);
                            }	                             
						    //fp.getForm().reset(); 
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

        }
    }
    
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

	<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>