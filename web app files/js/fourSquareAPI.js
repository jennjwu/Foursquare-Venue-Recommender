/**
 * Created by Corn on 10/28/14.
 */
var oauth_token = "0SATUW0U3ELSSRIPNMBF4K3IDZMPKHC4IIECG0VWUFVQKHF2";
var client_id = "Z4K0IZ0P0UOLQ5DRTP4LLU32TJVTAP50MFKEKXOP5NAPFFEK";
var client_secret = "JXZT5MFR54XBZFHLQ440UQGSRVXQNJ42C33QDH1VL2GA0YDD";

$(document).ready(function () {
   request();
});

function request(){

    var baseurl= "https://api.foursquare.com/v2/venues/";
    var version = "20140930";
    var token_verison = "?oauth_token=" + oauth_token + "&v=" +version;
    var id_secret_version = "&client_id=" + client_id + "&client_secret=" + client_secret + "&v=" +version;


    //url for single venue api request
    var venueID = "4a53c067f964a520b2b21fe3";

    var single_venue_url = baseurl+ venueID+ token_verison;

    $.getJSON(single_venue_url, function (data) {
        console.log(data);

        $("#result").html(data.response.venue.id + ", " + data.response.venue.name);

    });

    //url for all venues search
    var lat = 37.3, lng = -121.88;
    var searchUrl = baseurl + "search?ll=" + lat +"," + lng + id_secret_version;

    console.log(searchUrl);

    $.getJSON(searchUrl, function (data) {
        console.log(data);
        var resultHtml = "";

        $.each(data.response.venues, function (i, item) {
            resultHtml += "<li>";
            resultHtml += item.id + ", " + item.name;
            resultHtml += "</li>";
            $("#searchResult").append(resultHtml);
        });
    });
}