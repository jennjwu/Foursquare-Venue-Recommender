/**
 * Created by Corn on 10/28/14.
 */
(function($){
    var oauth_token = "0SATUW0U3ELSSRIPNMBF4K3IDZMPKHC4IIECG0VWUFVQKHF2";
    var client_id = "Z4K0IZ0P0UOLQ5DRTP4LLU32TJVTAP50MFKEKXOP5NAPFFEK";
    var client_secret = "JXZT5MFR54XBZFHLQ440UQGSRVXQNJ42C33QDH1VL2GA0YDD";
    var map;

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
        console.log(hidden_lat);
        console.log(hidden_long);

        for(var i = 0; i< hidden_long.length; i++){
            var lat = $(hidden_lat[i]).html();
            var long = $(hidden_long[i]).html();
            console.log(lat, long);
            map.addMarker({lat: lat, lng: long});
        }
        map.fitZoom();

        //request();
    });

    function request() {

        var baseurl = "https://api.foursquare.com/v2/venues/";
        var version = "20140930";
        var token_verison = "?oauth_token=" + oauth_token + "&v=" + version;
        var id_secret_version = "&client_id=" + client_id + "&client_secret=" + client_secret + "&v=" + version;

        //url for single venue api request
        var venueID = "4a53c067f964a520b2b21fe3";

        var single_venue_url = baseurl + venueID + token_verison;

        $.getJSON(single_venue_url, function (data) {
            console.log(data);

            $("#result").html(data.response.venue.id + ", " + data.response.venue.name);

        });

        //url for all venues search
        /*var lat = 37.3, lng = -121.88;
        var searchUrl = baseurl + "search?ll=" + lat + "," + lng + id_secret_version;
        $.getJSON(searchUrl, function (data) {
            console.log(data);
            var resultHtml = "";

            $.each(data.response.venues, function (i, item) {
                //add marker to map
                var lat = item.location.lat;
                var lng = item.location.lng;

                console.log(lat,lng);

                map.addMarker({lat: lat, lng: lng});


                resultHtml += "<li>";
                resultHtml += item.id + ", " + item.name;
                resultHtml += "</li>";
                $("#searchResult").append(resultHtml);

            });
        }).done(function () {
            map.fitZoom();
        });*/

        //url for new your tendings
        var trendingUrl = baseurl + "trending?ll=40.7,-74" + id_secret_version;
        $.getJSON(trendingUrl, function (data) {
            console.log(data);
            var resultHtml = "";

            $.each(data.response.venues, function (i, item) {
                //add marker to map
                var lat = item.location.lat;
                var lng = item.location.lng;
                map.addMarker({lat: lat, lng: lng});

                resultHtml += "<li>";
                resultHtml += item.id + ", " + item.name;
                resultHtml += "</li>";
                $("#searchResult").append(resultHtml);

            });
        }).done(function () {
            map.fitZoom();
        });
    }
})(jQuery);
