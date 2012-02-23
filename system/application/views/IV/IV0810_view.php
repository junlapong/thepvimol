
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0810"; 
	$pkId = "id";
	
	$col = "receive";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]	=	array("name"=>	"id","type"=>"number"	,"editor"=>	"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );						
	${$col}[1]	=	array("name"=>	"item_code","type"=>"string","editor"=>	"itemCombo,width:150","df"=>"" );						
	${$col}[2]	=	array("name"=>	"lot_no","type"=>	"string"	,"editor"=>	"jobCombo,width:100","df"=>"" );						
	//${$col}[2]	=	array("name"=>	"seq_no","type"=>	"string"	,"editor"=>	"readTextFieldNBlank,width:80","df"=>"" );						
	//${$col}[4]	=	array("name"=>	"location_code","type"=>	"string"	,"editor"=>	"locaCombo,width:150" ,"df"=>"" );						
	${$col}[3]	=	array("name"=>	"received_qty","type"=>	"number"	,"editor"=>	"numField,width:150","df"=>"" );						
	
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

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//           Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
  	Ext.QuickTips.init();

    var isClick = false;
	var recvStore = new Ext.data.SimpleStore({
	    fields:['recv_type_v', 'recv_type_n']
	   ,data:[ //        ['U', 'Unplan'],
	       ['P', 'Plan']
	   ]
	});

	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//             Component define area  
	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	// Form
	var receivedNo = formTextField1(true,true,'received_no','<?=lang('received_no')?>');	
	var refDocNo = formTextField1(true,true,'ref_doc_no','<?=lang('ref_doc_no')?>');	
	var receivedDate = formDateField1(false,false,'received_date','<?=lang('received_date')?>','','Y-m-d');			
	//var recvType = formCombo1('recv_type','<?=lang('recv_type')?>','recv_type_n','recv_type_v','P',recvStore);		
	
	// Component in rowEditor
	var textFieldBlank = rowEditTextField1(true);	
	var textFieldNBlank = rowEditTextField1(false);
	var readTextFieldNBlank = rowEditTextField1(false,true);
	var numField = rowEditNumField1(false);
	


<?php 
	// Generate RowEdit itemCombo
	 $cname = "job";
	 $pk = "job_no";
	 $dname = "job_no";
	 $vname = "job_no";
	 $url = $screenId."/jobNoList";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList2'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{

}

<?php 
	// Generate RowEdit itemCombo
	 $cname = "item";
	 $pk = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = $screenId."/itemCodeList";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	var selItem = combo.getValue();
	var jobCom = Ext.getCmp('ext-comp-1006');
    var obj = new Object();
    obj["params"] = new Object();

	var item_code = selItem;

	prefix = item_code.substring(0,2);
    sufix  = item_code.substring(12,15);

    code = item_code.substring(3,11);
	//while (code.substr(0,1) == '0' && code.length>1) { code = code.substr(1,9999); }
	//alert(code.substr(code.length-6,code.length-1));
	if( code.substr(code.length-6,code.length) == "11107B" 
	 || code.substr(code.length-6,code.length) == "11108B" 
	 || code.substr(code.length-7,code.length) == "11108CB" 
	 || code.substr(code.length-6,code.length) == "11109B" )
	{
		 code = "0" + code.substring(0,code.length-1);
	}

	if( code.substr(code.length-1,code.length) == "B" )
	{
		 code = code.substring(0,code.length-1) + '_';
	}
	
    obj["params"]["query"] = prefix +"-"+ code  +"-"+ sufix;

    jobCom.clearValue();
    jobStore.load(obj);
    
}

	// <-- End Grid Header
	var leftComp  = [receivedNo,refDocNo];
	var rightComp = [receivedDate];
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
		//var values = rec.data;
        //var field, id;
        //var obj = new Object();
	    //obj["params"] = new Object();
	    //obj["params"]["item"] = selItem = values['item_code']
		//locaStore.load(obj);
		//selRow = row;
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
		if ( isEdit == true )
		{
			alert("มีข้อผิดพลาดจากข้อมูลที่ใส่ ให้ลองทำใหม่อีกครั้ง หรือมีการลืมกด Update ให้กดเข้าไปแก้ไขข้อมูลแล้วกด Cancel");
			return;
		}
        
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

            if( !isClick ){
             	isClick = true; 
	            receiveDataStore.save();
	
	            Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
	            	receiveDataStore.removeAll();
	            	fp.getForm().reset(); 
	            	isClick = false;
	            });
            }

        }
    }


});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>