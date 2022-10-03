var TPshowMeilenstein = 0;
var TPdrawTreffpunkt = 0;
var TPcenter = new google.maps.LatLng (47.3500361,8.7207699);
var TPzoom = 12;
var TPtreffpunkt = "";
var TPpunkte = new Array();
var TPmeilenstein = new Array();
var TPdistanzTotal = 0;
var TPdistanzTeil = 0;
// var TPkartencontrol = new GMapTypeControl();
var TPmarker;
var TPmap;
var TPmilestoneimage = "typo3conf/ext/trainingsplatz/Resources/Public/Icons/point_bottom_left.png";

function initialize() {
    TPmap = new google.maps.Map(
		document.getElementById('Karte'), 
        {
          center: TPcenter,
          zoom: TPzoom,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
		  draggableCursor: 'crosshair',
		  draggingCursor: 'pointer',
		  mapTypeControl: true,
		  fullscreenControl: false
        }
	);
	TPmarker = new google.maps.Marker({
		position: TPtreffpunkt,
		icon: TPtpicon
    });
	TPstrecke =  new google.maps.Polyline({
		strokeColor: TPstreckenfarbe,
		strokeWeight: TPstreckenbreite,
		strokeOpacity: 0.5,
		clickable: false
	});

	TPmap.addListener("click", (mapsMouseEvent) => {
		if (TPdrawTreffpunkt == 1) {
			TPpoint = mapsMouseEvent.latLng;
			if (TPpoint) {
				TPtreffpunkt = TPpoint;
				TPmarker.setPosition(TPtreffpunkt);
				TPmarker.setMap(TPmap);
			}
		}
	});
}

function zeichnen () {
	TPmarker.setMap(null);
	TPstrecke.setMap(null);
	if (TPpunkte.length > 0) {
		if (TPshowMeilenstein == 1) {
			var TPmarkerinhalt = '<div style="padding: 0px 0px 8px 8px; background: url(typo3conf/ext/dw_trainingsplatz/pi1/images/point_bottom_left.png) no-repeat bottom left;"><div style="background-color: #6666FF; color: white; padding: 2px;"><b> 0 <\/b><\/div><\/div>';
			// map.addOverlay(new ELabel(TPpunkte[0], TPmarkerinhalt, null, null, 80));
		}
		if (TPpunkte.length > 1) {
			TPstrecke.setPath(TPpunkte);
			TPstrecke.setMap(TPmap);
			// map.addOverlay(new GPolyline(TPpunkte, TPstreckenfarbe, TPstreckenbreite));
			if (TPshowMeilenstein == 1) {
				for (var i=0; i<TPmeilenstein.length; i++) {
					var TPmarkerinhalt = '<div style="padding: 0px 0px 8px 8px; background: url(typo3conf/ext/dw_trainingsplatz/pi1/images/point_bottom_left.png) no-repeat bottom left;"><div style="background-color: #6666FF; color: white; padding: 2px;"><b> '+ (i+1).toString() +' <\/b><\/div><\/div>';
					// var TPlabel = new ELabel(TPmeilenstein[i], TPmarkerinhalt, null, null, 80);
					// map.addOverlay(TPlabel);
				}
			}
		}
	}
	if (TPtreffpunkt) {
		TPmarker.setPosition(TPtreffpunkt);
		TPmarker.setMap(TPmap);
	}
}

function milestone () {
	if (TPpunkte.length > 1) {
		TPdistanzTotal = 0;
		TPdistanzTeil = 0;
		for (var i=1; i<TPpunkte.length; i++) {
			TPdistanzTeil = TPpunkte[i].distanceFrom(TPpunkte[i-1]);
			var TPdeltaX = (TPpunkte[TPpunkte.TPlength-1].lng() - TPpunkte[TPpunkte.length-2].lng()) / TPdistanzTeil;
			var TPdeltaY = (TPpunkte[TPpunkte.length-1].lat() - TPpunkte[TPpunkte.length-2].lat()) / TPdistanzTeil;
			var TPaltX = TPpunkte[TPpunkte.length-2].lng();
			var TPaltY = TPpunkte[TPpunkte.length-2].lat();
			var TPaltDistanz = TPdistanzTotal;
			TPdistanzTotal = TPdistanzTotal + TPdistanzTeil;
			while (Math.ceil((TPaltDistanz+0.01)/1000) <= TPdistanzTotal/1000) {
				var TPbisMeilenstein = 1000 - TPaltDistanz % 1000;
				TPaltX = TPaltX + TPbisMeilenstein * TPdeltaX;
				TPaltY = TPaltY + TPbisMeilenstein * TPdeltaY;
				TPmeilenstein.push(new google.maps.LatLng(TPaltY, TPaltX));
				TPaltDistanz += TPbisMeilenstein;
			}
		}
	}
}

function Go (where) {
	document.forms["new"].elements["tx_dwtrainingsplatz_pi2[map_center]"].value = TPmap.getCenter();
	document.forms["new"].elements["tx_dwtrainingsplatz_pi2[map_zoom]"].value = TPmap.getZoom();
	document.forms["new"].elements["tx_dwtrainingsplatz_pi2[map_meeting]"].value = TPtreffpunkt;
	document.forms["new"].elements["tx_dwtrainingsplatz_pi2[newGo]"].value = where;
	document.forms["new"].submit();
}
