// Fonction JavaScript permettant d'afficher la carte Google Maps sur la fiche restaurant
// Si l'API de Google ne fonctionne pas, Chrome met la carte overflow:hidden
!function(n){
    function e(e){var t=e.find(".marker"), r={zoom:16,center:new google.maps.LatLng(0,0), mapTypeId:google.maps.MapTypeId.ROADMAP}, 
    g=new google.maps.Map(e[0],r);
    return g.markers=[], t.each(function() {a(n(this), g)}), o(g), g}


function a(n,e){
    var a=new google.maps.LatLng(n.attr("data-lat"), n.attr("data_lng")), 
    o=new google.maps.Marker({position:a,map:e}); if(e.markers.push(o),
    n.html()) {var t=new google.maps.InfoWindow({content:n.html()});
    google.maps.event.addListener(o, "click", function(){t.open(e,o)})}
}

function o(e)
    {var a=new google.maps.LatLngBounds;n.each(e.markers,function(n,e){
    var o=new google.maps.LatLng(e.position.lat(),e.position.lng()); 
    a.extend(o)}), 1==e.markers.length?(e.setCenter(a.getCenter()),e.setZoom(16)):e.fitBounds(a)} 
    var t=null; n(document).ready(function(){n(".acf-map").each(function(){t=e(n(this))})})
}(jQuery);