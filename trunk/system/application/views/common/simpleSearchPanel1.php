<?php 
	/*
	 *  Require Variable
	 *  ${$gname} = Configuration Array (eg. Header name, etc.)
	 *  $gname = Grid Name
	 *  $leftComp = left Component (Ex. "itemCombo,locationText")
	 *  $rightComp = Same as Left Component But in right side
	 *  $render = Render area
	 */

?>
	// Search Component
	var leftComp  = [<?=$leftComp?>];
	var rightComp = [<?=$rightComp?>];
    var searchConditions = formMain1(leftComp,rightComp);

    // Search Area
 	var searchPanel = new Ext.form.FormPanel({
        renderTo: '<?=$render?>',
//        frame: false,
//        border: true,
        title   : 'Search Conditions',

        autowidth: true,
        collapsed: false,   
        collapsible: true,        

        bodyStyle: 'padding: 10px;',
     	defaults: { anchor: '0' },

        items   : [
            {
            	layout:'column',
                border: false,
                defaults: {columnWidth: '.5',border: false},   
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

					    <?=$gname?>DataStore.load(obj);
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