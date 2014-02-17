//function to read cookie
function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
}

// holds an instance of XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();
// holds the remote server address and parameters
var serverAddress = "back-status.php";

var checkAvailabilityParams = "action=CheckAvailability"; 
// variables used to check for server availability 
var requestsCounter = 0; // counts how many numbers have been retrieved
var checkInterval = 10; // counts interval for checking server availability
var updateInterval = 30; // how many seconds to wait to get a new number
var updateIntervalIfServerBusy = 10; // seconds to wait when server busy
var minServerBufferLevel = 50; // what buffer level is considered acceptable

// creates an XMLHttpRequest instance
function createXmlHttpRequestObject() 
{
  // will store the reference to the XMLHttpRequest object
  var xmlHttp;
  // this should work for all browsers except IE6 and older
  try
  {
    // try to create XMLHttpRequest object
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    // assume IE6 or older
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
                                    "MSXML2.XMLHTTP.5.0",
                                    "MSXML2.XMLHTTP.4.0",
                                    "MSXML2.XMLHTTP.3.0",
                                    "MSXML2.XMLHTTP",
                                    "Microsoft.XMLHTTP");
    // try every prog id until one works
    for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) 
    {
      try 
      { 
        // try to create XMLHttpRequest object
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
      } 
      catch (e) {}
    }
  }
  // return the created object or display an error message
  if (!xmlHttp)
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}

// call server asynchronously
function process()
{
	//get username cookie
	var user=readCookie('username');
	var getStatusParams = "username=" + user;// parameter passed is username
 
  // only continue if xmlHttp isn't void
  if (xmlHttp)
  {
    // try to connect to the server
    try
    {
        // request data to the server
        xmlHttp.open("GET", serverAddress + "?" + 
                                      getStatusParams, true);
        xmlHttp.onreadystatechange = handleGetStatus;
        xmlHttp.send(null);
    }
    catch(e)
    {
      alert("Can't connect to server:\n" + e.toString());
    }
  }
}

// function called when the state of the HTTP request changes
function handleGetStatus() 
{
  // when readyState is 4, we are ready to read the server response
  if (xmlHttp.readyState == 4) 
  {
    // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {
        // do something with the response from the server
        getStatus();
      }
      catch(e)
      {
        // display error message
        alert("Error reading status:\n" + e.toString());
      }
    } 
    else
    {
      // display status message
      alert("Error reading status:\n" + xmlHttp.statusText);
    }
  }
}

// handles the response received from the server
function getStatus()
{
  // retrieve the server's response 
  var response = xmlHttp.responseText;
 
  // if the response is long enough, or if it is void, we assume we just 
  // received a server-side error report
  if(response.length == 0)
    throw("Server error");
  // obtain a reference to the <div> element on the page
  myDiv = document.getElementById("status");
  // display the HTML output
    // display new message to user
    myDiv.innerHTML =  response;     
    // reinitiate sequence 
    setTimeout("process();", updateInterval * 1000);            
}