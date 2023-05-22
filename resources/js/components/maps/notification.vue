<template>
<div class="ships-notification" ref="cSearch">
    <div class="card" style="height: 100%">
        <div class="card-header search">
            <h4 class="card-title">
                Active Notifications
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
                <div class="notif-status">
                    <div class="status-item">
                        <div class="status-icon">
                            <img src="img/icons/alarm.png" alt="" width="20" />
                            <span class="fw-bold h6">2</span>
                        </div>
                        <div>Alarm</div>
                    </div>
                    <div class="status-item">
                        <div class="status-icon">
                            <img src="img/icons/volume.png" alt="" width="20" />
                            <span class="fw-bold h6">4</span>
                        </div>
                        <div>Warning</div>
                    </div>
                    <div class="status-item">
                        <div class="status-icon">
                            <img src="img/icons/caution.png" alt="" width="20" />
                            <span class="fw-bold h6">2</span>
                        </div>
                        <div>Caution</div>
                    </div>
                    <div class="status-item">
                        <div class="status-icon">
                            <img src="img/icons/info-blue.png" alt="" width="20" />
                            <span class="fw-bold h6">2</span>
                        </div>
                        <div>Info</div>
                    </div>
                </div>
                <div v-for="notif in notifications" :key="notif.id" class="py-2 border-bottom border-white">
                    <div class="row">
                        <div class="col-auto">
                            <img src="img/icons/caution.png" alt="" width="20" />
                        </div>
                        <div class="col">
                            <div class="fw-bold">{{ notif.title }}</div>
                            {{ notif.desc }}
                            <div class="text-sm">{{ notif.date }}</div>
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
            isExpand: true,
            notifications: [
                {
                    id: 1,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                },
                {
                    id: 2,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                },
                {
                    id: 3,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                },
                {
                    id: 4,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                },
                {
                    id: 5,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                },
                {
                    id: 6,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                },{
                    id: 7,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                },
                {
                    id: 8,
                    title: 'SPEED THROUGH WATER',
                    date: '2022-11-19',
                    desc: 'Vessel observed to be in idle condition'
                }
            ],
            params: {}
        }
    },
    mounted() {
        this.fetchData()
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
        },
        async fetchData() {
            this.notifications = await axios.get('/api/notifications', {params: this.params}).then(res => res.data)
        }
    }
}
</script>

<style lang="scss" scoped>
.ships-notification {
    width: 300px;
    top: 320px;
    left: 10px;
    bottom: 16%;
    transition: 0.3s;
    z-index: 3;
    position: absolute;
    .card {
        background: rgb(0 0 0 / 70%) !important;
        border: none;
        border-radius: 16px;
        .notif-body {
            display: block;
            padding: 10px;
        }
        .card-header{
            color: #FDD751;
            border: none;

            .card-title{
                text-transform: uppercase;
            }
        }
        .btn-action{
            .icon{
                stroke-width: 2;
                stroke: white;
            }
        }
        .card-body{
            color: #fff;
            max-height: calc(100vh - 450px);
            overflow-y: auto;
        }
    }
    .notif-status{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1em;
        .status-item{
            text-align: center;
            .status-icon{
                display: flex;
                align-items: center;
                justify-content: center;
                gap: .5em;
                .h6{
                    margin: 0;
                }
            }
        }
    }
}
</style>