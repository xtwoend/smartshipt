<template>
    <div class="fleets-list" :class="{'hide': isHide}">
        <div class="card">
            <div class="card-header search">
                <form action="#" method="get" style="width: 300px;">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </span>
                        <input type="text" @focus="isHide=false" @keyup="search" v-model="keyword" class="form-control" placeholder="Search…"
                            aria-label="Search in website">
                    </div>
                </form>
                <div class="card-actions btn-actions">
                    <a href="#" class="btn-action" @click="isHide=!isHide">
                        <svg v-if="! isHide" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="15 6 9 12 15 18"></polyline>
                        </svg>
                        <svg v-if="isHide" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card-table table-responsive">
                <table-lite
                    :is-static-mode="true"
                    :is-loading="isLoading"
                    :columns="columns"
                    :rows="items"
                    :total="totalRecordCount"
                    :page-size="5"
                    :pageOptions="[ { value: 5, text: 5 }, { value: 10, text: 10 }, { value: 25, text: 25 }, { value: 50, text: 50 } ]"
                    @do-search="doSearch"
                    @is-finished="isLoading = false"
                    ></table-lite>
            </div>
        </div>
    </div>
</template>

<script>
import TableLite from 'vue3-table-lite';

var states = {
    at_port: { img: '/icon/blue.png', name: 'At Port' },
    underway: { img: '/icon/green.png', name: 'Underway' },
    lost_connection: { img: '/icon/red.png', name: 'Lost Connection' },
    at_anchorage: { img: '/icon/yellow.png', name: 'At Anchorage' },
    other : { img: '/icon/purple.png', name: 'Other' },
};
export default {
    components: {
        TableLite
    },
    props: {
        fleets: Array
    },
    data() {
        return {
            keyword: '',
            isLoading: false,
            columns: [
                {label: 'Vessel Name', field: 'name'},
                {label: 'Vessel State', field: 'fleet_status', display: function(row){
                    return states[row.fleet_status] ? states[row.fleet_status].name : 'Other';
                }},
                {label: 'Connection', field: 'connected', display: function(row){
                    return row.connected ? `<div class="badge bg-success"></div> Good` : '<div class="badge bg-danger"></div> No Connection';
                }},
                {label: 'Location', field: 'navigation.location', display: function(row){
                    if(row.navigation) {
                        return `${row.navigation.lat.toFixed(4)} ${row.navigation.lat_dir}, ${row.navigation.lng.toFixed(4)} ${row.navigation.lng_dir}`;
                    }
                    return '';
                }},
                {label: 'Course', field: 'navigation.sog', display: row => row.navigation ? row.navigation.cog : 0 },
                {label: 'Speed (kn)', field: 'navigation.sog', display: row =>row.navigation ? row.navigation.sog : 0  },
                {label: 'Origin', field: 'voyage.origin'},
                {label: 'Destination', field: 'voyage.destination'},
                {label: 'ETA', field: 'voyage.eta'},
            ],
            isHide: true
        }
    },
    computed: {
        totalRecordCount() {
            return this.items.length
        },
        items () {
            return this.fleets.filter(fleet => {
                return fleet.name.toLowerCase().includes(this.keyword.toLowerCase())
            })
        }
    },
    methods: {
        doSearch(offset, limit, order, sort) {
            this.isLoading = true;

            this.isLoading = false;
        }
    }
}
</script>

<style lang="scss">
.fleets-list {
    position: absolute;
    z-index: 99;
    bottom: 0;
    left: 0;
    right: 0;
    &.hide {
        bottom: -320px;
    }
    .vtl-table  {
        display: table !important;
        // height: 300px;
    }
}

</style>