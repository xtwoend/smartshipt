<template>
<div class="ships-list position-absolute" ref="cSearch">
    <div class="card" style="height: 100%">
        <div class="card-header search">
            <form action="#" method="get" style="width: 100%;">
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                    </span>
                    <input type="text" @keyup="search" v-model="keyword" class="form-control" placeholder="Search…" aria-label="Search in website">
                </div>
            </form>
            <div class="card-actions btn-actions">
                <a href="#" class="btn-action" @click="searchExpand">
                    <svg v-if="! isExpand" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="15 6 9 12 15 18"></polyline>
                    </svg>
                    <svg v-if="isExpand" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
            </div>
        </div>
        <div class="card-body card-body-scrollable card-body-scrollable-shadow search-body" ref="searchBody">
            <div class="divide-y">
                <div v-for="i in 700" :key="i">
                    <div class="row">
                        <div class="col-auto">
                            <span class="avatar" style="background-image: url(./static/avatars/002m.jpg)"></span>
                        </div>
                        <div class="col p-0">
                            <div class="text-truncate">
                                GAS WIDURI
                            </div>
                            <div class="text-muted text-sm">IMO 100002</div>
                        </div>
                        <div class="col-auto">
                            <div class="badge bg-success"></div><span class="text-xs ml-1">Online</span>
                        </div>
                    </div>
                    <!-- <div class="row mt-2">
                        <div class="col-auto">
                            <div class="text-muted text-sm">ID MRK</div>
                            <div class="text-xs">ATD 27/12</div>
                        </div>
                        <div class="col"></div>
                        <div class="col-auto">
                            <div class="text-muted text-sm">ID JKT</div>
                            <div class="text-xs">ETA 27/12</div>
                        </div>
                    </div> -->
                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="progress mt-2">
                                <div class="progress-bar arrow-right bg-green" style="width: 38%" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" aria-label="38% Complete">
                                    <span class="visually-hidden">38% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>

export default {
    data () {
        return {
            isExpand: false,
            keyword: null
        }
    },
    methods: {
        searchExpand () {
            this.isExpand = ! this.isExpand

            let el = this.$refs.searchBody
            if(this.isExpand) {
                el.style.display = 'block';
                this.$refs.cSearch.style.bottom = '40px';            
            }else {
                el.style.display = 'none';
                this.$refs.cSearch.style.bottom = 'unset'; 
            }
        },
        search() {
            if(this.keyword.length > 3 && ! this.isExpand) {
                this.searchExpand()
            }
            if(this.keyword.length == 0 && this.isExpand) {
                this.searchExpand()
            }
        }
    }
}
</script>

<style lang="scss">
.ships-list {
    width: 300px;
    top: 15px;
    left: 15px;
    transition: 0.3s;
    z-index: 1;
    .card {
        background: rgba(255, 255, 255, 0.8) !important;
        .search-body {
            display: none;
            padding: 10px;
        }
    }
}
.card-header.search {
    padding: 10px;
    .card-actions {
        margin: 0px 0px 0px auto;
        padding-left: 0.5rem;
    }
}
</style>