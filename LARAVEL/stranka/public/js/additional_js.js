
var redirect = null;

$(document).ready(function(){
    $("#alert").fadeTo(4000, 500).fadeOut(500, function(){
        $("#alert").fadeOut(500);
    });
});

function confirmation_redirect(head,text,link){
    redirect = link;
    $('#confirmation-title').text(head);
    $('#confirmation-body').text(text);
    $('#confirmation-modal').modal('show');
    $('#confirmation-modal').on('shown.bs.modal', function(){
        $('#confirmation-modal-cancel').focus();
    });
}

$(document).ready(function(){
    $('#confirmation-modal-ok').click(function(){
        if(redirect != null){
            window.location = redirect;
        }
    });
});

// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 300) {        
        $('#return-to-top').fadeIn(500);    
    } else {
        $('#return-to-top').fadeOut(500);   
    }
});
function scrollToTop(){     
    $('html').animate({
		scrollTop: $('html').offset().top             
    }, 500);
}

function initMap() {
    var travel_mode = 'WALKING';
    var fei = {lat: 48.154556, lng: 17.072645};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: fei,
        mapTypeId: 'roadmap'
    });

    // Construct the circle for each value in citymap.
    // Note: We scale the area of the circle based on the population.
    var marker = new google.maps.Marker({
        position: fei,
        map: map,
        title: 'STU'
    });

    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);

    var origin_input = document.getElementById('origin-input');
    // var destination_input = document.getElementById('destination-input');
    var modes = document.getElementById('mode-selector');

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin_input);
    // map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination_input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(modes);

    var origin_autocomplete = new google.maps.places.Autocomplete(origin_input);
    origin_autocomplete.bindTo('bounds', map);

    function setupClickListener(id, mode) {
        var radioButton = document.getElementById(id);
        radioButton.addEventListener('click', function() {
            travel_mode = mode;
            route(origin_place_id, fei, travel_mode,
                directionsService, directionsDisplay);
        });
    }
    setupClickListener('changemode-walking', 'WALKING');
    setupClickListener('changemode-transit', 'TRANSIT');
    setupClickListener('changemode-driving', 'DRIVING');

    function expandViewportToFitPlace(map, place) {
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    }

    origin_autocomplete.addListener('place_changed', function() {
        var place = origin_autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        expandViewportToFitPlace(map, place);


        // If the place has a geometry, store its place ID and route if we have
        // the other place ID
        origin_place_id = place.place_id;
        route(origin_place_id, fei, travel_mode,
            directionsService, directionsDisplay);
    });

    function route(origin_place_id, destination_place_id, travel_mode,
                   directionsService, directionsDisplay) {
        if (!origin_place_id || !destination_place_id) {
            return;
        }
        directionsService.route({
            origin: {'placeId': origin_place_id},
            // destination: {'placeId': destination_place_id},
            destination: fei,
            travelMode: travel_mode
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
                var vzdialenost = 0;
                var legs = response.routes[0].legs;
                for(var i = 0; i < legs.length; i++){
                    vzdialenost += legs[i].distance.value;
                }
                document.getElementById("output").value = vzdialenost/1000;
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
}

function myAlert(type, message) {
    var div = document.getElementById('alert-div');
    if(type === 'success') {
        div.innerHTML = "<div id='alert' class='alert alert-success alert-dismissable fade in' style='position: fixed; z-index: 999999999999; top:8em; right:2em;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong><br>" + message;
        div.innerHTML += ".</div>";
    }
    if(type === 'warning') {
        div.innerHTML = "<div id='alert' class='alert alert-warning alert-dismissable fade in' style='position: fixed; z-index: 999999999999; top:8em; right:2em;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Warning!</strong><br>" + message;
        div.innerHTML += ".</div>";
    }
    if(type === 'error') {
        div.innerHTML = "<div id='alert' class='alert alert-error alert-dismissable fade in' style='position: fixed; z-index: 999999999999; top:8em; right:2em;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Error!</strong><br>" + message;
        div.innerHTML += ".</div>";
    }
    if(type === 'info') {
        div.innerHTML = "<div id='alert' class='alert alert-info alert-dismissable fade in' style='position: fixed; z-index: 999999999999; top:8em; right:2em;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Info!</strong><br>" + message;
        div.innerHTML += ".</div>";
    }
    setTimeout(function() {
        div.innerHTML = '';
    }, 2000);
}

