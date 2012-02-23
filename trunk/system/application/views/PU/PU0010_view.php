
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PU0010"; 
	$pkId = "id";
	
	$col = "order";
	${$col."URL"} 	 = $screenId;
	${$col."PK"} 	 = $pkId;
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	${$col}[0]		=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]		=	array("name"=>"pr_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	
	${$col}[2]		=	array("name"=>"item_code","type"=>"string","editor"=>"itemCombo,width:300","df"=>"" );
	${$col}[3]		=	array("name"=>"order_qty","type"=>"number","editor"=>"numFieldBlank,width:100","df"=>"" );

	${$col}[4]		=	array("name"=>"ref_doc","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[5]		=	array("name"=>"request_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );

	${$col}[6]		=	array("name"=>"po_no","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[7]		=	array("name"=>"order_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[8]		=	array("name"=>"received_date","type"=>"datetime","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	
	
	${$col}[9]		=	array("name"=>"approved_flag","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[10]		=	array("name"=>"approved_reason","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[11]		=	array("name"=>"approved_date","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[12]		=	array("name"=>"approved_staff","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	
	${$col}[13]		=	array("name"=>"finished_flag","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[14]		=	array("name"=>"finished_reason","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[15]		=	array("name"=>"finished_date","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[16]		=	array("name"=>"finished_approver","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	
	${$col}[17]		=	array("name"=>"cancel_flag","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[18]		=	array("name"=>"cancel_reason","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	${$col}[19]		=	array("name"=>"cancel_date","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"0000-00-00 00:00:00" );
	${$col}[20]		=	array("name"=>"cancel_staff","type"=>"string","editor"=>"textFieldBlank, hidden: true , hideable: false","df"=>"" );
	
	${$col}[21]		=	array("name"=>	"purpose"	,"type"=>	"string"	,"editor"=>	"textFieldNBlank,width:200","df"=>"" );
	
	${$col}[22]		=	array("name"=>	"delete_flag"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"0" );
	${$col}[23]		=	array("name"=>	"notes"	,"type"=>	"string"	,"editor"=>	"textFieldBlank","df"=>"" );
	${$col}[24]		=	array("name"=>	"created_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[25]		=	array("name"=>	"updated_date"	,"type"=>	"datetime"	,"editor"=>	"" ,"df"=>"");
	${$col}[26]		=	array("name"=>	"created_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	${$col}[27]		=	array("name"=>	"updated_user"	,"type"=>	"string"	,"editor"=>	"{xtype: 'textfield', allowBlank: true }","df"=>"" );
	
	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();

// Global

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// FORM EDITOR
var refDoc = formTextField2(false,false,'ref_doc','<?=lang('ref_doc')?>','');

<?php // unplan reason combo
	 $cname = "m1Staff";
	 $pk = "staff1_code";
	 $fname = "request_staff";
	 $dname = "staff_name";
	 $vname = "staff1_code";
	 $url = "../common/EMPLOYEE/getAllStaffNameList";
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

//ROW EDIT (GRID EDIT)
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(true);	
var numReadFieldBlank = rowEditNumField1(false,true);	
<?php 
	// Generate RowEdit itemCombo
	 $cname = "item";
	 $pk = "item_code";
	 $dname = "item_name";
	 $vname = "item_code";
	 $url = "../common/ITEM/getPurchaseItemList";
	 $editable = "false";
	 $allowBlank = "false";
	include(APPPATH.'/views/common/editRowComboList1'.EXT); 
?>
function <?=$cname?>OnSelect(combo,value)
{

}

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Validation  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
// Main form 
	var leftComp  = [refDoc];
	var rightComp = [m1StaffCombo];
    var maindata = formMain1(leftComp,rightComp);

// Grid vvv
	<?php $gname = "order"; ?>
	var <?=$gname?>Proxy = new Ext.data.HttpProxy({
	  	api: {
	  		read    : '<?=${$gname."URL"}?>/view',  //<-- Not use
	  		create  : '<?=${$gname."URL"}?>/insertLedger',
	  		update  : '<?=${$gname."URL"}?>/update',
	  		destroy : '<?=${$gname."URL"}?>/destroy'
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
			include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
		?>

// Final panel	
	<?php 
		$title = "Order Enter...";
		$panelItem = "";
		$gname	= "order";
		$fitem  = "maindata";
		$render = $screenId;
		include_once(APPPATH.'/views/common/simpleFinalPanel3'.EXT);
	?>
    function updateEvent(){
        if (fp.form.isValid()) {
            
            var obj = new Object();
            obj["params"] = new Object();
            obj["params"]["start"] = 0;
            obj["params"]["limit"] = pageLimit;
                                
            Ext.iterate(fp.form.getValues(), function(key, value) {
                orderDataStore.setBaseParam(key, value);
            }, this);

            orderDataStore.save();

        }
    }
    
    Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
        
    	tmp = res.data;
  	   	Ext.Msg.show({
   		title:'หมายเลข Order',
   		msg: 'หมายเลข Order คือ ' + tmp[0]["pr_no"],
           icon: Ext.MessageBox.INFO,
           buttons: Ext.Msg.OK
  		});
		
	    orderDataStore.removeAll();
	    

	    fp.getForm().reset(); 
    });
});
//<-- End Grid Area

</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>