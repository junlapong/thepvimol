function rowEditTextField1(isBlank,isRead,value)
{
	var tmp = new Object();		
	tmp["xtype"] = "textfield";
	tmp["allowBlank"] = isBlank;
	if( isRead == null)
		tmp["readOnly"] = false;
	else
		tmp["readOnly"] = isRead;
	tmp["value"] = value;
	return tmp;
}
function rowEditNumField1(isBlank,isRead,value,vType)
{
	var tmp = new Object();		
	tmp["xtype"] = "numberfield";
	tmp["allowBlank"] = isBlank;
	if( isRead == null)
		tmp["readOnly"] = false;
	else
		tmp["readOnly"] = isRead;
	tmp["value"] = value;
	tmp["vtype"] = vType;
	return tmp;
}

function formTextField1(isBlank,isRead,name,lable,value)
{
	var tmp = new Object();		
	tmp["xtype"] = "textfield";
	tmp["allowBlank"] = isBlank;
	tmp["readOnly"] = isRead;
	tmp["name"] = name;
	tmp["fieldLabel"] = lable;
	tmp["value"] = value;
	
	return tmp;
}

function formTextField2(isBlank,isRead,name,lable,value,width)
{
	var tmp = new Object();		
	tmp["xtype"] = "textfield";
	tmp["allowBlank"] = isBlank;
	tmp["readOnly"] = isRead;
	tmp["name"] = name;
	tmp["width"] = width;
	tmp["fieldLabel"] = lable;
	tmp["value"] = value;
	
	return tmp;
}

function formNumField1(isBlank,isRead,name,lable,value,width,format)
{
	var tmp = new Object();		
	tmp["xtype"] = "numberfield";
	tmp["allowBlank"] = isBlank;
	tmp["readOnly"] = isRead;
	tmp["name"] = name;
	tmp["width"] = width;
	tmp["fieldLabel"] = lable;
	tmp["value"] = value;
	
	return tmp;
}
function formDateField1(isBlank,isRead,name,lable,value,format)
{
	var tmp = new Object();		
	tmp["xtype"] = "datefield";
	tmp["allowBlank"] = isBlank;
	tmp["readOnly"] = isRead;
	tmp["name"] = name;
	tmp["fieldLabel"] = lable;
	tmp["value"] = value;
	tmp["format"] = format;

	return tmp;
}

function formCombo1(name,lable,dispF,valF,value,store)
{
	var tmp = new Object();	
	
	tmp["xtype"] = 'combo';
	tmp["displayField"] = dispF;
	tmp["valueField"] = valF;
	tmp["hiddenName"] = valF;
	tmp["value"] = value;
	tmp["mode"] = 'local';
	tmp["typeAhead"] = true;
	tmp["triggerAction"] = 'all';
	tmp["store"] = store;
	tmp["selectOnFocus"] = true;
	tmp["forceSelection"] = true;
	tmp["minChars"] = 2;
	tmp["name"] = name;
	tmp["fieldLabel"] = lable;

	return tmp;
}

function formCombo2(name,lable,dispF,valF,value,store)
{
	var tmp = new Object();	
	
	tmp["xtype"] = 'combo';
	tmp["displayField"] = dispF;
	tmp["valueField"] = valF;
	tmp["hiddenName"] = valF;
//	tmp["value"] = value;
//	tmp["mode"] = 'local';
	tmp["typeAhead"] = true;
	tmp["triggerAction"] = 'all';
	tmp["store"] = store;
	tmp["selectOnFocus"] = true;
	tmp["forceSelection"] = true;
	tmp["minChars"] = 2;
	tmp["name"] = name;
	tmp["fieldLabel"] = lable;

	return tmp;
}

function formCombo3(name,lable,dispF,valF,value,store)
{
	var tmp = new Object();	
	
	tmp["xtype"] = 'combo';
	tmp["displayField"] = dispF;
	tmp["valueField"] = valF;
	tmp["hiddenName"] = valF;
	tmp["allowBlank"] = false;
	tmp["readOnly"] = false;
	tmp["typeAhead"] = true;
	tmp["triggerAction"] = 'all';
	tmp["store"] = store;
	tmp["selectOnFocus"] = true;
	tmp["forceSelection"] = true;
	tmp["minChars"] = 2;
	tmp["name"] = name;
	tmp["fieldLabel"] = lable;

	return tmp;
}

function formComposit1(name,lable,items)
{
	var tmp = new Object();	
             
	tmp["xtype"] = 'compositefield';
	tmp["fieldLabel"] = lable;
	tmp["msgTarget"] = 'under';
	tmp["items"] = items;

	return tmp;
}

function addDeleteButton(type)
{
	var tmp = new Object();
	if(type == "add"){
		tmp["text"] = "Add";
		tmp["iconCls"] = "silk-add";	
		tmp["itemId"] = "addAction";	
		tmp["handler"] = addEvent(btn,ev);
	}else{
		tmp["text"] = "Delete";
		tmp["iconCls"] = "silk-delete";	
		tmp["itemId"] = "deleteAction";	
		tmp["handler"] = deleteEvent(btn,ev);		
	}
	
	return tmp;
}

