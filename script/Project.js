/* Binôme Groupe 3 : Monoy Olivier / Nollet Antoine */

window.addEventListener('DOMContentLoaded', ()=>{

  var listeStation = document.getElementById('liste');
  var Stations = listeStation.getElementsByTagName('div');

  maCarte = L.map('carte_lille');

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: '©️ OpenStreetMap contributors'}).addTo(maCarte);

  let pointsList = [];
  for(i=0;i!=Stations.length;i++) {
	   let geoloc = JSON.parse(Stations[i].dataset.geo);
     let image =  VliveImage.getInstance(Stations[i].dataset.velos,Stations[i].dataset.bornes);
     marker = L.marker( geoloc, {icon:image.getLeafletIcon()} ).addTo(maCarte);
     marker.bindPopup("<center><strong>"+Stations[i].dataset.nom+"</strong></center><center>"+Stations[i].dataset.commune+"</center> <center>Velos : <strong>"+Stations[i].dataset.velos+"</strong></center><center> Places :<strong> "+Stations[i].dataset.bornes+"</strong></center>");
	   pointsList.push(geoloc);
     setupListeners(Stations[i],marker);
  }

  if (pointsList.length>0) maCarte.fitBounds(pointsList);
  else {
    let geoloc = [66.5433,25.8467];
    let marker = L.marker(geoloc).addTo(maCarte);
    marker.bindPopup("<center>La maison du</center><center><strong>Père Noël</strong></center>");
    maCarte.setView(geoloc, 17);
  }

});

function setupListeners(item, marker){
    // item est le noeud DOM d'un élément li (donc une ville de la liste)
    // marker est le marqueur Leaflet créé pour cette même ville
    item.addEventListener('click', ()=>{
      marker.openPopup();
      setCurrent(item);
      maCarte.setView(JSON.parse(item.dataset.geo),20);
    });
    marker.on("click", ()=>{
      setCurrent(item);
      maCarte.setView(JSON.parse(item.dataset.geo),20);
    });
}

{
  let itemCourant = null;

  function setCurrent(item){
      if (itemCourant) {
        itemCourant.style.opacity = "";
        itemCourant = item;
        itemCourant.scrollIntoView();
        itemCourant.style.opacity = "1";
      }
      else {
        itemCourant = item;
        itemCourant.scrollIntoView();
        itemCourant.style.opacity = "1";
      }
      var details = document.getElementById("details");
      details.innerHTML = "<p> Adresse : <strong>"+itemCourant.dataset.adresse+"</strong> <br />  Type : <strong>"+itemCourant.dataset.type+"</strong> (TPE = terminal carte bancaire) </p>";
  }
}
