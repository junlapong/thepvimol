
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
$screenId = "QC0010";
$pkId = "id";

$col = "rawQC";
${$col."URL"} 	 = $screenId;
${$col."PK"} 	 = $pkId;
${$col."Render"} = "none";
${$col."Editor"} = $col."Editor";
${$col} = array();

${$col}[0]		=	array("name"=>"seq_no","type"=>"string","editor"=>"textFieldNBlank,width:45","df"=>"" );
${$col}[1]		=	array("name"=>"input_pp_date","type"=>"datetime","editor"=>"matDate,width:150","df"=>"" );
${$col}[2]		=	array("name"=>"input_qty","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[3]		=	array("name"=>"roll_height","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[4]		=	array("name"=>"roll_diameter","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[5]		=	array("name"=>"roll_weight","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );

${$col}[6]		=	array("name"=>"thickness1","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[7]		=	array("name"=>"thickness2","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[8]		=	array("name"=>"thickness3","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[9]		=	array("name"=>"thickness4","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[10]		=	array("name"=>"thickness5","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );

${$col}[11]		=	array("name"=>"weight1","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[12]		=	array("name"=>"weight2","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[13]		=	array("name"=>"weight3","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[14]		=	array("name"=>"weight4","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );
${$col}[15]		=	array("name"=>"weight5","type"=>"number","editor"=>"numFieldBlank,width:50","df"=>"" );


${$col}[16]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
${$col}[17]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
${$col}[18]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[19]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
${$col}[20]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
${$col}[21]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );

include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){

Ext.QuickTips.init();

// Global
var recvDate = "";
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR

<?php // unplan reason combo
	 $cname = "recvDate";
	 $pk = "received_date";
	 $fname = "received_date";
	 $dname = "received_date";
	 $vname = "received_date";
	 $url = $screenId."/getReceivedDate";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $initParam ="";
	 $width = "100";

	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{

		recvDate = combo.getValue();
		var itemCom = Ext.getCmp('ext-comp-1052'); 
		var lotCom = Ext.getCmp('ext-comp-1053'); 
	    itemCom.clearValue(); 
		lotCom.clearValue(); 

		itemCodeStore.removeAll();
		lotNoStore.removeAll();
		rawQCDataStore.removeAll();
		
	    var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["query"] = recvDate
	    
	    itemCodeStore.load(obj);
}

<?php // unplan reason combo
		 $cname = "itemCode";
		 $pk = "item_code";
		 $fname = "item_code";
		 $dname = "item_code";
		 $vname = "item_code";
		 $url = $screenId."/getItemCodeList";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = false;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	var itemCode = combo.getValue();
	var lotCom = Ext.getCmp('ext-comp-1053'); 
	rawQCDataStore.removeAll();
	lotCom.clearValue(); 
	   	
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["query"] = recvDate
    obj["params"]["itemCode"] = itemCode
    
 
    lotNoStore.load(obj);
}


<?php // unplan reason combo
		 $cname = "lotNo";
		 $pk = "lot_no";
		 $fname = "lot_no";
		 $dname = "lot_no";
		 $vname = "lot_no";
		 $url = $screenId."/getLotNoList";
		 $editable = "false";
		 $allowBlank = "false";
		 $initialLoad = false;
		 $initParam ="";
		 $width = "150";

		include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	rawQCDataStore.removeAll();
	rawQCEnableButton(false);
}

var notes 			= formTextField2(true,false,'notes','<?=lang('notes')?>','',300);


//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(false,false,null);	
var matDate = formDateField1(false,false,'input_pp_date','<?=lang('input_pp_date')?>',new Date(),'Y-m-d');


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [recvDateCombo,notes];
	var rightComp = [itemCodeCombo,lotNoCombo];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
 // Grid vvv
	<?php $gname = "rawQC"; ?>
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
	rawQCEnableButton(true);
	
// Final panel	
	<?php 
		$title = "กรุณากรอกข้อมูล...";
		$panelItem = "";
		$gname	= "rawQC";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
    function updateEvent(){

    	if (fp.form.isValid()) {

			if( rawQCDataStore.getCount() <= 0 || addClick == true || isEdit == true)
			{
				alert("ทำรายการไม่ถูก (ไม่มีข้อมูลการกรอกข้อมูล)");
				return;
			}
            
            var obj = new Object();
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
                obj[key] = value;
            }, this);
            obj["data"] = new Object();
            
     	    for(var i = 0 ; i < rawQCDataStore.getCount() ; i++)
    	    {
        	    
        	    obj["data"][i] = new Object();
        	    obj["data"][i]["seq_no"] = rawQCDataStore.getAt(i).get("seq_no");
        	    obj["data"][i]["production_date"] = rawQCDataStore.getAt(i).get("input_pp_date");
        	    obj["data"][i]["receive_qty"] = parseFloat(rawQCDataStore.getAt(i).get("input_qty"));
        	    obj["data"][i]["height"] = parseFloat(rawQCDataStore.getAt(i).get("roll_height"));
        	    obj["data"][i]["diameter"] = parseFloat(rawQCDataStore.getAt(i).get("roll_diameter"));
        	    obj["data"][i]["weight"] = parseFloat(rawQCDataStore.getAt(i).get("roll_weight"));
        	    
        	    obj["data"][i]["thickness1"] = parseFloat(rawQCDataStore.getAt(i).get("thickness1"));
        	    obj["data"][i]["thickness2"] = parseFloat(rawQCDataStore.getAt(i).get("thickness2"));
        	    obj["data"][i]["thickness3"] = parseFloat(rawQCDataStore.getAt(i).get("thickness3"));
        	    obj["data"][i]["thickness4"] = parseFloat(rawQCDataStore.getAt(i).get("thickness4"));
        	    obj["data"][i]["thickness5"] = parseFloat(rawQCDataStore.getAt(i).get("thickness5"));

        	    obj["data"][i]["weight1"] = parseFloat(rawQCDataStore.getAt(i).get("weight1"));
        	    obj["data"][i]["weight2"] = parseFloat(rawQCDataStore.getAt(i).get("weight2"));
        	    obj["data"][i]["weight3"] = parseFloat(rawQCDataStore.getAt(i).get("weight3"));
        	    obj["data"][i]["weight4"] = parseFloat(rawQCDataStore.getAt(i).get("weight4"));
        	    obj["data"][i]["weight5"] = parseFloat(rawQCDataStore.getAt(i).get("weight5"));
    	    }
     	   	obj["data"] = Ext.util.JSON.encode(obj["data"]);    
            Ext.Ajax.request({
                url : '<?=$screenId?>/updateJob',
                method: 'POST',
                params : obj,
                success: function ( result, request ) {
                            var jsonData = Ext.util.JSON.decode(result.responseText);

						    alert(jsonData["message"]);
						    fp.getForm().reset();

							rawQCEnableButton(true);
							rawQCDataStore.removeAll();
 
                             
                      },
                         failure: function ( result, request ) {
    	                     var jsonData = Ext.util.JSON.decode(result.responseText);
	       					 alert(jsonData["message"]);
                      }
             });

        }
    }
    
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>