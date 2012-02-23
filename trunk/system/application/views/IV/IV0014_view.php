
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0014"; 
	$pkId = "id";
	
	$col = "receive";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]	=	array("name"=>	"id","type"=>"number"	,"editor"=>	"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );						
	${$col}[1]	=	array("name"=>	"item_code","type"=>"string","editor"=>	"itemCombo,width:150","df"=>"" );						
	${$col}[2]	=	array("name"=>	"location_code","type"=>	"string"	,"editor"=>	"locaCombo,width:150" ,"df"=>"" );						
	${$col}[3]	=	array("name"=>	"received_no","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[4]	=	array("name"=>	"ref_doc_no","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[5]	=	array("name"=>	"received_date","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[6]	=	array("name"=>	"received_staff","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[7]	=	array("name"=>	"lot_no","type"=>	"string"	,"editor"=>	"lot,width:100","df"=>"000/00" );						
	${$col}[8]	=	array("name"=>	"seq_no","type"=>	"string"	,"editor"=>	"seq,width:80","df"=>"0" );						
	${$col}[9]	=	array("name"=>	"received_qty","type"=>	"number"	,"editor"=>	"numField,width:150","df"=>"" );						
	${$col}[10]=	array("name"=>	"delete_flag","type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );						
	${$col}[11]=	array("name"=>	"notes","type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[12]=	array("name"=>	"created_date","type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[13]=	array("name"=>	"updated_date","type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[14]=	array("name"=>	"created_user","type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );						
	${$col}[15]=	array("name"=>	"updated_user","type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );						

	include(APPPATH.'/views/common/h_include'.EXT);
?>
<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">

var recvStore = new Ext.data.SimpleStore({
    fields:['recv_type_v', 'recv_type_n']
   ,data:[
        ['U', 'Unplan']
       //,['P', 'Plan']
   ]
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

var receivedNo = formTextField1(true,true,'received_no','<?=lang('received_no')?>');	
var refDocNo = formTextField1(true,true,'ref_doc_no','<?=lang('ref_doc_no')?>');	
var receivedDate = formDateField1(false,false,'received_date','<?=lang('received_date')?>','','Y-m-d');			
var recvType = formCombo1('recv_type','<?=lang('recv_type')?>','recv_type_n','recv_type_v','U',recvStore);		

<?php // unplan reason combo
	 $cname = "urReason";
	 $pk = "ur_reason_val";
	 $fname = "ur_reason_disp";
	 $dname = "ur_reason_disp";
	 $vname = "ur_reason_val";
	 $url = $screenId."/getURReasonCombo";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $value = "ur_reason-1";
	 $readonly = true;
	 $initParam ="";
     $width = "200";
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
	$value = "";
	$readonly = "";
?>
function <?=$cname?>OnSelect(combo,value)
{
	//selDeli = combo.getValue();
}

// Component in rowEditor
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var lot = rowEditTextField1(true,true,'000/00');		
var seq = rowEditTextField1(true,true,'0');	
var numField = rowEditNumField1(false);
<?php 
	// Generate RowEdit itemCombo
	 $cname = "item";
	 $pk = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = "../MT/MT0010/itemCodeList";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	var loCom = Ext.getCmp('ext-comp-1006'); 
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["item"] = combo.getValue();
	loCom.clearValue(); 
	locaStore.load(obj);
}

<?php 
	// Generate RowEdit itemCombo
	 $cname = "loca";
	 $pk = "location_code";
	 $dname = "location_name";
	 $vname = "location_code";
	 $url = "../MT/MT0040/getLocaByItem";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList2'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{

}

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
    Ext.QuickTips.init();

	// <-- End Grid Header
	var leftComp  = [receivedNo,refDocNo,urReasonCombo];
	var rightComp = [receivedDate,recvType];
    var maindata = formMain1(leftComp,rightComp);
    
 // Grid vvv
	<?php $gname = "receive"; ?>
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
		$initialLoad = true;
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
		locaStore.load(obj);
		selRow = row;
    }
	// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$gname	= "receive";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>

    function updateEvent(){
        if (fp.form.isValid()) {
            var s = '';
            
            var obj = new Object();
            obj["params"] = new Object();
            obj["params"]["start"] = 0;
            obj["params"]["limit"] = pageLimit;
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
    			  // ADD Form param
                receiveDataStore.setBaseParam(key, value);
            }, this);

            receiveDataStore.save();

            Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
            	receiveDataStore.removeAll();
            });

        }
    }


});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>