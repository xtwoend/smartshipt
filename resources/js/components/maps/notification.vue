<template>
<div class="ships-notification position-absolute" ref="cSearch">
    <div class="dark card" style="height: 100%">
        <div class="card-header search">
            <h4 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                Notifications
            </h4>
            <div class="card-actions btn-actions">
                <a href="#" class="btn-action" @click="notifExpand">
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
        <div class="card-body card-body-scrollable card-body-scrollable-shadow notif-body" ref="notifBody">
            <div class="divide-y">
                <div v-for="i in 12">
                    <div class="row">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-broadcast-tower" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="1"></circle>
                                <path d="M16.616 13.924a5 5 0 1 0 -9.23 .004"></path>
                                <path d="M20.307 15.469a9 9 0 1 0 -16.615 0"></path>
                                <path d="M9 21l3 -9l3 9"></path>
                                <path d="M10 19h4"></path>
                            </svg>
                        </div>
                        <div class="col">
                            Lorem ipsum dolor sit amet conse, adipisicing elit.
                            <div class="text-muted text-sm">22/07/2022 08:00</div>
                        </div>
                    </div>
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
            isExpand: true
        }
    },
    methods: {
        notifExpand () {
            this.isExpand = ! this.isExpand

            let el = this.$refs.notifBody
            if(this.isExpand) {
                el.style.display = 'block';
                this.$refs.cSearch.style.bottom = '150px';            
            }else {
                el.style.display = 'none';
                this.$refs.cSearch.style.bottom = 'unset'; 
            }
        }
    }
}
</script>

<style lang="scss" scoped>
.ships-notification {
    width: 300px;
    top: 15%;
    left: 10px;
    bottom: 15%;
    transition: 0.3s;
    z-index: 1;
    // .card {
    //     background: rgba(255, 255, 255, 0.8) !important;
    //     .notif-body {
    //         display: block;
    //         padding: 10px;
    //     }
    // }
}
</style>