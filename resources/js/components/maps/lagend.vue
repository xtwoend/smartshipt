<template>
    <div class="lengend">
        <div class="card">
            <div class="card-header">
                <div class="title">Fleet Color Information</div>
            </div>
            <div class="card-body row">
                <div class="col">
                    <vc-donut v-if="fleets" :size="100" :sections="fleetsGroup" unit="%" :total="fleets.length" :auto-adjust-text-size="true">
                        <div class="fleet-count">{{ fleets.length }}</div>
                        Vessels
                    </vc-donut>
                </div>
                <div class="col">
                    <div v-for="f in fleetsGroup" :key="f.label"><img :src="f.img"> {{ f.name }} ({{ f.value  }}) </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';

export default {
    components: {
        // 
    },
    props: {
        fleets: Array
    },
    data () {
        return {
            fleetsGroup: [],
            colors: {
                at_port: '#004BFF',
                underway: '#56B745',
                lost_connection: '#E13711',
                at_anchorage: '#F1D244',
                other : '#A32B7C'
            },
            icons:  {
                at_port: {  name: 'At Port', img: '/icon/blue.png' },
                underway: { img: '/icon/green.png', name: 'Underway' },
                lost_connection: { img: '/icon/red.png', name: 'Lost Connection' },
                at_anchorage: { img: '/icon/yellow.png', name: 'At Anchorage' },
                other : { img: '/icon/purple.png', name: 'Other' },
            }
        }
    },
    watch: {
        fleets: function(n, o) {
            let groups = _.groupBy(n, ({ fleet_status }) => fleet_status);
            this.fleetsGroup = [];
            let that = this
            Object.keys(this.colors).forEach(function(key){
                let value = typeof groups[key] == 'undefined' ?  0 : groups[key].length;
                that.fleetsGroup.push({
                    value: value,
                    color: that.colors[key],
                    label: key,
                    name: that.icons[key].name,
                    img: that.icons[key].img,
                })
            }) 
        }
    },
    methods: {
        
    }
}
</script>

<style lang="scss" scoped>

.lengend {
    position: absolute;
    right: 20px;
    top: 10px;
    width: 350px;
    z-index: 2;
    .card {
        background: rgba(255, 255, 255, 0.7) !important;
    }
    .title {
        font-weight: bold;
    }
    img {
        height: 20px;
        margin-right: 10px;
    }
    .fleet-count {
        font-size: 18px;
        font-weight: bold;
    }
}
</style>