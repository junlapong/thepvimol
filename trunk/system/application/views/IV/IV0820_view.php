
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0820"; 
	$pkId = "id";
	
	$col = "issue";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]	=	array("name"=>"id","type"=>"number","editor"=>"numField, hidden: true , hideable: false","df"=>"0" );						
	${$col}[1]	=	array("name"=>"ref_doc_no","type"=>"string","editor"=>"refCombo,width:100","df"=>"" );						
	${$col}[2]	=	array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:150","df"=>"" );						
	${$col}[3]	=	array("name"=>"location_code","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false" ,"df"=>"K010100" );	
					
	${$col}[4]	=	array("name"=>	"issue_no"	,"type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[5]	=	array("name"=>	"issue_date","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						
	${$col}[6]	=	array("name"=>	"issue_staff","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );						

	${$col}[7]	=	array("name"=>	"lot_no"	,"type"=>"string","editor"=>"lotCombo,width:100","df"=>"" );						
	${$col}[8]	=	array("name"=>	"seq_no"	,"type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0" );						
	${$col}[9]	=	array("name"=>	"inv_qty"	,"type"=>"number","editor"=>"invQty,width:150","df"=>"" );						
	${$col}[10]	=	array("name"=>	"issue_qty"	,"type"=>"number","editor"=>"numField,width:150","df"=>"" );	
						
	${$col}[11]	=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[12]	=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[13]	=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[14]	=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");						
	${$col}[15]	=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	${$col}[16]	=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );						
	
	include(APPPATH.'/views/common/h_include'.EXT);

?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
    
// DataProxy define area
var issuStore = new Ext.data.SimpleStore({
    fields:['issu_type_v', 'issu_type_n']
   ,data:[
        ['U', 'Unplan']
   //    ,['P', 'Plan']
   ]
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//formTextField1(Blank,Read,name,Label)
var issueNo = formTextField1(true,true,'issue_no','<?=lang('issue_no')?>');		
// var refDocNo = formTextField1(true,false,'ref_doc_no','<?=lang('ref_doc_no')?>');			
var issueDate = formDateField1(false,false,'issue_date','<?=lang('issue_date')?>','','Y-m-d');	
//var issuType = formCombo1('issu_type','<?=lang('issu_type')?>','issu_type_n','issu_type_v','U',issuStore);

	
var selItem = "";
var selLoca = "";
var selLot  = "";

//Component in rowEditor
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var invQty = rowEditNumField1(false,true);		
var numField = rowEditNumField1(false,false,'','issueQty');


<?php 
	// Generate RowEdit itemCombo
	 $cname = "item";
	 $pk = "item_code";
	 $dname = "item_code";
	 $vname = "item_code";
	 $url = $screenId."/getItemList";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	selItem = combo.getValue();
	selLoca = 'K010100';
	var lotCom = Ext.getCmp('ext-comp-1011'); 
    var obj = new Object();
    obj["params"] = new Object();
    obj["params"]["item"] = selItem;
    obj["params"]["loca"] = selLoca;
	lotCom.clearValue(); 
	lotStore.load(obj);

}

<?php 
	// Generate RowEdit itemCombo
	 $cname = "ref";
	 $pk = "job_no";
	 $dname = "job_no";
	 $vname = "job_no";
	 $url = $screenId."/jobNoList";
	 $editable = "true";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
}

<?php 
	// Generate RowEdit itemCombo
	 $cname = "lot";
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
	selLot = combo.getValue();
	selSeq = "0";

    Ext.Ajax.request({
        url : '<?=$screenId?>/getInvQty',
        method: 'POST',
        params :{item:selItem, loca:selLoca, lot: selLot, seq: selSeq},
        success: function ( result, request ) {
            		//alert("hello");
                     var jsonData = Ext.util.JSON.decode(result.responseText);
                     var resultMessage = jsonData.qty;
                     var invTxt = Ext.getCmp('ext-comp-1013')
                     invTxt.setValue(resultMessage);

              },
                 failure: function ( result, request ) {
                  var jsonData = Ext.util.JSON.decode(result.responseText);
                  var resultMessage = jsonData.data.result;
					 alert(resultMessage);
              }
      });
}


// Row Editor ^^^
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

Ext.apply(Ext.form.VTypes, {
   issueQty: function(value, field)
   {
      if (value > Ext.getCmp('ext-comp-1013').getValue())
		return false;
      else
		return true; 
   },
 
   issueQtyText: '<?=lang('ER0001')?>'
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    var isClick = false;	
	// <-- End Grid Header
	var leftComp  = [issueNo/*,refDocNo,uiReasonCombo*/ ];
	var rightComp = [issueDate/*,issuType*/];
    var maindata = formMain1(leftComp,rightComp);
    
    // Grid vvv
	<?php $gname = "issue"; ?>
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
		$gname	= "issue";
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
                issueDataStore.setBaseParam(key, value);
            }, this);

            if( !isClick ){
             	isClick = true; 
                issueDataStore.save();

	            Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
	            	issueDataStore.removeAll();
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