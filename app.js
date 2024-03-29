mapboxgl.accessToken = 'pk.eyJ1Ijoia2FrYXJzdWhhaWwiLCJhIjoiY2tpaWxsa205MjhjbDJ5cGVhaWRkaWI1MCJ9.9wW7P75jPB9RE7xLfdZEaA';
navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {
	enableHighAccuracy: true
})

function successLocation(position) {
	setupMap([position.coords.longitude, position.coords.latitude])
}

function errorLocation() {
	setupMap([121.0668185,14.7273575])
}

function setupMap(center) {
	const address = $('#map').data('map');
	console.log(address)
	const map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: center,
		zoom: 15
	})
	const nav = new mapboxgl.NavigationControl();
	map.addControl(nav, "bottom-right")
	const directions = new MapboxDirections({
		accessToken: mapboxgl.accessToken
	})
	map.addControl(directions, "top-left")
		map.on('load',  function() {
			directions.setOrigin('12 Resurreccion Street, Sta Ana 1850 San Mateo, Philippines'); 
			
			directions.setDestination(address); 
		})
}