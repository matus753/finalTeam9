// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 300) {        
        $('#return-to-top').fadeIn(200);    
    } else {
        $('#return-to-top').fadeOut(200);   
    }
});
function scrollToTop(){     
    $('html').animate({
		scrollTop: $('html').offset().top             
    }, 500);
}

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: {lat: 48.151834, lng: 17.073337},
        mapTypeId: 'roadmap'
    });

    // Construct the circle for each value in citymap.
    // Note: We scale the area of the circle based on the population.
    var marker = new google.maps.Marker({
        position: {lat: 48.151834, lng: 17.073337},
        map: map,
        title: 'STU'
    });
}
