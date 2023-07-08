<template>
    <div class="modal modal-blur fade" :class="{'show': show}" :style="{'display': show ? 'block': 'none'}" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="show=false"></button>
                </div>
                <div class="modal-body">
                    <template v-for="(field, i) in fields" :key="i">
                        <div v-if="field.editType == 'select'" class="mb-2">
                            <label class="form-label">{{ field.name }}</label>
                            <select v-model="data[field.field]" class="form-select">
                                <option :value="option" v-for="(option, inx) in field.options" :key="inx">{{ option }}</option>
                            </select>
                        </div>
                        <div v-else class="mb-2">
                            <label class="form-label">{{ field.name }}</label>
                            <input type="text" class="form-control" v-model="data[field.field]"/>
                        </div>
                    </template>
                </div>
                <div class="modal-footer">
                    <button @click="show=false" type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button @click="save" type="button" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        url: String,
        fields: Array,
        show: Boolean,
        fleet: Object
    },
    data () {
        return {
            data: {}
        }
    },
    mounted () {
        this.fields.forEach(row => {
            this.data[row.field] = null
        })
        if(this.fleet){
            this.data.fleet_id = this.fleet.fleetId,
            this.data.group = this.fleet.group
        }
    },
    methods: {
        async save () {
            let res = await axios.post(this.url, this.data).then(res => res.data)
            if(! res.error) {
                this.$emit('saved', res)
            }else{
                this.$emit('saved', false);
            }
        }
    }
}
</script>

<style lang="scss" scoped></style>