<template>
    <div class="voyage-section">
        <div class="card voyage-card" v-if="display">
            <div class="card-header justify-content-between">
                <button @click="$emit('close', true)" class="btn btn-link bg-transparent p-0">
                    <img :src="'/img/icons/close-fill.png'" alt="" />
                </button>
                <h5 class="fw-normal m-0">Fleet Information</h5>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link justify-content-center active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">INFO</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link justify-content-center" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">TRACK</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="m12">
                            <div class="st21">Name</div>
                            <div class="st22">
                                <a :href="`/fleet/${fleet.id}`" class="d-flex align-items-center">{{ fleet.name }} <img width="11" height="11" src="/img/icons/external-link.png" style="margin-left: 6px;"></a>
                            </div>
                        </div>
                        <div class="m12">
                            <div class="st21">Imo Number</div>
                            <div class="st22">{{ fleet.imo_number }}</div>
                        </div>
                        <div class="m12">
                            <div class="st21">Last Update</div>
                            <div class="st22">{{ $filters.dateformat(fleet.last_connection) }} WIB</div>
                        </div>
                        <div class="m12">
                            <div class="st21">From</div>
                            <div class="st22"></div>
                        </div>
                        <div class="m12">
                            <div class="st21">Destination</div>
                            <div class="st22"></div>
                        </div>
                        <div class="m12">
                            <div class="st21">ETA</div>
                            <div class="st22"></div>
                        </div>
                        <div class="tt01">Engine Latest Status</div>
                        <div class="m13">
                            <div class="st21">
                                Fuel Oil Temp <span>189&deg;</span>
                            </div>
                            <div class="st22">
                                <div class="progress">
                                    <div class="progress-bar" :style="{width: '89%'}" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m13">
                            <div class="st21">
                                Exhaust Gas Turbo Charge inlet <span>1139 mt/12^2</span>
                            </div>
                            <div class="st22">
                                <div class="progress">
                                    <div class="progress-bar" :style="{width: '50%'}" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m13">
                            <div class="st21">
                                Jacket Cooling Temp <span>130&deg;</span>
                            </div>
                            <div class="st22">
                                <div class="progress">
                                    <div class="progress-bar" :style="{width: '12%'}" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m13">
                            <div class="st21">
                                Lube Oil temp <span>112&deg;</span>
                            </div>
                            <div class="st22">
                                <div class="progress">
                                    <div class="progress-bar" :style="{width: '24%'}" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m13">
                            <div class="st21">
                                Lube Pressure <span>74 bar</span>
                            </div>
                            <div class="st22">
                                <div class="progress">
                                    <div class="progress-bar" :style="{width: '70%'}" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m13">
                            <div class="st21">
                                Scaving Air Temp<span>130&deg;</span>
                            </div>
                            <div class="st22">
                                <div class="progress">
                                    <div class="progress-bar" :style="{width: '50%'}" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="m13">
                            <div class="st21">
                                Scaving Air Pressure<span>74 bar</span>
                            </div>
                            <div class="st22">
                                <div class="progress">
                                    <div class="progress-bar" :style="{width: '50%'}" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="mb-4">
                            <div class="form-group mb-3">
                                <label for="startDateInput">Start Date</label>
                                <input type="date" v-model="params.from" class="form-control" id="startDateInput">
                            </div>
                            <div class="form-group mb-3">
                                <label for="endDateInput">End Date</label>
                                <input type="date" v-model="params.to" class="form-control" id="endDateInput">
                            </div>
                            <button @click="fetchData" class="btn btn-outline-primary w-100">SHOW</button>
                        </div>
                        <h6 class="text-primary">GENERATE REPORT</h6>
                        <table class="table text-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Time</th>
                                    <th scope="col">Lon</th>
                                    <th scope="col">Lat</th>
                                    <th scope="col">Speed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr @click="selected(row)" v-for="row in histories" :key="row.id">
                                    <td scope="row">{{ $filters.dateformat(row.terminal_time, 'DD/MM/YY HH:mm') }}</td>
                                    <td>{{ row.lng.toFixed(2) }}°</td>
                                    <td>{{ row.lat.toFixed(2) }}°</td>
                                    <td>{{ row.sog }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        fleet: Object,
        display: Boolean
    },
    data() {
        return {
            params: {
                from: null,
                to: null,
                interval: 900
            },
            histories: []
        }
    },
    methods: {
        async fetchData() {
            this.histories = []
            let res = await axios.get(`/api/fleet/${this.fleet.id}/nav/histories`, { params: this.params }).then(res => res.data)
            res.forEach(row => {
                if (row.lat == 0 && row.lng == 0) return;
                this.histories.push(row)
            })

            this.$emit('history', this.histories)
        },
        toggleText() {
            this.display = !this.display;
        },
        selected(e) {
            this.$emit('selected', e)
        }
    },
}
</script>

<style lang="scss">
.voyage-section {
    position: absolute;
    top: 0%;
    right: 0;
    z-index: 3;
    height: 100%;

    tr {
        &:hover {
            background: #f5f5f5;
        }
    }
}

.btn-open {
    right: 30px;
    top: 30px;
    position: absolute;
    color: #205295;
    display: flex;
    align-items: center;
    gap: 1em;
}

.voyage-card {
    background: #fff;
    width: 320px;
    height: 100% !important;
    z-index: 3;
    border: 0 !important;
    border-radius: 0 !important;

    .card-header {
        background: #2C74B3;
        color: #fff;
        border-radius: 0 !important;
    }

    .card-body {
        border-radius: 0 !important;
        padding: 1em;
        overflow-y: auto;
    }
}

.nav-pills {
    .nav-link.active {
        background-color: #fff !important;
        border-radius: 0;
        -webkit-box-shadow: 0px 2px 0px 0px rgba(44, 116, 179, 1);
        -moz-box-shadow: 0px 2px 0px 0px rgba(44, 116, 179, 1);
        box-shadow: 0px 2px 0px 0px rgba(44, 116, 179, 1);
    }
}

.tabel.text-sm {
    td {
        font-size: 12px !important;
    }
}

.m12 {
    display: flex;
    font-size: 12px;
    border-bottom: 1px solid #ddd;
    padding: 8px 12px;

    .st21 {
        width: 40%;
    }

    .st22 {
        font-weight: bold;
    }
}

.tt01 {
    padding: 6px 12px;
    background: #2C74B3;
    color: #fff;
    margin-bottom: 15px;
}
.m13 {
    font-size: 12px;
    margin-bottom: 15px;
    .st21 {
        display: flex;
        justify-content: space-between;
        span {
            font-weight: bold;
        }
    }
}
</style>