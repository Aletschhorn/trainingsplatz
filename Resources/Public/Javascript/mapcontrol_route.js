var TPwerkzeug = 1;
var TPdistanzTeil = 0;
var TPdistanzTotal = 0;
var TPdistanzText = '';
var TPshowMeilenstein = 1;
var TPzoom = 1;
var TPcenter = '';
var TPmaptype = '';
var TPpunkte = new Array;
var TPmeilenstein = new Array;
var TPreserviert = new Array;
var TPerrortext = '';
var TPtreffpunkt = '';


function auswaehlen (TPwahl) {
	document.getElementById('tool1').style.backgroundColor='white';
	document.getElementById('tool2').style.backgroundColor='white';
	document.getElementById(TPwahl).style.backgroundColor='#CCCCFF';
	TPwerkzeug = TPwahl;
}

function zeichnen () {
	TPmarker.setMap(null);
	map.clearOverlays();
	if (TPpunkte.length > 0) {
		if (TPshowMeilenstein == 1) {
			var TPmarkerinhalt = '<div style="padding: 0px 0px 8px 8px; background: url(typo3conf/ext/dw_trainingsplatz/pi1/images/point_bottom_left.png) no-repeat bottom left;"><div style="background-color: #6666FF; color: white; padding: 2px;"><b> 0 <\/b><\/div><\/div>';
			// map.addOverlay(new ELabel(TPpunkte[0], TPmarkerinhalt, null, null, 80));
		}
		if (TPpunkte.length > 1) {
			map.addOverlay(new GPolyline(TPpunkte, TPstreckenfarbe, TPstreckenbreite));
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
		TPmarker.setMap(map);
	}
}

function initialize() {
	if (TPpunkte.length == 0) {
		TPdistanzText = '(keine Strecke festgelegt)';
	} else if (TPpunkte.length == 1) {
		TPdistanzText = 'Startpunkt festgelegt';
	} else {
		for (var i=1; i<TPpunkte.length; i++) {
			TPdistanzTeil = TPpunkte[i].distanceFrom(punkte[i-1]);
			var TPdeltaX = (TPpunkte[i].lng() - TPpunkte[i-1].lng()) / TPdistanzTeil;
			var TPdeltaY = (TPpunkte[i].lat() - TPpunkte[i-1].lat()) / TPdistanzTeil;
			var TPaltX = TPpunkte[i-1].lng();
			var TPaltY = TPpunkte[i-1].lat();
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
		TPdistanzText = 'Gesamtstrecke: ' + Math.round(TPdistanzTotal) + ' m<br />letzte Teilstrecke: ' + Math.round(TPdistanzTeil) + ' m';
	}
    var map = new google.maps.Map(
		document.getElementById('Karte'), 
        {
          center: TPcenter,
          zoom: TPzoom,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
		  draggableCursor: 'crosshair',
		  draggingCursor: 'pointer',
		  mapTypeControl: true,
		  fullscreenControl: true
        }
	);
	var TPmarker = new google.maps.Marker({
		position: TPtreffpunkt,
		icon: TPtpicon
    });
	TPgeocoder = new google.maps.Geocoder();
	document.getElementById("distanz").innerHTML = TPdistanzText;
	zeichnen();

	google.maps.event.addListener(map, "click", 
		function (TPmarker, TPpoint) {
			if (TPwerkzeug == "tool2") {
				if (TPpoint) {
					TPpunkte.push(point);
					if (TPpunkte.length == 1) {
						TPdistanzText = 'Startpunkt festgelegt';
					}
					if (TPpunkte.length > 1) {
						TPdistanzTeil = TPpunkte[TPpunkte.length-1].distanceFrom(TPpunkte[TPpunkte.length-2]);
						if (TPdistanzTeil > 10000) {
							alert(errorMsgTooLong);
							TPpunkte.pop();
							return;
						}
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
						TPdistanzText = 'Gesamtstrecke: ' + Math.round(TPdistanzTotal) + ' m<br />letzte Teilstrecke: ' + Math.round(TPdistanzTeil) + ' m';
					}
					zeichnen();
					// map.panTo(point);
					document.getElementById("distanz").innerHTML = TPdistanzText;
					// document.getElementById("mypoint").innerHTML = liste;
				}
			}
		}
	);
}

function initialize_show() {
	if (punkte.length > 1) {
		for (var i=1; i<punkte.length; i++) {
			distanzTeil = punkte[i].distanceFrom(punkte[i-1]);
			var deltaX = (punkte[i].lng() - punkte[i-1].lng()) / distanzTeil;
			var deltaY = (punkte[i].lat() - punkte[i-1].lat()) / distanzTeil;
			var altX = punkte[i-1].lng();
			var altY = punkte[i-1].lat();
			var altDistanz = distanzTotal;
			distanzTotal = distanzTotal + distanzTeil;
			while (Math.ceil((altDistanz+0.01)/1000) <= distanzTotal/1000) {
				var bisMeilenstein = 1000 - altDistanz % 1000;
				altX = altX + bisMeilenstein * deltaX;
				altY = altY + bisMeilenstein * deltaY;
				meilenstein.push(new GLatLng(altY, altX));
				altDistanz += bisMeilenstein;
			}
		}
	}
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("Karte"), {draggableCursor: 'crosshair', draggingCursor: 'pointer'});
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		map.addMapType(G_PHYSICAL_MAP);
		map.setCenter(center, zoom, maptype);
        geocoder = new GClientGeocoder();
		zeichnen();
	}
}


function showAddress(address) {
  if (geocoder) {
	geocoder.getLatLng(
	  address,
	  function(point) {
		if (!point) {
		  alert(address + " not found");
		} else {
		  map.setCenter(point, 13);
		  var marker = new GMarker(point);
		  map.addOverlay(marker);
		}
	  }
	);
  }
}

function MeilensteinEinAus () {
	if (showMeilenstein == 1) {
		showMeilenstein = 0;
	} else {
		showMeilenstein = 1;
	}
	zeichnen();
}

function loescheTeil () {
	if (punkte.length > 0) {
		if (punkte.length > 2) {
			distanzTeilAlt = punkte[punkte.length-1].distanceFrom(punkte[punkte.length-2]);
			distanzTotal = distanzTotal - distanzTeilAlt;
			punkte.pop();
			distanzTeil = punkte[punkte.length-1].distanceFrom(punkte[punkte.length-2]);
			distanzText = 'Gesamtstrecke: ' + Math.round(distanzTotal) + ' m<br />Letzte Teilstrecke: ' + Math.round(distanzTeil) + ' m';
		} else {
			punkte.pop();
			distanzTotal = 0;
			distanzTeil = 0;
			if (punkte.length == 0) {
				distanzText = '(keine Strecke definiert)';
			} else {
				distanzText = 'Startpunkt festgelegt';
			}		
		}
		while (meilenstein.length > distanzTotal / 1000) {
			meilenstein.pop();
		}
		document.getElementById("distanz").innerHTML = distanzText;
		zeichnen();
	}
}

function loescheAlles () {
	punkte = Array ();
	meilenstein = Array ();
	distanzTotal = 0;
	distanzTeil = 0;
	distanzText = '(weder Startpunkt noch Strecke definiert)';
	document.getElementById("distanz").innerHTML = distanzText;
	map.clearOverlays();
}	

