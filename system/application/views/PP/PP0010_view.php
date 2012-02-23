<!-- /_/_/_/_/_/_/_/_/_ START USER CSS /_/_/_/_/_/_/_/_/_-->
<?php
	$screenId = "PP0010"; 
	$pkId = "id";
	
	$col = "item";
	${$col."URL"} 	 = "../MT/MT0010";
	${$col."PK"} 	 = 'item_code';
	${$col."Render"} = $screenId."_search";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]  = array("name" => "item_code","type" => "string", "editor" => "textFieldNBlank,width:110","df"=>"" );
	${$col}[1]  = array("name" => "item_name","type" => "string", "editor" => "textFieldBlank ,width:150" ,"df"=>"");
	${$col}[2]  = array("name" => "item_short_name","type" => "string", "editor" => "textFieldBlank,width:100" ,"df"=>"");
	${$col}[3]  = array("name" => "sheet_code","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[4]  = array("name" => "mol_code","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false","df"=>"" );
	${$col}[5]  = array("name" => "color","type" => "string", "editor" => "textFieldBlank,width:50","df"=>"" );
	${$col}[6]  = array("name" => "item_width","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");
	${$col}[7]  = array("name" => "item_length","type" => "number", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[8]  = array("name" => "item_height","type" => "number", "editor" => "numFieldBlank,width:50","df"=>"" );
	${$col}[9]  = array("name" => "item_thickness","type" => "number", "editor" => "numFieldBlank,width:50" ,"df"=>"");
	${$col}[10] = array("name" => "in_out_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[11] = array("name" => "stock_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false","df"=>"" );
	${$col}[12] = array("name" => "purchase_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[13] = array("name" => "low_level_code","type" => "number", "editor" => "numFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[14] = array("name" => "need_reviewing_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[15] = array("name" => "default_small_packing_qty","type" => "number", "editor" => "numFieldBlank,width:80" ,"df"=>"");
	${$col}[16] = array("name" => "default_big_packing_qty","type" => "number", "editor" => "numFieldBlank,width:80" ,"df"=>"");
	${$col}[17] = array("name" => "default_final_pack_style","type" => "string", "editor" => "textFieldBlank,width:80" ,"df"=>"");
	${$col}[18] = array("name" => "LT","type" => "number", "editor" => "numFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[19] = array("name" => "item_unit","type" => "string", "editor" => "textFieldBlank,width:50" ,"df"=>"");
	${$col}[20] = array("name" => "secure_flag","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false","df"=>"" );
	${$col}[21] = array("name" => "location_category","type" => "string", "editor" => "textFieldBlank,hidden: true , hideable: false" ,"df"=>"");
	${$col}[22] = array("name" => "created_date","type" => "datetime", "editor" => "" ,"df"=>"");
	${$col}[23] = array("name" => "updated_date","type" => "datetime", "editor" => "","df"=>"" );
	${$col}[24] = array("name" => "created_user","type" => "string", "editor" => "" ,"df"=>"");
	${$col}[25] = array("name" => "updated_user","type" => "string", "editor" => "","df"=>"" );

	$col = "bill";
	${$col."URL"} 	 = "../MT/MT0090";
	${$col."PK"} 	 = "id";
	${$col."Render"} = "none";
	${$col."Editor"} = $col."Editor";
	${$col} = array();
	
	${$col}[0]=	array("name"=>"id","type"=>"string","editor"=>"textFieldNBlank, hidden: true , hideable: false","df"=>"0" );
	${$col}[1]=	array("name"=>"item_code","type"=>"string","editor"=>"itemText,width:120","df"=>"*DF*selItem" );
	${$col}[2]=	array("name"=>"child_item_code","type"=>"string","editor"=>"itemCombo,width:120","df"=>"" );
	${$col}[3]=	array("name"=>"child_chain_seq","type"=>"number","editor"=>"textFieldBlank,width:80","df"=>"" );
	${$col}[4]=	array("name"=>"effect_date_from","type"=>"string","editor"=>"startDate,width:120","df"=>"" );
	${$col}[5]=	array("name"=>"effect_date_to","type"=>"string","editor"=>"endDate,width:120","df"=>"" );
	${$col}[6]=	array("name"=>"physical_unit","type"=>"number","editor"=>"textFieldBlank,width:120","df"=>"" );
	
	${$col}[7]=array("name"=>"delete_flag","type"=>"string","editor"=>"textFieldBlank","df"=>"0"  );			
	${$col}[8]=array("name"=>"notes","type"=>"string","editor"=>"textFieldBlank","df"=>""  );
	${$col}[9]=array("name"=>"created_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[10]=array("name"=>"updated_date","type"=>"datetime","editor"=>"","df"=>"" );			
	${$col}[11]=array("name"=>"created_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );			
	${$col}[12]=array("name"=>"updated_user","type"=>"string","editor"=>"textFieldBlank","df"=>""  );				

	include_once(APPPATH.'/views/common/h_include'.EXT);
?>
<!-- /_/_/_/_/_/_/_/_/_ START USER JAVASCRIPT /_/_/_/_/_/_/_/_/_-->
<script type="text/javascript">

// JSON Define area
var itemStore = new Ext.data.JsonStore({
    root: 'data',
    idProperty: 'item_code',  //<-- Primary key
    successProperty: 'success',
    totalProperty: 'total',
    messageProperty: 'message',
	fields: [ {name: 'item_code'}],
    url: '../MT/MT0010/sheetCodeList'
});

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Component define area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
// Component in rowEditor
var textFieldBlank = rowEditTextField1(true);		
var textFieldNBlank = rowEditTextField1(false);
var numFieldBlank = rowEditNumField1(false);
var itemText = formTextField1(true,true,'item_code','item_code','')
var itemCombo = formCombo2('item_code','<?=lang('item_code')?>','item_code','item_code','',itemStore);

var startDate = formDateField1(false,false,'effect_date_from','<?=lang('effect_date_from')?>',new Date(),'Y-m-d');	
var endDate = formDateField1(false,false,'effect_date_to','<?=lang('effect_date_to')?>',new Date(),'Y-m-d');

var itemComboSearch = formCombo2('item_code','<?=lang('item_code')?>','item_code','item_code','',itemStore);

//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
//             Start Grid Area  
//_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_/_
Ext.onReady(function(){
	var selItem = "";
    Ext.QuickTips.init();
    
	<?php 
		$gname = "item";
		$width = "auto";
		$height = "200";
		$title = "Item Detail";
		$initialLoad = true;
		$enableCollapse = true;
		include(APPPATH.'/views/common/simpleGrid1'.EXT);
		include(APPPATH.'/views/common/simpleAddEvent1'.EXT);
		include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
	?>
	
    function onSelectEvent<?=$gname?>(sm,row,rec)
    {
		var values = rec.data;
        var field, id;
        var obj = new Object();

        obj["params"] = new Object();
        obj["params"]["start"] = 0;
        obj["params"]["limit"] = pageLimit;
        if ( values['item_code'] == "" )
            return;
        obj["params"]["item_code"] = values['item_code'];

    	RootChange(values['item_code']);
    	selItem = values['item_code'];
    	
	    billDataStore.load(obj);
	    billEnableButton(false);        
    }
    

	<?php 
		$gname = "bill";
		$width = "auto";
		$height = "300";
		$initialLoad = false;
		$enableCollapse = false;
		$title = "";
		include(APPPATH.'/views/common/simpleGrid1'.EXT);
		include(APPPATH.'/views/common/simpleAddEvent1'.EXT);
		include(APPPATH.'/views/common/simpleDelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleOnSelEvent1'.EXT);
		include(APPPATH.'/views/common/simpleInitialButton1'.EXT);
	?>
	<?=$gname?>EnableButton(true);
	    
    var Tree = Ext.tree;

    var gridtree = new Tree.TreePanel({
        useArrows: true,
        autoScroll: true,
        height:300,
        animate: true,
        enableDD: true,
        containerScroll: true,
        border: false,
        // auto create TreeLoader
        dataUrl: '<?=$screenId?>/billView',

        root: {
            nodeType: 'async',
            text: 'No Item',
            draggable: false,
            id: 'No Item'
        },

        listeners: {
	        'render': function(tp){
	            tp.getSelectionModel().on('selectionchange', function(tree, node){
	                //var el = Ext.getCmp('details-panel').body;
	                //if(node && node.leaf){
	                    //tpl.overwrite(el, node.attributes);
		            //    alert("hello1" + node.id);
	                //}else{
	                    //el.update(detailsText);
	                    selItem = node.id;
                        var obj = new Object();
                        obj["params"] = new Object();
                        obj["params"]["start"] = 0;
                        obj["params"]["limit"] = pageLimit;
                        obj["params"]["item_code"] = selItem;
                        <?=$gname?>DataStore.load(obj);
		                //alert("hello2"+ node.id);
	                //}
	            })
	        }
	    }

    });
   


	var rootItem = "";
    function RootChange(item){
        var root = new Tree.AsyncTreeNode({
            //nodeType: 'async',
            text: item,
            draggable:false,
            id:item
            //children: json
        });
		rootItem = item;
		gridtree.setRootNode(root);
		gridtree.expand();
    }

	// Final panel	
	<?php 
		$render = $screenId;
	 	$leftWidth = 0.3;
	 	$rightWidth = 0.7;
	 	$leftComp = "tree";
	 	$rightComp = "bill";
	 		
		include_once(APPPATH.'/views/common/simpleFinalPanel2'.EXT);
	?>
    
    // For update tree data    
    Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
    	gridtree.getNodeById(selItem).reload(); 
    });
});
//<-- End Grid Area

</script>

<?php include_once(APPPATH.'/views/common/f_include'.EXT); ?>