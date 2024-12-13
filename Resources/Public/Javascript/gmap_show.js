let TPcenter = new google.maps.LatLng (47.3500361,8.7207699);
let TPzoom = 12;
let TPtreffpunkt = "";
let TPmap;
let TPmarker;

async function initialize() {
	const {Map} = await google.maps.importLibrary('maps');
	const {AdvancedMarkerElement} = await google.maps.importLibrary('marker');

    TPmap = new Map(
		document.getElementById("Karte"), 
        {
          center: TPcenter,
          zoom: TPzoom,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
		  draggableCursor: 'crosshair',
		  draggingCursor: 'pointer',
		  mapTypeControl: true,
		  fullscreenControl: false,
		  mapId: "DEMO_MAP_ID",
        }
	);

	if (TPtreffpunkt) {
		TPmarker = new AdvancedMarkerElement({
			map: TPmap,
			position: TPtreffpunkt,
		});
	}
}
