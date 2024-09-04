document.addEventListener("DOMContentLoaded", function() {
    mapboxgl.accessToken =
        'pk.eyJ1IjoibGhheW5pZSIsImEiOiJjbGQzbG80b3cwams3M3BqcjJ1YjZjZTVhIn0.OhMTetZePiPzigNNL-yhyQ';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/lhaynie/cleopgxcc000f01mq65j5rfiw',
        center: [longitude, latitude],
        zoom: 17
    });

    var el = document.createElement('div');
    el.style.width = '30px';
    el.style.height = '30px';
    el.style.backgroundColor = 'red';
    el.style.borderRadius = '50%';
    el.style.border = '2px solid white';

    new mapboxgl.Marker(el)
        .setLngLat([longitude, latitude])
        .addTo(map);
});