<template>
    <div>
        <div class="form-group mb-3">
            <label>Fleets Access</label>
            <div class="checkbox" v-for="r in fleets">
                <label class="ui-check">
                    <input type="checkbox" :value="r.id" v-model="checked"><i class="dark-white"></i> {{ r.name }}
                </label>
            </div>
        </div>
        <div class="float-end">
            <a class="btn btn-primary" @click="assignTo">Assign to Fleet</a>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UserFleets',
    props: {
        url: String,
    },
    data () {
        return {
            fleets: [],
            checked: [],
            user_id: null
        }
    },
    mounted () {
        this.loadFleet();
        this.loadData();
    },  
    methods: {
        async loadData() {
            let { data } = await axios.get(this.url);
            this.user_id = data.data.id
            this.checked = data.data.fleets
        },
        async loadFleet() {
            let {data} = await axios.get('/master/fleets/data/json');
            this.fleets = data;
        },
        async assignTo() {
            if(this.user_id){
                let {data} = await axios.post(`/master/user/${this.user_id}/update-fleet-access`, { fleet: this.checked });
                if(data.success) {
                    alert('Success saved');
                }
                // window.$vmapp.$refs.vuetable.getData();
            }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
