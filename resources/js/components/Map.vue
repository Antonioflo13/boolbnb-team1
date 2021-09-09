<template>
    <div id="container">
        <div id="mapContainer"></div>
    </div> 
</template>

<script>
import "leaflet/dist/leaflet.css";
import L from "leaflet";

export default {
    name: "Map",
    props: ['appartmentLoc'],
    data() {
        return{
            center: [Number(this.appartmentLoc.latitude), Number(this.appartmentLoc.longitude)],
        }
    },
    methods: {
        setupLeafletMap: function () {
            const mapDiv = L.map("mapContainer").setView(this.center, 13);
            L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}',
                {
                    // attribution:
                    // 'Map data (c) <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery (c) <a href="https://www.mapbox.com/">Mapbox</a>',
                    maxZoom: 18,
                    id: "mapbox/streets-v11",
                    accessToken:'pk.eyJ1IjoibWFyaWFkdWxlc292YSIsImEiOiJja3RkMnFlazAyNTdmMnVwY3NlbGo2YnljIn0.1qKfuYdbIQcK-mzjDq57Zw',
                }
            ).addTo(mapDiv);
            var bnbIcon = L.icon({
                iconUrl: '/images/location.svg',
                iconSize:     [40, 40], // size of the icon
                //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            });
            L.marker([Number(this.appartmentLoc.latitude), Number(this.appartmentLoc.longitude)], {icon: bnbIcon}).addTo(mapDiv);
            // L.circle([Number(this.appartmentLoc.latitude), Number(this.appartmentLoc.longitude)], {
            //     color: '#FD395C',
            //     fillColor: '#FD395C',
            //     fillOpacity: 0.8,
            //     radius: 150
            // }).addTo(mapDiv);
            
            
        },
    },
    mounted() {
        this.setupLeafletMap();
    }
}
</script>

<style scoped lang="scss">
    #mapContainer {
        width: 100%;
        height: 200px;
        border-radius: 10px 10px 0px 0px;
    }
    @media all and (min-width: 992px){
    #mapContainer {
            height: 407.156px;
        }
    }
    @media all and (min-width: 1200px){
    #mapContainer {
            height: 480px;
        }
    }
</style>