var myRes;                                                                                                                                                       //Cookie scripts
function setCookie(c_name,value,exdays)
{
  var exdate=new Date();
  exdate.setDate(exdate.getDate() + exdays);
  var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString())+";path=\/";
  document.cookie=c_name + "=" + c_value;
  
}

//This is hacked from W3Schools
function getCookie(c_name)
{
  var i,x,y,ARRcookies=document.cookie.split(";");
  for (i=0;i<ARRcookies.length;i++)
  {
    x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
    y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
    x=x.replace(/^\s+|\s+$/g,"");
    if (x==c_name)
      {
      return unescape(y);
      }
    }
}



//Get Lead info, if it exists

//This specifies the cookie name
var cookieName='NetStart_LEAD_DATA',

//This specifies its value: the format will be X=VALUE1_DELIMITER_Y=VALUE2_DELIMITER_Z=VALUE3
cookieValue='',

//This is how long the cookie is valid
cookieDuration=1,

//The service that goes and tries to get the lead info
service = '/service/getLead.php';


$(document).ready(function() {
	
	//Check if the cookie has already been written
	//if (getCookie(cookieName)) return;

	//We get lead info from the cookie _mkto_trk
	//If it is not there, we're out of luck
	var cookie = getCookie('_mkto_trk');

	if (cookie)
	{
		$.getJSON(service+'?_mkto_trk='+escape(cookie)).done(function(d)
		{
			console.log('D=',d);
			myRes = d;
			if ('responseCode' in d && d['responseCode'] == 0 && 'responseMessage' in d) 
			{
				var response = d['responseMessage'];
				for (var i = 0;i<response.length;i++) 
				{
					cookieValue+=response[i]['attrName']+'='+response[i]['attrValue']+'_DELIMITER_';
				}
				
				if (response.length>1) {
					cookieValue=cookieValue.replace(/_DELIMITER_$/,'');
					setCookie(cookieName,cookieValue,cookieDuration);
				}
			} else {
				console.log('error getting lead data');
			}

		}).fail(function() {
			console.log('error getting lead data');
		});
	}
});
