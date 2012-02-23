var pageLimit = 100;

function getSysDate() {
    var now = new Date();
    return now.format("yyyy/mm/dd");
}

//================================================
//  Function    : numericOnly
//  Description : allows user to enter only numeric values in textbox
//  Input       : intType
//
//  intType = 1 : used for numeric only values 0 to 9 only
//  intType = 2 : allows  '/' character usually intended for date text box "YYYY/MM/DD" type
//  intType = 3 : allows  '.' character usually intended for values with decimal
//	intType = 4 : allows  '-' character useally intended for zip or tel/fax
//	intType = 5 : allows  ':' character useally intended
//  intType = 6 : allows  '-' character useally intended for minus
//  intType = 7 : allows  '-','.' character  usually intended for values with decimal or minus
//================================================
function numericOnly(obj, evnt, intType) {
    var strVal;
    var _keycode;
    var _srcelement;
    
    if(window.event) {
        _keycode = 	window.event.keyCode;
        _srcelement = window.event.srcElement.value;
    }else {
        _keycode = 	evnt.which;
        _srcelement = obj.value;
    }
	
    if (_keycode < 48 || _keycode > 57)  // 0 to 9
    {
        if(_keycode == 13){ //[_keycode == 13 is enter button]
            return;
        }
        if (intType == 1){
			
            if(window.event) {
                window.event.keyCode = 0;
            }else {
                if( !(_keycode == 8 || _keycode == 0) ){
                    evnt.preventDefault();
                }
                return;
            }
        }
        else
        {
            if((intType == 6 || intType == 7) && _keycode == 45 || _keycode == 0) {
                strVal = _srcelement;
                if(strVal.indexOf("-", 0)!=-1){
                    if(window.event) {
                        window.event.keyCode = 0;
                    }else {
                        evnt.preventDefault();
                    }
                }
                return;
            }

            if (_srcelement == '')
            {
                if(window.event) {
                    window.event.keyCode = 0;
                }else {
                    evnt.preventDefault();
                }
                return;
            }
            if ((intType == 2 && _keycode  == 47)){ //  allows '/' character
                strVal = _srcelement;
            }
            else if ((intType == 3 || intType == 7) && _keycode  == 46 || _keycode == 0)
            {
                strVal = _srcelement;
                if(strVal.indexOf('.',0) != -1) {
                    if(window.event) {
                        window.event.keyCode = 0;
                    }else {
                        evnt.preventDefault();
                    }
                }
            }
            else if (intType == 4 && _keycode  == 45 || _keycode == 0)  //  allows '-' character
                return;
            else if (intType == 5 && _keycode  == 58 || _keycode == 0)  //  allows ':' character ACE Add
                return;
            else {
                if(window.event) {
                    window.event.keyCode = 0;
                }else {
                    if( !(_keycode == 8 || _keycode == 0) ){
                        evnt.preventDefault();
                    }
                    return;
                }
            }
        }
    }
}

function chkKeyInput(e,obj,allowedEng,allowedThai,allowedNum,allowlength)
{
	/*
	var allowedEng = true; //Allow key Eng
	var allowedThai = false; //Allow key Thai
	var allowedNum = true; //Allow key Num
	*/
	var k;

	if(window.event)
	{
		k = window.event.keyCode;	
	}
	else
	{
		k =	e.which;
	}

	var result = false;
	/* Check 0-9 */
	if (k >= 46 && k <= 57)
	{
		result = allowedNum;
	}
	
	/* Check a-z, A-Z */
	if ((k >=65 && k <= 90) || (k >=97 && k <= 122)) {
		result = allowedEng;
	}
	
	/* Check Thai on non-unicode and unicode */

	if ((k >= 161 && k <= 255) || (k >= 3585 && k <= 3675))
	{
		result = allowedThai;
	}
	
	var x = obj.value.length;
	
	if (x > (allowlength - 1)) 
	{
		result = false;
	}
	
	if (k == 8 || k == 0 || k == 32)
	{
		result = true;
	}

	return result;
}

function ReplaceAll(Source,stringToFind,stringToReplace)
{
	var temp = Source;
	var index = temp.indexOf(stringToFind);
	
	while (index != -1)
	{
		temp = temp.replace(stringToFind,stringToReplace);
		index = temp.indexOf(stringToFind);
	}

	return temp;
}

