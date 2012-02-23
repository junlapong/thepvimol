
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
$screenId = "PP0070";
$pkId = "id";

$col = "vac";
${$col."URL"} 	 = $screenId;
${$col."PK"} 	 = $pkId;
${$col."Render"} = "none";
${$col."Editor"} = $col."Editor";
${$col} = array();

${$col}[0]		=	array("name"=>"input_lot","type"=>"string","editor"=>"matLotCombo,width:70","df"=>"" );
${$col}[1]		=	array("name"=>"input_pp_date","type"=>"datetime","editor"=>"matDate,width:100","df"=>"" );
${$col}[2]		=	array("name"=>"input_qty","type"=>"number","editor"=>"numFieldBlank,width:70","df"=>"" );
${$col}[3]		=	array("name"=>"total_mat_weight_qty","type"=>"number","editor"=>"numFieldBlank,width:70","df"=>"" );

${$col}[4]		=	array("name"=>"finish_A_qty","type"=>"number","editor"=>"numFieldBlank,width:70","df"=>"" );
${$col}[5]		=	array("name"=>"finish_B_qty","type"=>"number","editor"=>"numFieldBlank,width:70","df"=>"" );
${$col}[6]		=	array("name"=>"lost_qty","type"=>"number","editor"=>"numFieldBlank,width:60","df"=>"" );

${$col}[7]		=	array("name"=>"before_avg_thickness","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[8]		=	array("name"=>"after_avg_thickness","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );

${$col}[9]		=	array("name"=>"crack_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[10]		=	array("name"=>"soft_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[11]		=	array("name"=>"dimension_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[12]		=	array("name"=>"rumple_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[13]		=	array("name"=>"glue_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[14]		=	array("name"=>"color_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[15]		=	array("name"=>"film_stick_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[16]		=	array("name"=>"film_rumple_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[17]		=	array("name"=>"film_distort_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );
${$col}[18]		=	array("name"=>"dirty_qty","type"=>"number","editor"=>"numFieldBlank,width:40","df"=>"" );



${$col}[19]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
${$col}[20]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
${$col}[21]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[22]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[23]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
${$col}[24]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );

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
	var itemTxt = Ext.getCmp('ext-comp-1055');

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
<?php // unplan reason combo
		 $cname = "matCode";
		 $pk = "mat_code";
		 $fname = "material_code";
		 $dname = "mat_code";
		 $vname = "mat_code";
		 $url = $screenId."/getMaterialList";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = true;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		vacEnableButton(false);
		var matCode = combo.getValue();
		var lotCom = Ext.getCmp('ext-comp-1007'); 
	    var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["query"] = matCode
	    lotCom.clearValue(); 
	    matLotStore.load(obj);
	}
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
<?php // unplan reason combo
		 $cname = "machineCode";
		 $pk = "machine_code";
		 $fname = "machine_code";
		 $dname = "machine_code";
		 $vname = "machine_code";
		 $url = $screenId."/getMachineList";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = true;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	}
<?php // unplan reason combo
		 $cname = "leadStaff";
		 $pk = "lead_code";
		 $fname = "lead_staff";
		 $dname = "lead_name";
		 $vname = "lead_code";
		 $url = $screenId."/getLeadName";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = true;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	}

<?php // unplan reason combo
		 $cname = "m1Staff";
		 $pk = "staff2_code";
		 $fname = "m1_staff";
		 $dname = "staff_name";
		 $vname = "staff1_code";
		 $url = $screenId."/getStaffName";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = true;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	}

<?php // unplan reason combo
		 $cname = "m2Staff";
		 $pk = "staff2_code";
		 $fname = "m2_staff";
		 $dname = "staff_name";
		 $vname = "staff2_code";
		 $url = $screenId."/getStaffName";
		 $editable = "false";
		 $allowBlank = "true";
		 $initialLoad = true;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	}
<?php // unplan reason combo
		 $cname = "m3Staff";
		 $pk = "staff3_code";
		 $fname = "m3_staff";
		 $dname = "staff_name";
		 $vname = "staff3_code";
		 $url = $screenId."/getStaffName";
		 $editable = "false";
		 $allowBlank = "true";
		 $initialLoad = true;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	}	
//var jobQty 	 		= formNumField1(true,false,'job_qty','<?=lang('job_qty')?>');
var finishedFlag = new Ext.form.Checkbox({
								fieldLabel: '<?=lang('finished_flag')?>',
								name: 'finished_flag',
								checked:false
							});
