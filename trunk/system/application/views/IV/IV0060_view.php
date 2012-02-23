
<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "IV0060"; 
	$pkId = "id";
	$col = array();
	//left array						
	$col[0]	=	array("name"=>	"item_code"	,"type"=>	"string" );						
	$col[1]	=	array("name"=>	"t_qty"	,"type"=>	"number");						
	$col[2]	=	array("name"=>	"b_qty"	,"type"=>	"number");						
	$col[3]	=	array("name"=>	"k_qty"	,"type"=>	"number");						
	
	//right array
	$colD = array();
	$colD[0]	=	array("name"=>	"ri_no"	,"type"=>	"string" );						
	$colD[1]	=	array("name"=>	"item_code"	,"type"=>	"string");						
	$colD[2]	=	array("name"=>	"location_code"	,"type"=>	"string");						
	$colD[3]	=	array("name"=>	"ri_date"	,"type"=>	"datetime");						
	$colD[4]	=	array("name"=>	"received_qty"	,"type"=>	"number");
	$colD[5]	=	array("name"=>	"issue_qty"	,"type"=>	"number");
	$colD[6]	=	array("name"=>	"balance_qty"	,"type"=>	"number");

	include(APPPATH.'/views/common/h_include'.EXT);
?>

<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">
Ext.onReady(function(){
    Ext.QuickTips.init();
    
// Define App tool for popup message
var App = new Ext.App({});

// DataProxy define area
var dataProxy = new Ext.data.HttpProxy({
    api: {
    	read    : '<?=$screenId?>/view'
	},
	method: 'POST'
});

var dataProxy2 = new Ext.data.HttpProxy({
    api: {
    	read    : '<?=$screenId?>/viewDetail'
	},
	method: 'POST'
});

var locaProxy = new Ext.data.HttpProxy({
    api: {
    	read    : '../MT/MT0040/getLocaByItem'
	},
	method: 'POST'
});
// DAO for JSON Define area
var dataRecord = new Ext.data.Record.create([
<?php 
	// Print out {name: 'colname', type: 'string'}	
	for($i=0; $i < count($col) ; $i++){
		if($i != 0) echo ",";
	   	echo "{name: '" . $col[$i]["name"] . "',type: '" . $col[$i]["type"] . "'}";
	}
?>
    ]);

var dataDetailRecord = new Ext.data.Record.create([
<?php 
	// Print out {name: 'colname', type: 'string'}	
	for($i=0; $i < count($colD) ; $i++){
		if($i != 0) echo ",";
	   	echo "{name: '" . $colD[$i]["name"] . "',type: '" . $colD[$i]["type"] . "'}";
	}
?>
    ]);

// JSON Define area

var dataStore = new Ext.data.JsonStore({
    root: 'data',
    //idProperty: '<?=$pkId?>',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: dataRecord,
    proxy: dataProxy
});

var dataDetailStore = new Ext.data.JsonStore({
    root: 'data',
    //idProperty: '<?=$pkId?>',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: dataDetailRecord,
    proxy: dataProxy2
});

var locaStore = new Ext.data.JsonStore({
    root: 'data',
    idProperty: 'location_code',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: 'location_code'}],
	autoLoad: false,
	proxy: locaProxy

});


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

var itemField = new Object();		
itemField["xtype"] = "textfield";
itemField["allowBlank"] = true;
itemField["name"] = 'item_code';
itemField["fieldLabel"] = '<?=lang('item_code')?>';

