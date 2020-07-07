var LATITUDE_ELEMENT_ID = "course_latitude";
var LONGITUDE_ELEMENT_ID = "course_longitude";
var MAP_DIV_ELEMENT_ID = "google_map";

var DEFAULT_ZOOM_WHEN_NO_COORDINATE_EXISTS = 15;
var DEFAULT_CENTER_LATITUDE = 22;
var DEFAULT_CENTER_LONGITUDE = 13;
var DEFAULT_ZOOM_WHEN_COORDINATE_EXISTS = 15;

// This is the zoom level required to position the marker
var REQUIRED_ZOOM = 15;

google.load("maps", "2.x");

// The google map variable
var map = null;

// The marker variable, when it is null no marker has been added
var marker = null;

function initMap() {
    map = new google.maps.Map2(document.getElementById(MAP_DIV_ELEMENT_ID));
    map.addControl(new GLargeMapControl());
    map.addControl(new GMapTypeControl());

    map.setMapType(G_NORMAL_MAP);

    var latitude = 20.660373502829383;
    var longitude = -103.34980487823486;


    //We have some sort of starting position, set map center and marker
    map.setCenter(new google.maps.LatLng(latitude, longitude), DEFAULT_ZOOM_WHEN_COORDINATE_EXISTS);
    var point = new GLatLng(latitude, longitude);
    marker = new GMarker(point, {draggable:false});
    map.addOverlay(marker);

    GEvent.addListener(map, "click", googleMapClickHandler);
}


function googleMapClickHandler(overlay, latlng, overlaylatlng) {

    if(map.getZoom() < REQUIRED_ZOOM) {
        alert("You need to zoom in more to set the location accurately." );
        return;
    }
    if(marker == null) {
        marker = new GMarker(latlng, {draggable:false});
        map.addOverlay(marker);
    }
    else {
        marker.setLatLng(latlng);
    }

    document.getElementById('lat').value = latlng.lat();
    document.getElementById('lon').value = latlng.lng();

}

google.setOnLoadCallback(initializeGoogleMap);