var frameAvg 		= formNumField1(false,false,'frame_avg_height','<?=lang('frame_avg_height')?>');
var frameL	 		= formNumField1(false,false,'frame_l_height','<?=lang('frame_l_height')?>');
var frameH 			= formNumField1(false,false,'frame_h_height','<?=lang('frame_h_height')?>');


//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(false,false,'0');	
var matDate = formDateField1(false,false,'input_pp_date','<?=lang('input_pp_date')?>',new Date(),'Y-m-d');

<?php 
	// Generate RowEdit itemCombo
	 $cname = "matLot";
	 $pk = "lot_no";
	 $dname = "lot_no";
	 $vname = "lot_no";
	 $url = $screenId."/getLotNo";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList2'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	var matCom = Ext.getCmp('ext-comp-1056'); 
	matCom.setReadOnly(true);
}


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [jobNoCombo,itemCode,matCodeCombo,machineCodeCombo,frameL,frameH,frameAvg,notes];
	var rightComp = [ProductionDate,startTime,finishTime,leadStaffCombo,m1StaffCombo,m2StaffCombo,m3StaffCombo,finishedFlag];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
 // Grid vvv
	<?php $gname = "vac"; ?>
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

	}
	vacEnableButton(true);
	
// Final panel	
	<?php 
		$title = "กรุณากรอกข้อมูล...";
		$panelItem = "";
		$gname	= "vac";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
    function updateEvent(){
    	//Ext.getCmp('UpdateActionorder').setDisabled(true); 
        if (fp.form.isValid()) {

			if( vacDataStore.getCount() <= 0 || addClick == true || isEdit == true)
			{
				alert("ทำรายการไม่ถูก (ไม่มีข้อมูลการผลิต)");
				return;
			}
            
            var obj = new Object();
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
                obj[key] = value;
            }, this);
            obj["data"] = new Object();
            
     	    for(var i = 0 ; i < vacDataStore.getCount() ; i++)
    	    {
        	    obj["data"][i] = new Object();
        	    obj["data"][i]["input_lot"] = vacDataStore.getAt(i).get("input_lot");
        	    obj["data"][i]["input_pp_date"] = vacDataStore.getAt(i).get("input_pp_date");
        	    obj["data"][i]["input_qty"] = parseFloat(vacDataStore.getAt(i).get("input_qty"));
        	    obj["data"][i]["total_mat_weight_qty"] = parseFloat(vacDataStore.getAt(i).get("total_mat_weight_qty"));
        	    obj["data"][i]["finish_A_qty"] = parseFloat(vacDataStore.getAt(i).get("finish_A_qty"));
        	    obj["data"][i]["finish_B_qty"] = parseFloat(vacDataStore.getAt(i).get("finish_B_qty"));
        	    obj["data"][i]["lost_qty"] = parseFloat(vacDataStore.getAt(i).get("lost_qty"));
        	    
        	    obj["data"][i]["before_avg_thickness"] = parseFloat(vacDataStore.getAt(i).get("before_avg_thickness"));
        	    obj["data"][i]["after_avg_thickness"] = parseFloat(vacDataStore.getAt(i).get("after_avg_thickness"));

        	    obj["data"][i]["crack_qty"] = parseFloat(vacDataStore.getAt(i).get("crack_qty"));
        	    obj["data"][i]["soft_qty"] = parseFloat(vacDataStore.getAt(i).get("soft_qty"));
        	    obj["data"][i]["dimension_qty"] = parseFloat(vacDataStore.getAt(i).get("dimension_qty"));
        	    obj["data"][i]["rumple_qty"] = parseFloat(vacDataStore.getAt(i).get("rumple_qty"));
        	    obj["data"][i]["glue_qty"] = parseFloat(vacDataStore.getAt(i).get("glue_qty"));
        	    obj["data"][i]["color_qty"] = parseFloat(vacDataStore.getAt(i).get("color_qty"));
        	    obj["data"][i]["film_stick_qty"] = parseFloat(vacDataStore.getAt(i).get("film_stick_qty"));
        	    obj["data"][i]["film_rumple_qty"] = parseFloat(vacDataStore.getAt(i).get("film_rumple_qty"));
        	    obj["data"][i]["film_distort_qty"] = parseFloat(vacDataStore.getAt(i).get("crack_qty"));
        	    obj["data"][i]["dirty_qty"] = parseFloat(vacDataStore.getAt(i).get("dirty_qty"));
        	    
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
						    alert(jsonData["message"]);
						    fp.getForm().reset();
							var matCom = Ext.getCmp('ext-comp-1056'); 
							matCom.setReadOnly(false);
							vacEnableButton(true);
							vacDataStore.removeAll();
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

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>