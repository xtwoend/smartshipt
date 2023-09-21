<template>
    <div class="lengend">
        <div class="card">
            <div class="card-header">
                <div class="title">Fleet Color Information</div>
            </div>
            <div class="card-body row">
                <div class="col">
                    
                </div>
                <div class="col">
                    <div><img src="../icon/green.png"> Underway </div>
                    <div><img src="../icon/blue.png"> At Port </div>
                    <div><img src="../icon/yellow.png"> At Anchorage</div>
                    <div><img src="../icon/purple.png"> Other</div>
                    <div><img src="../icon/red.png"> Lost Connection</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';

export default {
    props: {
        fleets: Array
    },
    data () {
        return {
            fleetsGroup: []
        }
    },
    watch: {
        fleets: function(n, o) {
            this.fleetsGroup = _.groupBy(n, ({ fleet_status }) => fleet_status);
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
}
</style>