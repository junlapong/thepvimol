
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
$screenId = "PP0072";
$pkId = "id";

$col = "kae";
${$col."URL"} 	 = $screenId;
${$col."PK"} 	 = $pkId;
${$col."Render"} = "none";
${$col."Editor"} = $col."Editor";
${$col} = array();
//	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
//	${$col}[1]		=	array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );

//${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
//${$col}[1]		=	array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank","df"=>"" );
//${$col}[2]		=	array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[3]		=	array("name"=>"machine_code","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[4]		=	array("name"=>"production_date","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[5]		=	array("name"=>"start_time","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[6]		=	array("name"=>"finish_time","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[7]		=	array("name"=>"lead_staff","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[8]		=	array("name"=>"m1_staff","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[9]		=	array("name"=>"m2_staff","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
${$col}[0]		=	array("name"=>"staff_code","type"=>"string","editor"=>"staffCombo,width:150","df"=>"" );

${$col}[1]		=	array("name"=>"finish_A_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[2]		=	array("name"=>"finish_B_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
${$col}[3]		=	array("name"=>"lost_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );
//${$col}[6]		=	array("name"=>"out_unit_code","type"=>"string","editor"=>"textFieldBlank,width:150","df"=>"" );
//${$col}[17]		=	array("name"=>	"finished_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );


${$col}[4]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
${$col}[5]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
${$col}[6]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[7]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[8]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
${$col}[9]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );

include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){

Ext.QuickTips.init();

// Global
var selItem = "";
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR

<?php // unplan reason combo
	 $cname = "jobNo";
	 $pk = "job_no";
	 $fname = "job_no";
	 $dname = "job_no";
	 $vname = "job_no";
	 $url = $screenId."/getJobNoList";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $initParam ="";
	 $width = "100";

	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	kaeEnableButton(false);
	var itemTxt = Ext.getCmp('ext-comp-1040');

    Ext.Ajax.request({
        url : '<?=$screenId?>/getItemCode',
        method: 'POST',
        params : {query:combo.getValue()},
        success: function ( result, request ) {
                    var jsonData = Ext.util.JSON.decode(result.responseText);
                    itemTxt.setValue( jsonData["data"][0]["item_code"]);                    
              },
                 failure: function ( result, request ) {
                  var jsonData = Ext.util.JSON.decode(result.responseText);
                  var resultMessage = jsonData.data.result;
					 alert(resultMessage);
              }
     });
}

var itemCode 		= formTextField1(false,true,'item_code','<?=lang('item_code')?>');
var ProductionDate  = formDateField1(false,false,'production_date','<?=lang('production_date')?>',new Date(),'Y-m-d');
var startTime		= new Ext.form.TimeField({
							fieldLabel: '<?=lang('start_time')?>',
							name: 'starttime',
							editable:false,
							format:"H:i",
							value:"08:00"
						});
var finishTime		= new Ext.form.TimeField({
							fieldLabel: '<?=lang('finish_time')?>',
							name: 'finishTime',
							editable:false,
							format:"H:i",
							value:"17:00"
						});
var notes 			= formTextField2(true,false,'notes','<?=lang('notes')?>','',300);
var packingQty 	 = formNumField1(false,false,'packing_qty','<?=lang('packing_qty')?>');
var finishedFlag = new Ext.form.Checkbox({
								fieldLabel: '<?=lang('finished_flag')?>',
								name: 'finished_flag',
								checked:false
							});

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(false,false,'0');	

<?php // unplan reason combo
		 $cname = "staff";
		 $pk = "staff_code";
		 $dname = "staff_name";
		 $vname = "staff_code";
		 $url = $screenId."/getStaffName";
		 $editable = "false";
		 $allowBlank = "false";

		include(APPPATH.'/views/common/editRowComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	}


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [jobNoCombo,itemCode,packingQty,notes];
	var rightComp = [ProductionDate,startTime,finishTime,finishedFlag];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
 // Grid vvv
	<?php $gname = "kae"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	    	read    : '<?=$screenId?>/initial',
	    	create  : '<?=$screenId?>/insertLedger',
	    	update  : '<?=$screenId?>/updates',
	    	destroy : '<?=$screenId?>/destroys'
	  	},
	  	method: 'POST'
	});  
	<?php 
		$width = "auto";
		$height = "300";
		$initialLoad = false;
		$enableCollapse = false;
		$title = "กรุณาใส่ ข้อมูลการผลิต ...";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleGrid2'.EXT);
		include(APPPATH.'/views/common/simpleAddEvent2'.EXT);
		include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleInitialButton1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        var obj = new Object();
        /*obj["params"] = new Object();
        obj["params"]["item_code"] = values['item_code'];
        selItem = values['item_code'];
        selReqQty = values['req_qty'];

        var itemTxt = Ext.getCmp('ext-comp-1034');
        var reqQtyTxt = Ext.getCmp('ext-comp-1039');

        itemTxt.setValue(selItem);
        reqQtyTxt.setValue(selReqQty);
    	Ext.getCmp('UpdateActionorder').setDisabled(false);*/
        
        //gpmenuDataStore.load(obj); // Update data
        //gpmenuEnableButton(false); // Enable Button

	}
	kaeEnableButton(true);
	
// Final panel	
	<?php 
		$title = "กรุณากรอกข้อมูล...";
		$panelItem = "";
		$gname	= "kae";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
	//Ext.getCmp('UpdateActionorder').setDisabled(true);
    function updateEvent(){
    	//Ext.getCmp('UpdateActionorder').setDisabled(true); 
        if (fp.form.isValid()) {

			if( kaeDataStore.getCount() <= 0 || addClick == true || isEdit == true)
			{
				alert("ทำรายการไม่ถูก (ไม่มีข้อมูลการผลิต)");
				return;
			}
            
            var obj = new Object();
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
                obj[key] = value;
            }, this);
            obj["data"] = new Object();
            
     	    for(var i = 0 ; i < kaeDataStore.getCount() ; i++)
    	    {

        	    obj["data"][i] = new Object();
        	    obj["data"][i]["staff_code"] = kaeDataStore.getAt(i).get("staff_code");
        	    obj["data"][i]["finish_A_qty"] = parseFloat(kaeDataStore.getAt(i).get("finish_A_qty"));
        	    obj["data"][i]["finish_B_qty"] = parseFloat(kaeDataStore.getAt(i).get("finish_B_qty"));
        	    obj["data"][i]["lost_qty"] = parseFloat(kaeDataStore.getAt(i).get("lost_qty"));

    	    }
     	   	obj["data"] = Ext.util.JSON.encode(obj["data"]);    
            Ext.Ajax.request({
                url : '<?=$screenId?>/updateJob',
                method: 'POST',
                params : obj,
                success: function ( result, request ) {
                            var jsonData = Ext.util.JSON.decode(result.responseText);
                            //orderDataStore.load({params: {start: 0, limit: pageLimit} });
                            //alert("หมายเลข Job คือ" + jsonData["job_no"]);
                            //var jobNoTxt = Ext.getCmp('ext-comp-1033');
							//jobNoTxt.setValue("");
						    fp.getForm().reset(); 
						    alert(jsonData["message"]);
							kaeDataStore.removeAll();
                            //qtyTxt.setValue(jsonData["data"][0]["qty"]);
                             
                      },
                         failure: function ( result, request ) {
                          var jsonData = Ext.util.JSON.decode(result.responseText);
                          //var resultMessage = jsonData.data.result;
        					 alert(jsonData["message"]);
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
<select name="machine_side" id="machine_side" style="display: none;">
    <option value="A">A</option>
    <option value="B">B</option>
</select>
<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>