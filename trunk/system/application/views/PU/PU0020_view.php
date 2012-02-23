
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PU0020";
	$pkId = "po_no";
	
	$col = "job";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

//	${$col}[0]=array("name"=>"id","type"=>"number","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );			
	${$col}[0]=array("name"=>"po_no","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );			
	${$col}[1]=array("name"=>"po_date","type"=>"datetime","editor"=>"textFieldBlank,width:150" ,"df"=>"" );			
	${$col}[2]=array("name"=>"ref_doc","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"" );			
	${$col}[3]=array("name"=>"finished_flag","type"=>"bool","editor"=>"editCheckBox" ,"df"=>"0" );

	${$col}[4]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[5]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[6]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[7]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[8]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[9]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	
	$col = "reciss";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = "item_code";
	${$col."Render"} = "none";
	${$col} = array();

	//left array						
	${$col}[0]=array("name"=>"po_no","type"=>"string" ,"editor"=>"textFieldBlank, hidden: true , hideable: false");		
	${$col}[1]=array("name"=>"item_code","type"=>"string" ,"editor"=>"textFieldBlank,width:110");		
	${$col}[2]=array("name"=>"item_name","type"=>"string" ,"editor"=>"textFieldBlank,width:150");		
	${$col}[3]=array("name"=>"order_qty","type"=>"string" ,"editor"=>"textFieldBlank,width:50");		
	${$col}[4]=array("name"=>"received_qty","type"=>"string" ,"editor"=>"textFieldBlank,width:50");		
	${$col}[5]=array("name"=>"ref_doc","type"=>"string" ,"editor"=>"textFieldBlank,width:50");		
	${$col}[6]=array("name"=>"notes","type"=>"string" ,"editor"=>"textFieldBlank,width:50");		
	${$col}[7]=array("name"=>"cancel_reason","type"=>"string" ,"editor"=>"textFieldBlank,width:50");
	
	${$col}[8]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[9]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[10]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[11]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[12]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[13]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );						
	
	$col = "riDetail";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = "received_no";
	${$col."Render"} = "none";
	${$col} = array();
	
	${$col}[0]=array("name"=>"received_no","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"");						
	${$col}[1]=array("name"=>"received_date","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[2]=array("name"=>"received_qty","type"=>"string","editor"=>"textFieldBlank,width:50","df"=>"" );						
	${$col}[3]=array("name"=>"inv_no","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[4]=array("name"=>"location_code","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	${$col}[5]=array("name"=>"received_staff","type"=>"string","editor"=>"textFieldBlank,width:80","df"=>"" );						
	
	${$col}[6]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[7]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[8]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[9]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[10]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[11]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );		

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

var finDate  = formDateField1(false,false,'finished_date','<?=lang('finished_date')?>',new Date(),'Y-m-d');	
var notes = formTextField2(true,false,'notes','<?=lang('notes')?>','',300);

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true,true,'0');	

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [finDate];
	var rightComp = [];
    var maindata = formMain1(leftComp,rightComp);

    // PR Grid vvv
	<?php 
		$gname = "reciss";
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$view = "viewPOItem";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["item_code"] = values['item_code'];
        obj["params"]["po_no"] = values['po_no'];
        
        riDetailDataStore.load(obj); // Update data
        //riDetailEnableButton(false); // Enable Button

	}

	// ReadOnly Grid
	<?php 
		$gname = "riDetail";
		$width = "auto";
		$height = "200";
		$initialLoad = false;
		$view = "viewReceive";
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleReadOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}
    
// Main Grid vvv
	<?php 
		$gname = "job";
		$width = "auto";
		$height = "250";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "กรุณาเลือกงานที่เสร็จแล้ว";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleEditOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){
		var values = rec.data;
        var field, id;
        var obj = new Object();
        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = 500;
        obj["params"]["po_no"] = values['po_no'];
        
        recissDataStore.load(obj); // Update data
	}
			
// Final panel	
	<?php 
		$title = "รายการของใน PO / รายการรับของ";
		$render = $screenId."_detail1";
	 	$leftWidth = 0.5;
	 	$rightWidth = 0.5;
	 	$leftComp = "reciss";
	 	$rightComp = "riDetail";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel2_diffName'.EXT);
	?>
	
	<?php 
		$title = "Finished Job Selection";
		$panelItem = "";
		$gname	= "job";
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
                jobDataStore.setBaseParam(key, value);
            }, this);
            
            jobDataStore.save();
    		//orderDataStore.removeAll();	

        }
    }
    
    // After updated do sth.
    Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
	    fp.getForm().reset(); 
		jobDataStore.load({params: {start: 0, limit: pageLimit} });
    });
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

	<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>