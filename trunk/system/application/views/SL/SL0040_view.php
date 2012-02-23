
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "SL0040";
	$pkId = "order_no";
	
	$col = "order";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]=array("name"=>"id","type"=>"number","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );			
	${$col}[1]=array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );			
	${$col}[2]=array("name"=>"po_no","type"=>"datetime","editor"=>"textFieldBlank,width:110" ,"df"=>"" );			
	${$col}[3]=array("name"=>"total_qty","type"=>"string","editor"=>"textFieldBlank,width:110" ,"df"=>"" );
	${$col}[4]=array("name"=>"plan_delivery_qty","type"=>"string","editor"=>"textFieldBlank,width:110" ,"df"=>"" );
	${$col}[5]=array("name"=>"delivery_qty","type"=>"string","editor"=>"textFieldBlank,width:110" ,"df"=>"" );
	${$col}[6]=array("name"=>"remain_qty","type"=>"string","editor"=>"textFieldBlank,width:110" ,"df"=>"" );
	${$col}[7]=array("name"=>"customer_name","type"=>"string","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[8]=array("name"=>"delivery_code","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[9]=array("name"=>"finished_flag","type"=>"bool","editor"=>"editCheckBox" ,"df"=>"0" );	
	${$col}[10]=array("name"=>"reason","type"=>"string","editor"=>"ocReasonCombo" ,"df"=>"0" );	
	
	${$col}[11]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[12]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[13]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[14]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[15]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[16]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );

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

var finDate  = formDateField1(false,false,'finished_date','<?=lang('SL0040_finished_date')?>',new Date(),'Y-m-d');	
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true,true);		
var textFieldNBlank = rowEditTextField1(false,true);
var numFieldBlank = rowEditNumField1(true,true,'0');	
<?php 
	// Generate RowEdit itemCombo
	 $cname = "ocReason";
	 $pk = "oc_reason_val";
	 $dname = "oc_reason_disp";
	 $vname = "oc_reason_val";
	 $url = $screenId."/getOcReasonCombo";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{
	
}

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [finDate];
	var rightComp = [];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
	<?php 
		$gname = "order";
		$width = "auto";
		$height = "300";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "กรุณาเลือก Orderที่เสร็จแล้ว";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleEditOnlyGrid2'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
		var reCom = Ext.getCmp('ext-comp-1012'); 
		if(values["finished_flag"] == true)
		{
			if(values["remain_qty"] != 0 ){
				reCom.setReadOnly(false);
			} else {
				reCom.setReadOnly(true);
			}
		} else {
			reCom.setReadOnly(true);
		}
	}
	
// Final panel	
	<?php 
		$title = "Finished Job Selection";
		$panelItem = "";
		$gname	= "order";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
	//Ext.getCmp('UpdateActionorder').setDisabled(true);
    function updateEvent(){
    	//Ext.getCmp('UpdateActionorder').setDisabled(true); 
        if (fp.form.isValid()) {
            var obj = new Object();
            obj["params"] = new Object();
            obj["params"]["start"] = 0;
            obj["params"]["limit"] = pageLimit;
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
    			  // ADD Form param
                orderDataStore.setBaseParam(key, value);
            }, this);

			// Validate data
			var isError = false;
			var haveChecked = false;

            for(var i = 0 ; i < orderDataStore.getCount() ; i++){
				if( orderDataStore.getAt(i).get("finished_flag")  != true )
					continue;

				// Checked Item
				haveChecked = true;
				if( parseFloat( orderDataStore.getAt(i).get("remain_qty") ) != 0 
				  && orderDataStore.getAt(i).get("reason") == "" 
					)
				{
					isError = true;
					break;
				}
            }


            if(!isError && haveChecked)
            	orderDataStore.save();
            else{
               if( isError ) {
	 	     	   Ext.Msg.show({
		        		title:'ตรวจสอบรายการ',
		        		msg: 'คุณทำรายการไม่ถูก',
		                icon: Ext.MessageBox.ERROR,
		                buttons: Ext.Msg.OK
		       		});
               }
            }

        }
    }

   // ocReasonStore.load({params: {start: 0, limit: pageLimit} });

    editCheckBox.on('click', function(ctrlObj, eventObj, recordObj) {
		var values = recordObj.data;
		var reCom = Ext.getCmp('ext-comp-1012'); 
		if(values["finished_flag"] == true)
		{
			if(values["remain_qty"] != 0 ){
				reCom.setReadOnly(false);
			} else {
				reCom.setReadOnly(true);
			}
		} else {
			reCom.setValue("");
			reCom.setReadOnly(true);
		}

  	});
  	
    
    // After updated do sth.
    Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
		orderDataStore.load({params: {start: 0, limit: pageLimit} });
	    fp.getForm().reset(); 
    });
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>