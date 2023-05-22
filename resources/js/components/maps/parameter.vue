<template>
    <div class="ships-parameter" ref="cSearch">
        <div class="card" style="height: 100%">
            <div class="card-header search">
                <h4 class="card-title">
                    KEY PARAMETER
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
                    <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link justify-content-center active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">DAILY AVG</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link justify-content-center" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">PRESENT VALUES</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div v-for="param in parameter" :key="param.id" class="py-2 border-bottom border-white">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="fw-bold">{{ param.title }}</div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h2 class="fw-normal">{{ param.value }}</h2>
                                        <div class="text-sm">{{ param.format }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2 border-bottom border-white">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="">NOTE: Daily average is calculated at 12 PM UTC</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            ...
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
                parameter: [
                    {
                        id: 1,
                        title: 'SPEED THROUGH WATER',
                        value: '13.8',
                        format: 'KNOTS'
                    },
                    {
                        id: 2,
                        title: 'SPEED OVER GROUND',
                        value: '14.9',
                        format: 'KNOTS'
                    },
                    {
                        id: 3,
                        title: 'ME SHAFT POWER',
                        value: '4852',
                        format: 'KW'
                    },
                    {
                        id: 4,
                        title: 'ME RPM',
                        value: '95',
                        format: 'RPM'
                    },
                    {
                        id: 5,
                        title: 'ME FO',
                        value: '26.5',
                        format: 'FO'
                    },
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
    .ships-parameter {
        width: 300px;
        top: 320px;
        right: 10px;
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
    .nav-justified > .nav-link, .nav-justified .nav-item{
        white-space: nowrap;
    }
    .nav-pills .nav-link{
        color: #fff;
        -webkit-box-shadow: 0px 2px 0px 0px rgb(255, 255, 255);
        -moz-box-shadow: 0px 2px 0px 0px rgb(255, 255, 255);
        box-shadow: 0px 2px 0px 0px rgb(255, 255, 255);
        border-radius: 0;
    }
    .nav-pills .nav-link.active{
        background-color: #555!important;
        -webkit-box-shadow: 0px 2px 0px 0px rgb(255, 255, 255);
        -moz-box-shadow: 0px 2px 0px 0px rgb(255, 255, 255);
        box-shadow: 0px 2px 0px 0px rgb(255, 255, 255);
    }
    </style>