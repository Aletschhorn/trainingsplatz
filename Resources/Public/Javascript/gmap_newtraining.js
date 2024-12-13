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
	TPmarker = new AdvancedMarkerElement({
		map: TPmap,
    });

	TPmap.addListener("click", (mapsMouseEvent) => {
		if (TPdrawTreffpunkt == 1) {
			TPpoint = mapsMouseEvent.latLng;
			if (TPpoint) {
				TPtreffpunkt = TPpoint;
				TPmarker.position = TPtreffpunkt;
			}
		}
	});

	changeMeetingPoint();
}

function changeMeetingPoint () {
	switch (document.forms['training'].elements['tx_trainingsplatz_traininglist[training][startOption]'].value) {
		case "0":
			TPtreffpunkt = "";
			TPdrawTreffpunkt = 0;
			TPmarker.map = null;
			break;
		case "1":
			TPdrawTreffpunkt = 1;
			TPmarker.map = TPmap;
			if (TPtreffpunkt) {
				TPmarker.position = TPtreffpunkt;
			}
			break;
	}
}

function saveMapData () {
	document.forms['training'].elements['tx_trainingsplatz_traininglist[training][startCoordinates]'].value = TPtreffpunkt;
	document.forms['training'].elements['tx_trainingsplatz_traininglist[training][mapZoom]'].value = TPmap.getZoom();
	document.forms['training'].elements['tx_trainingsplatz_traininglist[training][mapCenter]'].value = TPmap.getCenter();
	document.forms['training'].elements['tx_trainingsplatz_traininglist[training][mapType]'].value = TPmap.getMapTypeId();
}
