/**
 * Created by Corn on 10/28/14.
 */
(function($){
    var oauth_token = "0SATUW0U3ELSSRIPNMBF4K3IDZMPKHC4IIECG0VWUFVQKHF2";
    var client_id = "Z4K0IZ0P0UOLQ5DRTP4LLU32TJVTAP50MFKEKXOP5NAPFFEK";
    var client_secret = "JXZT5MFR54XBZFHLQ440UQGSRVXQNJ42C33QDH1VL2GA0YDD";
    var map;

    $(document).ready(function () {
        var venueid = $("#FS_ID").html();
        console.log(venueid);
        request(venueid);
    });

    function request(venueid) {

        var baseurl = "https://api.foursquare.com/v2/venues/";
        var version = "20140930";
        var token_verison = "?oauth_token=" + oauth_token + "&v=" + version;
        var id_secret_version = "&client_id=" + client_id + "&client_secret=" + client_secret + "&v=" + version;

        //url for single venue api request
        var single_venue_url = baseurl + venueid + token_verison;
        console.log(single_venue_url);

        $.getJSON(single_venue_url, function (data) {
            console.log(data);
            var venueinfo= data.response.venue;

            //apply venue detail data to page
            var name = venueinfo.name;
            $("#venue_name").html(name);

            var rating = venueinfo.rating;
            $("#venue_rating").html(rating);

            var location = venueinfo.location;

            var addhtml = location.address + ", " + location.city+ ", " + location.state+ " " + location.postalCode + ", " + location.country;
            $("#venue_address").html(addhtml);
            //$("#venue_address").html(location.formattedAddress);

            if(venueinfo.contact.formattedPhone) {
                $("#venue_contact").html(venueinfo.contact.formattedPhone);
            }else {
                $("#contact").remove();
            }

            if(venueinfo.contact.formattedPhone) {
                $("#venue_url").html("<a href=' "+venueinfo.url+"'>"+ venueinfo.url +"</a>");
            }else {
                $("#url").remove();
            }

            if(venueinfo.price){
                var tier ="";
                for(var i=0; i< venueinfo.price.tier; i++){
                    tier += "$";
                }
                $("#venue_price").html(tier);
            } else {
                $("#price").remove();
            }

            if(venueinfo.categories) {
                for(var i = 0 ; i < venueinfo.categories.length; i++){
                    console.log(venueinfo.categories[i].name);
                    $("#venue_category").append("<span class='label label-success'>" + venueinfo.categories[i].name + "</span>");
                }
            }else {
                $("#category").remove();
            }

            if(venueinfo.likes){
                $("#venue_likes").html(venueinfo.likes.count);
            } else {
                $("#likes").remove();
            }

            if(venueinfo.stats.checkinsCount){
                $("#venue_checkins").html(venueinfo.stats.checkinsCount);
            } else {
                $("#checkins").remove();
            }

            if(venueinfo.popular){
                if(venueinfo.popular.isOpen == true)
                    $("#venue_isopen").html("<strong style='color: green'>" + venueinfo.popular.status +"</strong>");
                else $("#venue_isopen").html("<strong style='color: orangered'>Closed</strong>");

            } else {
                $("#isopen").remove();
            }

            //venue tips





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

        //url for new york tendings
        /*var trendingUrl = baseurl + "trending?ll=40.7,-74" + id_secret_version;
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
        });*/
    }
})(jQuery);
