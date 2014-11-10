/**
 * Created by Corn on 11/9/14.
 */
(function($){
$(document).ready(function () {

    //init map canvas
    map = new GMaps({
        div: '#map',
        zoom: 4,
        lat: 33.942536,
        lng: -118.408075
    });



    var hidden_lat = $("#venue-results").find(".lat");
    var hidden_long = $("#venue-results").find(".long");
    var category = $(".category").html();
    console.log(hidden_lat);
    console.log(hidden_long);

    //plot location on map
    for(var i = 0; i< hidden_long.length; i++){
        var lat = $(hidden_lat[i]).html();
        var long = $(hidden_long[i]).html();
        console.log(lat, long);
        map.addMarker({
            lat: lat,
            lng: long
            //icon: "/img/icons/mappin/"+category.trim()+".jpg"
        });
    }
    map.fitZoom();
});

})(jQuery);