/**
 * 
 */

var bigdata = function (SID,UID,GROUP,MOD,FUNC,ACTION) {
	SID = SID || "10000";
	UID = UID || "guest";
	GROUP = GROUP || "N/A";
	MOD = MOD || "N/A";
	FUNC = FUNC || "N/A";
	ACTION = ACTION || "N/A";
	this.params = {
            "SID" : SID,		// 網站識別碼
								// Elastos:10001;SiteMaker:10002;AppMaker:10003;
            "UID" : UID,		// 訪客身分，有登入，使用User ID，如1901
	         "GROUP":GROUP,		// 第一層功能，各網站依照Menu層級命名，請用英文代碼
	         "MOD":MOD,			// 第二層功能，同上
	         "FUNC":FUNC,		// 第三層功能，大多已經是點擊功能，如連結或是button，請用英文代碼
	         "ACTION":ACTION,	// 第四層功能，大多已經是點擊功能，如連結或是button，請用英文代碼
	         "REFERRER":document.referrer // 取得來源網址
        };
	//this.host = "127.0.0.1";
	//this.host = "job8400.hh";
    this.host = location.protocol + '//' + location.hostname;
    };

    bigdata.prototype = {
	    host:this.host,
		params: '',
		datatype:'JSON',
		senddata: function () {
            //console.log(this.host);
		    $.ajax({
		        //url: "http://"+this.host+"/api/browers",
                url: this.host+"/api/browers",
		        data: this.params,
		        type:"GET",
		        success: function(rtndata){
		            if(rtndata.status == "1"){   
		                  // alert("Success!");
		            }  else {  
		                  // alert("Failed");
		        } }  });
        }
    };