//================================================
//Function    : onSeparateDate
//Description : change date from format "YYYYMMDD" to "YYYY/MM/DD"
//Input       : object of input textbox
//================================================
function onSeparateDate(obj) {
 if (obj.value == "") {
		return;
	}
 if(obj.value.length <= 10){
     var sts = /^(\d{4})[-/]?(\d{2})[-/]?(\d{2})$/.exec(obj.value);
     if (sts == null) {
         var d = new Date();
         _year = d.getFullYear();
         _month = d.getMonth() ;
         _month = ( (''+_month).length > 1 )? _month :'0'+ _month;
         _day = d.getDate();
         _day = ( (''+_day).length > 1 ) ? _day : '0'+_day;
         obj.value = _year + "/" + _month + "/" + _day;
         return;
     } else {
         var wk_y = sts[1];
         var wk_m = sts[2];
         var wk_d = sts[3];
         if( isRealDate(wk_y ,wk_m ,wk_d) ){
             obj.value = wk_y + "/" + wk_m + "/" + wk_d;
         }else{
             var _d = wk_y + "/" + wk_m + "/" + wk_d;
             var d = new Date(_d);
             _year = d.getFullYear();
             _month = d.getMonth() ;
             _month = ( (''+_month).length > 1 )? _month :'0'+ _month;
             _day = d.getDate();
             _day = ( (''+_day).length > 1 ) ? _day : '0'+_day;
             obj.value = _year + "/" + _month + "/" + _day;
             return;
         }
     }
 }else {
     var now = new Date(obj.value);
     var d = now.format("yyyy/mm/dd HH:MM:ss");
     obj.value = d;
 }
}

function isRealDate(wk_y ,wk_m ,wk_d){
 var _chk = true;
 if (parseFloat(wk_y) < 1 || parseFloat(wk_y) > 9999) {
      _chk = false;
 }

 if (parseFloat(wk_m) < 1 || parseFloat(wk_m) > 12) {
     _chk = false;
 }

 if (parseFloat(wk_d) <1) {
      _chk = false;
 }

 // leap year
 if (wk_m.match(/02/)) {
     if ((eval(parseFloat(wk_y) % 4) == 0)
             && (eval(parseFloat(wk_y) % 100) != 0)) {
         if (parseFloat(wk_d) > 29) {
              _chk = false;
         }
     } else {
         if (eval(parseInt(wk_y) % 400) == 0) {
             if (parseFloat(wk_d) > 29) {
                  _chk = false;
             }
         } else {
             if (parseFloat(wk_d) > 28) {
                  _chk = false;
             }
         }
     }
 } else if (wk_m.match(/04|06|09|11/)) {
     if (parseFloat(wk_d) > 30) {
          _chk = false;
     }
 } else {
     if (parseFloat(wk_d) > 31) {
         _chk = false;
     }
 }
 return _chk;
}


//================================================
//Function    : onNoSeparateDate
//Description : change date from format "YYYY/MM/DD" to "YYYYMMDD"
//Input       : object of text input
//================================================
function onNoSeparateDate(obj) {
 if (obj.value == "") {
		return;
	}
	var sts = /^(\d{4})[-/]?(\d{2})[-/]?(\d{2})$/.exec(obj.value);
	if (sts == null) {
     return;
	} else {
		var wk_y = sts[1];
		var wk_m = sts[2];
		var wk_d = sts[3];

		obj.value = wk_y + wk_m + wk_d;
		obj.select();
	}
}
/*
 *  POPUP Function List
 */

var popupList = new Object();

function processPopup(name, url, option)
{
	if (popupList[name] == undefined || popupList[name].closed)
	{
		popupList[name] = window.open(url, name, option);
	}
	
	popupList[name].focus();	
}

function popupSearch(name, url)
{
	var width     = 850;
	var height    = 596;
	var left      = (screen.width  - width)  / 2;
	var top       = (screen.height - height) / 2;
	var status    = 1;
	var menubar   = 0;
    var resizable = 0;
	var dFeatures = "width="+width+",height="+height+",left="+left+",top="+top+",status="+status+", resizable="+resizable+",menubar="+menubar+",scrollbars=1";
	
	processPopup(name, url, dFeatures);
}

function popupReport(name, url)
{
	var width     = 800;
	var height    = 600;
	var left      = (screen.width  - width)  / 2;
	var top       = (screen.height - height) / 2;
	var status    = 0;
	var menubar   = 0;
    var resizable = 1;
	var dFeatures = "width="+width+",height="+height+",left="+left+",top="+top+",status="+status+", resizable="+resizable+",menubar="+menubar;
	
	processPopup(name, url, dFeatures);
}

function popupDisApprove(name, url)
{
	var width     = 400;
	var height    = 182;
	var left      = (screen.width  - width)  / 2;
	var top       = (screen.height - height) / 2;
	var status    = 0;
	var menubar   = 0;
    var resizable = 0;
	var dFeatures = "width="+width+",height="+height+",left="+left+",top="+top+",status="+status+", resizable="+resizable+",menubar="+menubar;
	
	processPopup(name, url, dFeatures);
}

function closePopup()
{
	for (openWin in popupList)
	{
		if (!popupList[openWin].closed)
		{
			popupList[openWin].close();
		}
	}
}

Date.prototype.addDays = function(days) 
{ 
    var dat = new Date(this.valueOf()) 
    dat.setDate(dat.getDate() + days); 
    return dat; 
} 
/*

if (top.frames.length == 0) {	
   if (opener == null) {
	   alert("System not allow you open this page");
	   top.location = "/mwf/login/logout";
   }
}*/