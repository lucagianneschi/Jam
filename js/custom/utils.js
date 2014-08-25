function geocomplete(id){
    try {    	
		$(id).geocomplete({
			details: "form",
          	detailsAttribute: "data-geo",
			markerOptions: {
			    draggable: true
			  }
		}).bind("geocode:result", function(event, result) {
			    return prepareLocationObj(result);
			})
			.bind("geocode:error", function(event, status) {
			    return null;
		
			})
			.bind("geocode:multiple", function(event, results) {
			    return prepareLocationObj(results[0]);
			});
			
    } catch (err) {
		console.log("geocomplete | An error occurred - message : " + err.message);
    }
	
}

function prepareLocationObj(_result) {
    try {
		var location = {};
			location.latitude = _result.geometry.location.lat();
			location.longitude = _result.geometry.location.lng();
			compileForm(location);
		return location;
    }
    catch (err) {
		window.console.error("prepareLocationObj | An error occurred - message : " + err.message);
    }
}

/*
 * verifica numero max di checkbox
 */
var maxCheck = {'genre':0, 'type':0};
function checkmax(elemento, max, type) {	
	try {
		var count = type == 'genre' ? maxCheck.genre : maxCheck.type;
		var idInput = type == 'genre' ? '#boxgenre' : '#boxtype';
		if (elemento.checked) {
			if ((count + 1) == max){
				$(idInput+ ' input').val($(elemento).val());
				count += 1;
			} 
			else if ((count) + 1 > max) elemento.checked = false;
			else count += 1;
		} else{
			$(idInput+ ' input').val('');
			count -= 1;			
		}  
		
		if(type == 'genre'){
			maxCheck.genre = count;
		}  
		else{
			
			maxCheck.type = count;
		} 
		
	} catch (err) {
		window.console.error("checkmaxLocalType | An error occurred - message : " + err.message);
	}

}


function onCarouselReady(id) {
//scorrimento lista album  
    var sliderInstance = $(id).touchCarousel({
		pagingNav: true,
		snapToItems: true,
		itemsPerMove: 1,
		scrollToLast: false,
		loopItems: false,
		scrollbar: false,
		dragUsingMouse: false
    }).data("touchCarousel");
    //gestione select album record
    /*
    $('.uploadAlbum-boxSingleAlbum').click(function() {
	$("#uploadAlbum01").fadeOut(100, function() {
	    $("#uploadAlbum03").fadeIn(100);
	});
	imageList = new Array();
	json_album_update = {"albumId": this.id};
	if (uploader === null) {
	    initImgUploader();
	}
    });*/
}