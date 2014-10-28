/**
 * Created by Corn on 10/28/14.
 */


$(document).ready(function () {
   request();
});

function request(){
    var url = "https://api.foursquare.com/v2/venues/4a53c067f964a520b2b21fe3?client_id=Z4K0IZ0P0UOLQ5DRTP4LLU32TJVTAP50MFKEKXOP5NAPFFEK&client_secret=JXZT5MFR54XBZFHLQ440UQGSRVXQNJ42C33QDH1VL2GA0YDD&v=20140930"

    $.getJSON(url, function (data) {
        console.log(data);

        $("#result").html(data.response.venue.id + ", " + data.response.venue.name);

    });
}