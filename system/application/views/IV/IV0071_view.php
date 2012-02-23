
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0071"; 
	$pkId = "id";
	
	$col = "receive";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]	=	array("name"=>	"id","type"=>"number"	,"editor"=>	"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );						
	${$col}[1]	=	array("name"=>	"item_code","type"=>"string","editor"=>	"readTextFieldNBlank,width:150","df"=>"" );						
	${$col}[2]	=	array("name"=>	"received_qty","type"=>	"number"	,"editor"=>	"numField,width:150","df"=>"" );						
	${$col}[3]	=	array("name"=>	"location_code","type"=>	"string"	,"editor"=>	"locaCombo,width:150" ,"df"=>"" );						
	
	${$col}[4]	=	array("name"=>	"received_no","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[5]	=	array("name"=>	"ref_doc_no","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[6]	=	array("name"=>	"received_date","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[7]	=	array("name"=>	"received_staff","type"=>	"string"	,"editor"=>	"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	
	${$col}[8]=	array("name"=>	"delete_flag","type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );						
	${$col}[9]=	array("name"=>	"notes","type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[10]=	array("name"=>	"created_date","type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[11]=	array("name"=>	"updated_date","type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[12]=	array("name"=>	"created_user","type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );						
	${$col}[13]=	array("name"=>	"updated_user","type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );						

	include(APPPATH.'/views/common/h_include'.EXT);
?>
<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){

var isClick = false;  // for protect double click

var recvStore = new Ext.data.SimpleStore({
    fields:['recv_type_v', 'recv_type_n']
   ,data:[
//        ['U', 'Unplan'],
       ['P', 'Plan']
   ]
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Form
var receivedNo = formTextField1(true,true,'received_no','<?=lang('received_no')?>');	
var refDocNo = formTextField1(false,false,'inv_no','<?=lang('inv_no')?>');	
var receivedDate = formDateField1(false,false,'received_date','<?=lang('received_date')?>','','Y-m-d');			
var recvType = formCombo1('recv_type','<?=lang('recv_type')?>','recv_type_n','recv_type_v','P',recvStore);		

<?php // Delivery No
	 $cname = "poNo";
	 $pk = "po_no";
	 $fname = "po_no";
	 $dname = "po_name";
	 $vname = "po_no";
	 $url = $screenId."/getPoNoList";
	 $editable = "false";
	 $allowBlank = "false";
	 $initialLoad = true;
	 $initParam ="";
	 $width = 200;
	 
	include(APPPATH.'/views/common/FormComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	isEdit = false;
	addClick = false;
	receiveEditor.stopEditing(0);
	
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["start"] = 0;
    obj["params"]["limit"] = pageLimit;
    obj["params"]["po_no"] = combo.getValue();
    receiveDataStore.removeAll();
    receiveDataStore.load(obj);
}

// Component in rowEditor
var textFieldBlank = rowEditTextField1(true);	
var textFieldNBlank = rowEditTextField1(false);
var readTextFieldNBlank = rowEditTextField1(false,true);
var numField = rowEditNumField1(false);


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

    Ext.QuickTips.init();

	// <-- End Grid Header
	var leftComp  = [receivedNo,poNoCombo,refDocNo];
	var rightComp = [receivedDate,recvType];
    var maindata = formMain1(leftComp,rightComp);
    
 // Grid vvv
	<?php $gname = "receive"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	    	read    : '<?=$screenId?>/viewPOItem',
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
		$title = "";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleGrid2'.EXT);
		//include(APPPATH.'/views/common/simpleAddEvent2'.EXT);
		//include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
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
                                
            Ext.iterate(fp.form.getValues(), function(key, value) { obj[key] = value; }, this);
            obj["data"] = new Object();

            var error = false;
            j = 0;
     	    for(var i = 0 ; i < receiveDataStore.getCount() ; i++)
    	    {
				if( receiveDataStore.getAt(i).get("location_code") == "" )
				{
					error = true;		
					break;
				}
				if( parseFloat( receiveDataStore.getAt(i).get("received_qty") ) == 0 )
						continue;
        	    obj["data"][j] = new Object();
        	    obj["data"][j]["item_code"] = receiveDataStore.getAt(i).get("item_code");
        	    obj["data"][j]["location_code"] = receiveDataStore.getAt(i).get("location_code");
        	    obj["data"][j]["lot_no"] = "000/00";
        	    obj["data"][j]["seq_no"] = "0";
        	    obj["data"][j]["received_qty"] = parseFloat( receiveDataStore.getAt(i).get("received_qty") );
        	    j++;
    	    }

    	    
     	   obj["data"] = Ext.util.JSON.encode(obj["data"]);
     	   
     	    if(error){
         	    alert("สถานที่จัดเก็บผิดพลาด: กรุณาตรวจสอบสถานที่จัดเก็บ");
     	    }else{
         	    if( !isClick )
         	    {
     	    		isClick = true;
     	    		submitData(obj);
         	    }	 
              //receiveDataStore.save();

              //Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
              //	receiveDataStore.removeAll();
              //});
     	    }

        }
    }

    function submitData(obj){
        Ext.Ajax.request({
            url : '<?=$screenId?>/insertLedger',
            method: 'POST',
            params : obj,
            success: function ( result, request ) {
                        var jsonData = Ext.util.JSON.decode(result.responseText);

                        alert("หมายเลขใบส่งของ คือ " + jsonData["receive_no"]);
						// Remove Updated Item                        
                        receiveDataStore.removeAll();
          
                		// Refresh Select Order list
                        poNoStore.load({params: {query: ''} });

		        	    fp.getForm().reset(); 
		        	    isClick = false;
		        	              
                  },
                     failure: function ( result, request ) {
                      var jsonData = Ext.util.JSON.decode(result.responseText);
                      var resultMessage = jsonData.data.result;
    					 alert(resultMessage);
                  }
         });        
    }


});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>