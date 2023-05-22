//Geolocation by Google

var latitude=0;
var longitude=0;
var accuracy=0;
var s=document.getElementById("print");


const successCallback=(position) =>{
    console.log(position);
    latitude=position.coords.latitude; 
    longitude=position.coords.longitude;
    accuracy=position.coords.accuracy;
    getcity(latitude,longitude);
}

const errorCallback=(position) =>{
    console.log(position);
}   

navigator.geolocation.getCurrentPosition(successCallback,errorCallback);

function getcity(latitude,longitude){
    var location;
    var geocoding;
    geocoding = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);
    //geocode
    geocoding.geocode(
        
        {'latLng': latlng}, 
        function(arr_results, checkok) {
            if (checkok == google.maps.GeocoderStatus.OK) {
                if (arr_results[0]) {
                    var add= arr_results[0].formatted_address ;
                    var  splited=add.split(",");
                    //Splitting to find only the city name from the geocoder response
                    count=splited.length;
                    country=splited[count-1];
                    state=splited[count-2];
                    city=splited[count-3];
                    location_folder = city;
                    //logging the location folder
                    console.log(location_folder);
                s.innerHTML = "The current location is: " + location_folder;
                var days = "10";
                //will save the cookies for 10 days
                var ckname = "location_folder";
                var expires;
            
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    //cookies 
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  //
  document.cookie = escape(ckname) + "=" + location_folder + expires + "; path=/";
}
}
});
}
