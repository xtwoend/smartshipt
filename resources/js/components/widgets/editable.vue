<template>
    <form-modal :fields="columns" title="Add Data" :url="editUrl" :show="formShow" :fleet="fleet" @saved="saved"></form-modal>
    <form-modal-doc :fields="docColumns" title="Add/Edit Document Alert" :url="docUrl" :show="docShow" :sensor="item" @saved="docShow=false"></form-modal-doc>

    <div class="action-edit" v-if="editable">
        <button type="button" class="btn btn-info" @click="formShow = true">Add Data</button>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th v-for="(header, i) in columns" :key="i">{{ header.name }}</th>
                    <th v-if="editable"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="item.id">
                    <td>{{ 1 + index }}</td>
                    <td v-for="(col, ix) in columns" :key="ix">
                        
                        <template v-if="isFieldSlot(col.field)">
                            <slot :name="col.field"
                            :row-data="item" :row-index="index" :row-field="col"
                            ></slot>
                        </template>
                        
                        <template v-else-if="col.editType == 'select' && item.isEdit">
                            <select v-model="items[index][col.field]" class="form-select">
                                <option :value="sensor" v-for="(sensor, inx) in col.options" :key="inx">{{ sensor }}</option>
                            </select>
                        </template>
                        
                        <template v-else-if="col.editType == 'selectKeyVal' && item.isEdit">
                            <select v-model="items[index][col.field]" class="form-select">
                                <option :value="idx" v-for="(val, idx) in col.options" :key="idx">{{ val }}</option>
                            </select>
                        </template>

                        <template v-else-if="item.isEdit">
                            <input type="text" class="form-control" v-model="items[index][col.field]">
                        </template>
                        <template v-else-if="typeof col.display === 'function'">
                            <span>{{ col.display(item) }}</span>
                        </template>
                        <template v-else>
                            <span v-if="col.isHtml" v-html="item[col.field]"></span>
                            <span v-else>{{ item[col.field] }}</span>
                        </template>
                    </td>
                    <td v-if="editable">
                        <a href="#" @click="editRowHandler(item, index)" v-if="!item.isEdit">Edit</a>
                        <a href="#" @click="saveRowHandler(item, index)" v-if="item.isEdit">Done</a>
                        | <a href="#" @click="del(item, index)">Delete</a>
                        | <a href="#" @click="editDoc(item, index)">Docs</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import FormModalDoc from './form-modal-doc.vue';
import FormModal from './form-modal.vue';
export default {
    components: {FormModal, FormModalDoc},
    props: {
        columns: Array,
        data: Array,
        editUrl: String,
        delUrl: String,
        docUrl: String,
        fleet: Object,
        editable: Boolean
    },
    data () {
        return {
            formShow: false,
            docShow: false,
            items: [],
            docColumns: [
                {
                    name: 'Lower Docs Alert',
                    field: 'low_desc',
                    editType: 'textarea'
                },
                {
                    name: 'higher Docs Alert',
                    field: 'high_desc',
                    editType: 'textarea'
                }
            ],
            item: {}
        }
    },
    mounted() {
        this.data.forEach(item => this.items.push(item))
        this.items = this.items.map(item => ({...item, isEdit: false}));
    },
    methods: {
        saved(res) {
            res.isEdit = false
            this.items.push(res)
            this.formShow = false
        },
        editRowHandler(data, index) {
            this.items[index].isEdit = !this.items[index].isEdit;
        },
        async saveRowHandler(data, index) {
            this.items[index].isEdit = !this.items[index].isEdit;
            await axios.post(this.editUrl, data);
        },
        isFieldSlot (fieldName) {
            return !!this.$slots[fieldName]
        },
        del(data, index) {
            let that = this
            this.$swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(that.delUrl + '/' + data.id)
                    that.items.splice(index, 1);
                    that.$swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            }) 
        },
        editDoc(row, index) {
            this.item = row
            this.docShow = true;
        }
    }
}
</script>

<style lang="scss" scoped>

</style>