
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0100"; 
	$pkId = "id";
	
	//right array
	$col = "location";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"location_code"	,"type"=>	"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[1]	=	array("name"=>	"location_name"	,"type"=>	"string","editor"=>"textFieldBlank,width:100","df"=>"" );						
	${$col}[2]	=	array("name"=>	"qty"	,"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );

	${$col}[3]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[4]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[5]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[6]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[8]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	
	
	//right array
	$col = "lot";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>	"id",		"type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[1]	=	array("name"=>	"item_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selItem" );						
	${$col}[2]	=	array("name"=>	"location_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"*DF*selLoca" );						
	${$col}[3]	=	array("name"=>	"lot_no",	"type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[4]	=	array("name"=>	"seq_no",	"type"=>	"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[5]	=	array("name"=>	"qty"	,	"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[6]	=	array("name"=>	"new_qty",	"type"=>	"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	
	${$col}[7] =array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[8] =array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[9] =array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[10]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[11]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[12]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );	
	include(APPPATH.'/views/common/h_include'.EXT);

?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
    
	var selItem = "";
	var selLoca = "";
	var selLot  = "";
	var currInv = 0;
	
	
	// DataProxy define area
	var issuStore = new Ext.data.SimpleStore({
	    fields:['issu_type_v', 'issu_type_n']
	   ,data:[
	   //     ['U', 'Unplan'],
	       ['P', 'Plan']
	   ]
	});

	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//             Component define area  
	//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
	//formTextField1(Blank,Read,name,Label)
	var transNo = formTextField1(true,true,'trans_no','<?=lang('trans_no')?>');		
	var refDocNo = formTextField1(true,false,'ref_doc_no','<?=lang('ref_doc_no')?>');			
	var transDate = formDateField1(false,false,'trans_date','<?=lang('trans_date')?>','','Y-m-d');
	var transQty = formNumField1(false,false,'trans_qty','<?=lang('trans_qty')?>');

	var itemCom = ""; 
	var locaCom = ""; 
	var lotCom  = ""; 
	var seqCom  = ""; 

	var dateCom = ""; 
	var qtyCom = ""; 
	var tlocaCom  = ""; 
	
	<?php // Delivery No
		 $cname = "item";
		 $pk = "item_code";
		 $fname = "item_code";
		 $dname = "item_code";
		 $vname = "item_code";
		 $url = "../MT/MT0010/itemCodeList";
		 $editable = "true";
		 $mode = "remote";
		 $allowBlank = "false";
		 $initialLoad = true;
		 $initParam ="";
		 $width = 200;
		 
		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		itemCom = Ext.getCmp('ext-comp-1057'); 
		locaCom = Ext.getCmp('ext-comp-1058'); 
		lotCom  = Ext.getCmp('ext-comp-1059'); 
		seqCom  = Ext.getCmp('ext-comp-1060'); 

		dateCom = Ext.getCmp('ext-comp-1063'); 
		qtyCom = Ext.getCmp('ext-comp-1064'); 
		tlocaCom  = Ext.getCmp('ext-comp-1065'); 
		
		selItem = combo.getValue();
		locaCom.clearValue();
		lotCom.clearValue();
		seqCom.clearValue();
		qtyCom.setValue("");
		tlocaCom.clearValue();
	    lotStore.removeAll();
		locaStore.removeAll();
		locaDesStore.removeAll();
		seqStore.removeAll();
		
		var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item"] = selItem;
	    
		locaStore.load(obj);
		locaDesStore.load(obj);

        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
        obj["params"]["item_code"] = selItem;
        
        locationDataStore.load(obj); // Update data
        lotDataStore.removeAll();
		
	}

	<?php 
		// Generate RowEdit itemCombo
		 $cname = "loca";
		 $pk = "location_code";
		 $fname = "location_name";
		 $dname = "location_name";
		 $vname = "location_code";
		 $url = "../MT/MT0040/getLocaByItem1";
		 $editable = "false";
		 $mode = "local";
		 $allowBlank = "false";
		 $initialLoad = false;
		 $initParam ="";
		 $width = 150;
		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		selLoca = combo.getValue();

		lotCom.clearValue();
		seqCom.clearValue();
		qtyCom.setValue("");

		lotStore.removeAll();
		seqStore.removeAll();
		
	    var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item"] = selItem;
	    obj["params"]["loca"] = selLoca;
		lotCom.clearValue(); 
		lotStore.load(obj);
	}

	<?php 
		// Generate RowEdit itemCombo
		 $cname = "lot";
		 $pk = "lot_no";
		 $fname = "lot_no";
		 $dname = "lot_no";
		 $vname = "lot_no";
		 $url = "IV0020/getLotNo";
		 $editable = "false";
		 $mode = "local";
		 $allowBlank = "false";
		 $initialLoad = false;
		 $initParam ="";
		 $width = 100;
		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
		selLot = combo.getValue();

		seqCom.clearValue();
		qtyCom.setValue("");

		seqStore.removeAll();		
		
	    var obj = new Object();
	    obj["params"] = new Object();
	    obj["params"]["item"] = selItem;
	    obj["params"]["loca"] = selLoca;
	    obj["params"]["lot"] = selLot;
	    seqCom.clearValue(); 
		seqStore.load(obj);
	}

	<?php 
		// Generate RowEdit itemCombo
		 $cname = "seq";
		 $pk = "seq_no";
		 $fname = "seq_no";
		 $dname = "seq_no";
		 $vname = "seq_no";
		 $url = "IV0020/getSeqNo";
		 $editable = "false";
		 $mode = "local";
		 $allowBlank = "false";
		 $initialLoad = false;
		 $initParam ="";
		 $width = 100;
		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{
	    Ext.Ajax.request({
	        url : 'IV0020/getInvQty',
	        method: 'POST',
	        params :{item:selItem, loca:selLoca, lot: selLot, seq: combo.getValue()},
	        success: function ( result, request ) {
	            		//alert("hello");
	                     var jsonData = Ext.util.JSON.decode(result.responseText);
	                     var resultMessage = jsonData.qty;
	                     //var invTxt = Ext.getCmp('ext-comp-1013')
	                     //invTxt.setValue(resultMessage);
	                     currInv = parseFloat( resultMessage );
						 //alert(currInv);
	              },
	                 failure: function ( result, request ) {
	                  var jsonData = Ext.util.JSON.decode(result.responseText);
	                  var resultMessage = jsonData.data.result;
						 alert(resultMessage);
	              }
	      });
	}
	
	<?php 
		// Generate RowEdit itemCombo
		 $cname = "locaDes";
		 $pk = "location_code";
		 $fname = "des_location_name";
		 $dname = "location_name";
		 $vname = "des_location_code";
		 $url = "../MT/MT0040/getLocaByItem";
		 $editable = "false";
		 $mode = "local";
		 $allowBlank = "false";
		 $initialLoad = false;
		 $initParam ="";
		 $width = 150;
		include(APPPATH.'/views/common/FormComboList1'.EXT); 
	?>
	function <?=$cname?>OnSelect(combo,value)
	{

	}

	//Component in rowEditor
	var textFieldBlank = rowEditTextField1(true);		
	var textFieldNBlank = rowEditTextField1(false);
	var invQty = rowEditNumField1(false,true);		
	var numField = rowEditNumField1(false,false,'','issueQty');


