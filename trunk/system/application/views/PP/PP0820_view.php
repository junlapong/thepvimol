
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PP0820";
	$pkId = "id";
	
	$col = "job";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();

	${$col}[0]=array("name"=>"id","type"=>"number","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );			
	${$col}[1]=array("name"=>"job_no","type"=>"string","editor"=>"textFieldBlank,width:110","df"=>"" );			
	${$col}[2]=array("name"=>"job_date","type"=>"datetime","editor"=>"textFieldBlank,width:150" ,"df"=>"" );			
	${$col}[3]=array("name"=>"item_code","type"=>"string","editor"=>"textFieldBlank,width:150" ,"df"=>"" );			
	${$col}[4]=array("name"=>"order_no","type"=>"string","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[5]=array("name"=>"order_qty","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"" );			
	${$col}[6]=array("name"=>"finish_order_qty","type"=>"number","editor"=>"textFieldBlank,width:100" ,"df"=>"0" );			
	${$col}[7]=array("name"=>"finish_flag","type"=>"bool","editor"=>"editCheckBox" ,"df"=>"0" );
	
	${$col}[8]=array("name"=>"finished_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false" ,"df"=>"" );			
	${$col}[9]=array("name"=>"finished_approver","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false" ,"df"=>"" );	
	${$col}[10]=array("name"=>"cancel_flag","type"=>"bool","editor"=>"textFieldBlank, hidden: true , hideable: false" ,"df"=>"0" );			
	${$col}[11]=array("name"=>"cancel_reason","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false" ,"df"=>"" );			
	${$col}[12]=array("name"=>"cancel_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00"  );			
	${$col}[13]=array("name"=>"cancel_staff","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>""  );			

	${$col}[14]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[15]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[16]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[17]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[18]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[19]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );

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

// Grid vvv
	<?php 
		$gname = "job";
		$width = "auto";
		$height = "300";
		$initialLoad = true;
		$enableCollapse = false;
		$title = "กรุณาเลือกงานที่เสร็จแล้ว";
		$autoSave = "false";
		include(APPPATH.'/views/common/simpleEditOnlyGrid1'.EXT);
	?>
	function onSelectEvent<?=$gname?>(sm,row,rec){

	}
	
// Final panel	
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
		jobDataStore.load({params: {start: 0, limit: pageLimit} });
	    fp.getForm().reset(); 
    });
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

	<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>