function formMain1(leftComp,rightComp)
{
	var tmpLeft = new Object();
	
	tmpLeft['bodyStyle'] = 'padding-right:5px;';
	tmpLeft['items'] = new Object();
	tmpLeft['items']['xtype'] = 'fieldset';
	tmpLeft['items']['border'] = false;
	tmpLeft['items']['title'] = ' ';
	tmpLeft['items']['items'] = leftComp;

	var tmpRight = new Object();
	tmpRight['bodyStyle'] = 'padding-left:5px;';
	tmpRight['items'] = new Object();
	tmpRight['items']['xtype'] = 'fieldset';
	tmpRight['items']['border'] = false;
	tmpRight['items']['title'] = ' ';
	tmpRight['items']['items'] = rightComp;
	
	var tmp = [tmpLeft,tmpRight];
	return tmp;
}

//Define App tool for popup message
var App = new Ext.App({});

Ext.data.DataProxy.addListener('write', function(proxy, action, result, res, rs) {
	App.setAlert(true, action + ':Write:' + res.message);
});
Ext.data.DataProxy.addListener('exception', function(proxy, type, action, options, res) {
	App.setAlert(false, "ERROR: " + res.message);
});
//<-- End Alert Message
var editor = new Ext.ux.grid.RowEditor({ saveText: 'Update' });

// Common Render
function per_lost1(val){
	var result = Ext.util.Format.number(val,'0,000.00' + '%');
	if( val < 0 || val > 5)
	{
        result = '<span style="color:red;">' + result + '</span>';
	}
	return result;
}

function recv_issue(val){
    if(val.indexOf('UI') == 0 || val.indexOf('PI') == 0){
        return '<span style="color:red;">' + val + '</span>';
    }else {
        return '<span style="color:blue;">' + val + '</span>';
    }
    return val;
}
function num_rend(val){
	var result = Ext.util.Format.number(val,'0,000.00');
	if( val < 0 )
	{
        result = '<span style="color:red;">' + result + '</span>';
	}
	return result;
}

function num_rend3d(val){
	var result = Ext.util.Format.number(val,'0,000.000');
	if( val < 0 )
	{
        result = '<span style="color:red;">' + result + '</span>';
	}
	return result;
}

function num_rend5d(val){
	var result = Ext.util.Format.number(val,'0,000.00000');
	if( val < 0 )
	{
        result = '<span style="color:red;">' + result + '</span>';
	}
	return result;
}

function num_rend8d(val){
	var result = Ext.util.Format.number(val,'0,000.00000000');
	if( val < 0 )
	{
        result = '<span style="color:red;">' + result + '</span>';
	}
	return result;
}

function order_status(val){
	var result = val;
	if( val == "ยกเลิก" )
	{
        result = '<span style="font:bold;color:red;">' + result + '</span>';
	}
	if( val == "รอใบเบิก" )
	{
        result = '<span style="font:bold; color:Darkgreen;">' + result + '</span>';
	}
	if( val == "ส่งบางส่วน" )
	{
        result = '<span style="font:bold; color:#FF0080;">' + result + '</span>';
	}
	if( val == "รอส่ง" )
	{
        result = '<span style="font:bold; color:Darkorange;">' + result + '</span>';
	}
	if( val == "ปิด" )
	{
        result = '<span style="font:bold; color:blue;">' + result + '</span>';
	}
	return result;
}

// Override function for not check hidden form
Ext.override(Ext.form.BasicForm, {
    isValid : function(){
        var valid = true;
        this.items.each(function(f){
           if(!f.validate() && f.isVisible()){
               valid = false;
           }
        });
        return valid;
     }
});

// Event Handle for grid checkbox vvv
Ext.ux.grid.CheckColumn = function(config){
	this.addEvents({
	click: true
	});
Ext.ux.grid.CheckColumn.superclass.constructor.call(this);

Ext.apply(this, config, {
init : function(grid){
this.grid = grid;
this.grid.on('render', function(){
var view = this.grid.getView();
view.mainBody.on('mousedown', this.onMouseDown, this);
}, this);
},

onMouseDown : function(e, t){
if(t.className && t.className.indexOf('x-grid3-cc-'+this.id) != -1){
e.stopEvent();
var index = this.grid.getView().findRowIndex(t);
var record = this.grid.store.getAt(index);
record.set(this.dataIndex, !record.data[this.dataIndex]);
this.fireEvent('click', this, e, record);
}
},

renderer : function(v, p, record){
p.css += ' x-grid3-check-col-td';
return '<div class="x-grid3-check-col'+(v?'-on':'')+' x-grid3-cc-'+this.id+'"> </div>';
}
});

if(!this.id){
this.id = Ext.id();
}
this.renderer = this.renderer.createDelegate(this);
};

// register ptype
Ext.preg('checkcolumn', Ext.ux.grid.CheckColumn);

// backwards compat
Ext.grid.CheckColumn = Ext.ux.grid.CheckColumn;

Ext.extend(Ext.grid.CheckColumn, Ext.util.Observable);
//Event Handle for grid checkbox ^^^
