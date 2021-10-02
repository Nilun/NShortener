
function GetImages(Link)
{
	

	var request = new XMLHttpRequest()
	console.log("Debut requête")
	// Open a new connection, using the GET request on the URL endpoint
	request.open('GET', 'https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=' + Link, true)

	request.onload = function () {	
		console.log("Réponse requête")	
		var data = JSON.parse(this.response)	  ;
	  
	   image = document.getElementById('screenshot');
       image.src = data["lighthouseResult"]["audits"]["final-screenshot"]["details"]['data'];
	   console.log(" requête done")	
	}

	// Send request
	request.send()
}