// Row Editor ^^^
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

Ext.apply(Ext.form.VTypes, {
   issueQty: function(value, field)
   {
      if (value > Ext.getCmp('ext-comp-1014').getValue())
		return false;
      else
		return true; 
   },
 
   issueQtyText: '<?=lang('ER0001')?>'
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
	// <-- End Grid Header
	var leftComp  = [transNo,refDocNo,itemCombo,locaCombo,lotCombo,seqCombo];
	var rightComp = [transDate,transQty,locaDesCombo];
    var maindata = formMain1(leftComp,rightComp);
    
    // Grid vvv
	// ReadOnly Grid
	<?php 
		$gname = "location";
		$width = "auto";
		$height = "250";
		$initialLoad = false;
		$view = "viewLocation";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;

        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
        obj["params"]["item_code"] = selItem;
        obj["params"]["location_code"] = values['location_code'];
        
        lotDataStore.load(obj); // Update data

	}
	
	// ReadOnly Grid
	<?php 
		$gname = "lot";
		$width = "auto";
		$height = "250";
		$initialLoad = false;
		$view = "viewLot";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){


	}

	// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$leftWidth = 0.2;
		$rightWidth = 0.8;
		$leftComp = "location";
		$rightComp = "lot";
		$gname	= "lot";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel6'.EXT);
	?>

	
    function updateEvent(){

        
        if (fp.form.isValid() ) {

            var obj = new Object();
            Ext.iterate(fp.form.getValues(), function(key, value) { obj[key] = value; }, this);

			if( locaCom.getValue() == tlocaCom.getValue() )
			{
	     	   Ext.Msg.show({
	        		title:'ตรวจสอบคลังปลายทาง',
	        		msg: 'คุณย้ายไปคลังเดิม กรุณาตรวจสอบคลังอีกครั้ง',
	                icon: Ext.MessageBox.ERROR,
	                buttons: Ext.Msg.OK
	       		});
	       		return;
			}

			if( currInv < parseFloat( obj["trans_qty"] ) || parseFloat( obj["trans_qty"] ) == 0 )
			{
	     	   Ext.Msg.show({
	        		title:'ตรวจสอบจำนวน',
	        		msg: 'จำนวนที่จะย้ายไม่ถูกต้อง จำนวนอาจมากเกิน หรือ มีค่าเป็น 0',
	                icon: Ext.MessageBox.ERROR,
	                buttons: Ext.Msg.OK
	       		});
	       		return;				
			}

			
			submitData(obj);
        }else{
	     	   Ext.Msg.show({
	        		title:'ตรวจสอบรายการ',
	        		msg: 'คุณทำรายการไม่ถูก',
	                icon: Ext.MessageBox.ERROR,
	                buttons: Ext.Msg.OK
	       		});            
        }
    }
    
    function submitData(obj){
        Ext.Ajax.request({
            url : '<?=$screenId?>/updateData',
            method: 'POST',
            params : obj,
            success: function ( result, request ) {
                        var jsonData = Ext.util.JSON.decode(result.responseText);

                        //alert("หมายเลขใบส่งของ คือ " + jsonData["issue_no"]);

						// Remove Updated Item                        
                        //issueDataStore.removeAll();
                        
                		// Refresh Select Order list
                        //deliStore.load({params: {query: ''} });

		        	    fp.getForm().reset(); 
                         
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