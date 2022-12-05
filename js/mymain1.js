var map;
const radius1=20000;
var lat1;
var long1;
var pyrmont;
const findMyState = () => {

    const status=document.querySelector('.status');
    
    const success= (position) => {
        console.log(position);
        lat1=position.coords.latitude;
         long1=position.coords.longitude;
        console.log(lat1 + ' ' + long1);
         pyrmont = new google.maps.LatLng(lat1,long1);
        // const type="restaurant";
        // const radius="20000"
        // const URL = `https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=[YOUR_API_KEY]&location=${latitude},${longitude}&radius=${radius}&type=${type}`;

        // fetch(URL).then(data=> {
        // return data.json()
        // }).then(jsonData => {
        // console.log(jsonData.results)
        // }).catch(error=> {
        // console.log(error);
        // }) 




        initMap(lat1,long1);


    }

    const error = () => {
        status.textContent = 'Unable to retrieve your location';
    
    }

    navigator.geolocation.getCurrentPosition(success,error);
}

function initMap(lat1,long1) {
    //var test= {lat:lat1, lng: long1};
     map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      
      center: pyrmont
    });
    var marker = new google.maps.Marker({
      position: pyrmont,
      title:'Your location',
      map: map
    });
    map.addListener("center_changed", () => {
        // 3 seconds after the center of the map has changed, pan back to the
        // marker.
        window.setTimeout(() => {
          map.panTo(marker.getPosition());
        },100000);
      });
    
      // marker.addListener("click", () => {
      //   map.setZoom(16);
      //   map.setCenter(marker.getPosition());
      // });


    
    //service = new google.maps.event.addListenerOnce(map, 'bounds_changed', performSearch);
    performSearch();
  }

document.querySelector('.find-state').addEventListener('click', findMyState);
//google.maps.event.addDomListener(window, 'click',findMyState);


function handleSearchResults(results) {

   
      console.log(results.length);
      var infoWindow = new google.maps.InfoWindow();
      //var data1="";
        for (var i = 0; i < results.length; i++) {
          var data1=results[i];
            const image = {
                url: results[i].icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
              };
            var marker = new google.maps.Marker({
                //typo: it must be location not Location
                icon:image,
                url: 'booking1.php'+'?p1='+results[i].name ,

            
                position: results[i].geometry.location,
                title:'booking1.php'+'?p1='+results[i].name ,
                map: map
            });
           
           // var contentString = `<a href=${marker.url}>${results[i].name} </a>`;
           //data1=results[i].name
           
            console.log(results[i].types+ "   "+  results[i].name);
            // google.maps.event.addListener(marker, 'click', function() {
              
            //  // window.location.href = marker.url ;
            //     infowindow.setContent(`<a href=${marker.url}>${marker.url} </a>`);
            //     infowindow.open(map, marker)
            //    // infowindow.zIndex(1);

            //  // window.open(marker.url,"_self");
            // // marker.openInfoWindowHtml("Some stuff");
            // });
        
           

            (function (marker, data1) {
              google.maps.event.addListener(marker, "click", function (e) {
                  //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                 //craete array for name and replace space with _ and do a get request
                 var name=data1.name;
                 var withUnderscore = name.split(' ').join('%');
                  infoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + 
                  "<a href="+
                  'booking1.php?p1='+withUnderscore+">"+withUnderscore+"</a> " +"</div>");
                  infoWindow.open(map, marker);
              });
            })(marker, data1);

          
      
            
              marker.addListener("click", () => {
                map.setZoom(16);
                map.setCenter(marker.getPosition());
                
            
              });

              
        }
    

}

function performSearch() {
    let getNextPage;
    const moreButton = document.getElementById("more");
  
    moreButton.onclick = function () {
      moreButton.disabled = true;
      if (getNextPage) {
        getNextPage();
      }
    };

    var request = {
        location: pyrmont,
        radius: 2000,
       // rankBy: google.maps.places.RankBy.DISTANCE,
      //  types:['restaurant','meal_delivery','cafe','food','store'],
      types:[output]
        
    };

    var service = new google.maps.places.PlacesService(map);
    //use only the name of the function as callback-argument
    service.nearbySearch(request, 
        (results, status, pagination) => {
            if (status !== "OK" || !results) return;
      
            handleSearchResults(results);
            moreButton.disabled = !pagination || !pagination.hasNextPage;
            if (pagination && pagination.hasNextPage) {
              getNextPage = () => {
                // Note: nextPage will call the same handler function as the initial call
                pagination.nextPage();
              };
            }
          }
    );
        
        
        
        


}

function initialize(location) {
    var myLatlng = new google.maps.LatLng(location.coords.latitude, 
                                          location.coords.longitude);

    var mapOptions = {
        center: myLatlng,
        zoom: 9
    };
    //removed the var-keyword(otherwise map is not global accessible)
    map = new google.maps.Map(document.getElementById("map-canvas"), 
                              mapOptions);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: "My place"
    });
    //again: use only the name of the function as callback-argument
    service = new google.maps.event.addListenerOnce(map, 
                                                    'bounds_changed', 
                                                     performSearch);
}



// $(document).ready(function () {
//     navigator.geolocation.getCurrentPosition(initialize);
// });

function getOption() {
  selectElement = document.querySelector('#select1');
  output = selectElement.value;
  document.querySelector('.output').textContent = output;

}