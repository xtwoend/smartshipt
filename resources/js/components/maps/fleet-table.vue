<template>
    <div class="fleets-list">
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
                        <input type="text" @keyup="search" v-model="keyword" class="form-control" placeholder="Search…"
                            aria-label="Search in website">
                    </div>
                </form>
            </div>
            <div class="card-table table-responsive">
                <EasyDataTable 
                    search-field="q"
                    :search-value="keyword" 
                    buttons-pagination 
                    :headers="headers" 
                    :items="fleets" />
            </div>
        </div>
    </div>
</template>

<script>
import 'vue3-easy-data-table/dist/style.css';
export default {
    props: {
        fleets: Array
    },
    data() {
        return {
            keyword: null,
            headers: [
                {text: 'Vessel Name', value: 'name'},
                {text: 'Vessel State', value: 'fleet_status'},
                {text: 'Connection', value: 'connected'},
                {text: 'Course', value: 'navigation.cog'},
                {text: 'Speed (kn)', value: 'navigation.sog'},
                {text: 'Origin', value: 'voyage.origin'},
                {text: 'Destination', value: 'voyage.destination'},
                {text: 'ETA', value: 'voyage.eta'},
            ],
            items: []
        }
    }
}
</script>

<style lang="scss" scoped>
.fleets-list {
    position: absolute;
    z-index: 99;
    bottom: 0;
    left: 0;
    right: 0;
}</style>