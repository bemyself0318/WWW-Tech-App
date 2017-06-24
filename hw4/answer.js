var shoutNo = 0;
var cleanNo = 0;
var TotalNo = 0;
var GetPid = "";
var check_clearMap = -1;
var notfullfeature_geojson = null;
var vectorSourceb7 = null;
var clusterSourceb7 = null;
var trainstationSourcef = null;
var buffersize = 0;
var center_geojson = null;
var buffer_wkt = null;
var markerSource = new ol.source.Vector({});
var trainstationSource = null;
var markerLayer = null ; 






var AllMap = iniMap();

showClickPoint();





function iniMap() {



    var view = new ol.View({
        center: ol.proj.transform([121.0001, 23.5], 'EPSG:4326', 'EPSG:3857'),
        zoom: 7
    });

    var source = new ol.source.Vector();

    var baseLayer = new ol.layer.Tile({
        source: new ol.source.OSM()
    });

    var layer = new ol.layer.Vector({
        source: source
    });



    var map = new ol.Map({
        target: 'mapa',
        controls: ol.control.defaults().extend([
            new ol.control.ScaleLine(),
            new ol.control.ZoomSlider()
        ]),
        renderer: 'canvas',
        layers: [baseLayer],
        view: view
    });



    map.addLayer(layer);

    return map;



}


function showClickPoint() {

	var lat,lng;
    AllMap.on('click', function(evt) {
        if(check_clearMap >= 0){
        	markerSource.clear();

        }

        lonlat = ol.proj.transform(evt.coordinate, 'EPSG:3857', 'EPSG:4326');
        lng = lonlat[0];
        lat = lonlat[1];

        iconFeature = new ol.Feature({
            name: "icon",
            geometry: new ol.geom.Point(ol.proj.transform([lng, lat], 'EPSG:4326', 'EPSG:3857')),
        });


        iconStyle = new ol.style.Style({
            image: new ol.style.Icon(({
                scale: 0.4,
                anchor: [0.5, 1],
                anchorXUnits: 'fraction',
                anchorYUnits: 'fraction',
                src: 'icon/allow.png'
            })),
        });

        markerSource.addFeature(iconFeature);


         markerLayer = new ol.layer.Vector({
            source: markerSource,
            style: iconStyle
        });

        AllMap.addLayer(markerLayer);


        /*You should check the query ragne size before you query the train station*/
    	// you should send lng,lat and query ragne size to this function
				
		$('#button').click(function(){
		
		range = $("#range").val();
		if(range<1 || range>10) {
			alert('請輸入1-10之間的數字');
			return ;
		} 
		queryTrainstation(lat, lng, range);
		});
    });
	

}



	

function showTrainstationPoint(trainstation) {

    trainstation_geojson = (new ol.format.GeoJSON()).readFeatures(trainstation, { dataProjection: 'EPSG:4326', featureProjection: 'EPSG:3857' });


    trainstationSourcef = new ol.source.Vector({
        features: trainstation_geojson
    });

    trainstationSource = new ol.layer.Vector({
        source: trainstationSourcef,
    });
	
	AllMap.addLayer(trainstationSource);
}

function queryTrainstation(lat, lng, buffersize) {

	 if (check_clearMap > 0) {        
        trainstationSourcef.clear();
        AllMap.removeLayer(trainstationSource);

     }

	var data = {'lat':lat , 'lng':lng , 'size':buffersize};
		$.post("result.php",data,function(data){
			
			check_clearMap = 1;
			featuresb7 = data['landmarkna'];
			showTrainstationPoint(featuresb7);
			showtable(data['landmarkna']['features']);
		}, "json")
}

function showtable(data) {
  $('#result tr').remove();
  $.each(data, function(i, station) {
    var station_name = station['properties']['landmarkna'];
    var station_address = station['properties']['address'];
    var station_distance = station['properties']['distance'];
    $('#result').append(
      '<tr><td>' + station_name + '</td><td>' + station_address + '</td><td>' + station_distance + '</td></tr>'
    );
  });
}

