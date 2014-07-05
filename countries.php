<div id="world-map" style="width: 940px; height: 600px;"></div>
<div id="countries-infos"></div>
<script>
    $(function(){
        $('#world-map').vectorMap({
	    backgroundColor: '#fff',
	    regionStyle: {
	 	initial: {
		    fill: '#ad4c45',
		    "fill-opacity": 1,
		    stroke: 'none',
		    "stroke-width": 0,
		    "stroke-opacity": 1
	    },
	    hover: {
		fill: '#bf1910',
		"fill-opacity": 1
	    },
	    selected: {
		fill: '#6a0e09'
            },
	    },
	    onRegionClick: function(e, code)
    	    {
		$.ajax({
		url: 'getdatabase.php?database='+code,
		dataType: "json",
		success: function(data) {
		    var total = "";
		    for (i = 1; i <= data[0]; i++) {
				total += "<tr><td>"+data[i].field1+"</td><td>"+data[i].field2+"</td><td>"+data[i].field3+"</td><td>"+data[i].field4+"</td><td>"+data[i].field5+"</td></tr>";
		    }
		    // Filling the div #countries-infos created just after the world map where information of the database will be inserted
		    $('#countries-infos').replaceWith("<div id=\"countries-infos\"><table class=\"table table-hover\"><tr><td><h5>Field1</h5></td><td><h5>Field2</h5></td><td><h5>Field3</h5></td><td><h5>Field4</h5></td><td><h5>Field5</h5></td></tr>"+total+"</table></div>");
		}
		});
    	    }
    	});
    });
</script>
