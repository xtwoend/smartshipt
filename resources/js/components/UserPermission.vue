<template>
    <div>
        <div class="form-group mb-3">
            <label>Permissions</label>
            <div class="checkbox" v-for="r in permissions">
                <label class="ui-check">
                    <input type="checkbox" :value="r.name" v-model="checked"><i class="dark-white"></i> {{ r.name }}
                </label>
            </div>
        </div>
        <div class="float-end">
            <button class="btn btn-primary" @click="assignTo">Assign Permissions</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UserPermission',
    props: {
        url: String,
    },
    data () {
        return {
            permissions: [],
            checked: [],
            user_id: null
        }
    },
    mounted () {
        this.loadRole();
        this.loadData();
    },
    methods: {
        async loadData() {
            let { data } = await axios.get(this.url);
            this.user_id = data.data.id
            this.checked = data.data.permissions
        },
        async loadRole() {
            let {data} = await axios.get('/master/permission/json');
            this.permissions = data.data;
        },
        async assignTo() {
            if(this.user_id){
                let {data} = await axios.post(`/master/user/${this.user_id}/update-permission`, { permission: this.checked });
                window.$vmapp.$refs.vuetable.getData();
            }
        }
    }
}
</script>

<style lang="css" scoped>
</style>
