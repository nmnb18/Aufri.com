function viewUser() {
	var opts = {
	        type: 'GET',
	        url: 'http://localhost/rest',
	        contentType: 'application/json',
	        success: function(json)
	        {
	              var tr;
	              for (var i = 0; i < json.data.length; i++) {
	                  tr = $('.show');
	                  tr.append("<td>" + json.data[i].accountStatus + "</td>");
	                  tr.append("<td>" + json.data[i].id + "</td>");
	                  tr.append("<td>" + json.data[i].name + "</td>");
	              }
	        },
	        error: function(data)
	        {
	            alert('error');
	        }
	    };
	$.ajax(opts);
}