var locaCombo = new Object();		
locaCombo["xtype"] = 'combo';
locaCombo["displayField"] = 'location_code';
locaCombo["valueField"] = 'location_code';
locaCombo["mode"] = 'local';
locaCombo["allowBlank"] = true;
locaCombo["typeAhead"] = true;
locaCombo["triggerAction"] = 'all';
locaCombo["store"] = locaStore;
locaCombo["selectOnFocus"] = true;
locaCombo["forceSelection"] = false;
locaCombo["minChars"] = 2;
locaCombo["editable"] = false;
locaCombo["fieldLabel"] = '<?=lang('location_code')?>';
locaCombo["id"] = 'locaCombo';
locaCombo["listeners"] = {select:{fn:function(combo, value) {
	   var gridDetail = grid
	   var rec = gridDetail.getSelectionModel().getSelected(); 
	   var values = rec.data;
       var obj = new Object();
       obj["params"] = new Object();
       obj["params"]["item_code"] = values['item_code'];
       obj["params"]["location_code"] = combo.getValue();
       dataDetailStore.load(obj);

    }}
};

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// render define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_


//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_

    	
	// Start Grid Header -->
	var columnModel = new Ext.grid.ColumnModel({
		// specify any defaults for each column
	     defaults: {
	         sortable: true           
	     },
	     columns: [
	          new Ext.grid.RowNumberer(),
	<?php 
		// Print out {header: '<?=lang("menu_code")?\>',dataIndex: 'menu_code',editor: {xtype: 'textfield', allowBlank: false }}	
		for($i=0; $i < count($col) ; $i++){
	    	if($i != 0) echo ",";
	    	echo "{header: '" . lang($col[$i]["name"]) . "'";
	    	echo ",dataIndex: '" . $col[$i]["name"] . "'";
	    	if($i >= 1 ) echo ",renderer: num_rend,align:'right'";
	    	echo "}";
	    }
	?>
	     ]
	});

	var columnDModel = new Ext.grid.ColumnModel({
		// specify any defaults for each column
	     defaults: {
	         sortable: false           
	     },
	     columns: [
	          new Ext.grid.RowNumberer(),
	<?php 
		// Print out {header: '<?=lang("menu_code")?\>',dataIndex: 'menu_code',editor: {xtype: 'textfield', allowBlank: false }}	
		for($i=0; $i < count($colD) ; $i++){
	    	if($i != 0) echo ",";
	    	echo "{header: '" . lang($colD[$i]["name"]) . "'";
	    	echo ",dataIndex: '" . $colD[$i]["name"] . "'";
	    	if($i == 0 ) echo ",renderer: recv_issue";
	    	if($i == 4 ) echo ",renderer: num_rend,align:'right'";
	    	if($i == 5 ) echo ",renderer: num_rend,align:'right'";
	    	if($i == 6 ) echo ",renderer: num_rend,align:'right'";
	    	echo "}";
	    }
	?>
	     ]
	});
	// <-- End Grid Header

    var searchConditions = [{
        bodyStyle: 'padding-right:5px;',
        items: {
            xtype: 'fieldset',	// <-- left Area
            border: false,
            title: ' ',
            items: [
				itemField
            ]
        }
    }, {
        bodyStyle: 'padding-left:5px;',
        border: false,
        items: {
            xtype: 'fieldset', // <-- Right Area
            title: ' ',
            border: false,
            items: [            
            ]
        }
    }];
    
    // Search Area
 	var searchPanel = new Ext.form.FormPanel({
        renderTo: '<?=$screenId?>_search',
        title   : 'Search Conditions',
        autowidth: true,
        collapsed: false,   
        collapsible: true,        
        bodyStyle: 'padding:0 10px 0;',
        
        items   : [
            {
            	layout:'column',
                border: false,
                // defaults are applied to all child items unless otherwise specified by child item
                defaults: {
                    columnWidth: '.5',
                    border: false
                },   
            	items : searchConditions
            }
        ],
        buttons: [
            {
                text   : 'Search',
                handler: function() {
                    if (searchPanel.form.isValid()) {
                        //var s = '';
                        
                        var obj = new Object();
                        obj["params"] = new Object();
                        obj["params"]["start"] = 0;
                        obj["params"]["limit"] = pageLimit;
                                            
                        Ext.iterate(searchPanel.form.getValues(), function(key, value) {
                            obj["params"][key] = value;
                        }, this);

					    dataStore.load(obj);
                        //Ext.Msg.alert('Form Values', s);  
                        searchPanel.toggleCollapse(true);   
                
                    }
                }
            },
            {
                text   : 'Reset',
                handler: function() {
                    searchPanel.form.reset();
                }
            }
        ]
    });

    var grid = new Ext.grid.GridPanel({
    	
        id: 'dataGrid',
        cm: columnModel,
        store: dataStore,
        autoWidth: true,
        //width:600,
        height:513,
		enableColumnMove: true,
        frame: true,
        autoScroll: true,
        //viewConfig: {
    	//    forceFit: true
        //},
        sm: new Ext.grid.RowSelectionModel({
            singleSelect: true,
            listeners: {
                rowselect: function(sm, row, rec) {
        			values = rec.data;
        	        if(Ext.isArray(values)){ // array of objects
        	            for(var i = 0, len = values.length; i < len; i++){
        	                var v = values[i];
        	                // Not used
							//alert(v.value);
							//alert(v.id);
        	            }
        	        }else{ // object hash
        	            var field, id;
                        var obj = new Object();
                        obj["params"] = new Object();
                        obj["params"]["item_code"] = values['item_code'];
                        obj["params"]["item"] = values['item_code'];
                        dataDetailStore.load(obj);
                        var loCom = Ext.ComponentMgr.get('locaCombo');
                        loCom.clearValue(); 
                    	locaStore.load(obj);
        	        }
                }
            }
        }),
        bbar: new Ext.PagingToolbar({
            pageSize:pageLimit,
            store: dataStore,
            displayInfo: true,
            displayMsg: 'Displaying Data {0} - {1} of {2}',
            emptyMsg: "No Data found"
        })
    });

    var gridDetail = new Ext.grid.GridPanel({
    	
        id: 'dataGridDetail',
        cm: columnDModel,
        store: dataDetailStore,
        autoWidth: true,
        //width:600,
        height:513,
        frame: true,
        autoScroll: true,
        tbar: [{ xtype: 'label', text: '<?=lang('location_code')?>' },'-',locaCombo],
        viewConfig: {
    	    forceFit: true
        }
    });
    // Initial load data
    dataStore.load({params: {start: 0, limit: pageLimit} });

    // Combine all
    var fp = new Ext.FormPanel({
    	title: 'Results',
        frame: true,
        labelWidth: 110,
		autowidth: true,
        collapsed: false,   
        collapsible: true,
        renderTo:'<?=$screenId?>',
        bodyStyle: 'padding:0 10px 0;',
        layout: 'column',    // Specifies that the items will now be arranged in columns
        items: [{
	            columnWidth: 0.35,
	            layout: 'fit',
	            items: grid
	        },
        	{
            	columnWidth: 0.65,
	            layout: 'fit',
	            items: gridDetail
        	}
        ]
    });
    
    function actionAfterEvent(){
    	grid.doLayout();
    	gridDetail.doLayout();
    	fp.doLayout();
    }
    
    Ext.EventManager.onWindowResize(actionAfterEvent, grid); 

    // extra extra simple
 /*   var chart = new Ext.FormPanel({
    	title: 'chart',
        frame: true,
        labelWidth: 110,
		autowidth: true,
		height:300,
        collapsed: true,   
        collapsible: true,
        renderTo:'<?=$screenId?>_chart',
        layout:'fit',

        items: {
            xtype: 'linechart',
            store: dataDetailStore,
            xField: 'ri_no',
            yField: 'balance_qty',
            url: '<?=base_url()?>system/scripts/charts.swf',
            yAxis: new Ext.chart.NumericAxis({
                displayName: 'Balance',
                labelRenderer : Ext.util.Format.numberRenderer('0,0')
            })
        }
    });*/

    
});
//<-- End Grid Area


</script>
<!-- END USER JAVASCRIPT -->

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>