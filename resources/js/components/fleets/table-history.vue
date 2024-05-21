<template>
    <div class="row">
        <div class="col-12">
            <div class="table-title">
                <h6>{{ title }}</h6>
            </div>
        </div>
        <div class="col-12 mt-3">
            <EasyDataTable
                v-model:server-options="options"
                :server-items-length="length"
                :loading="loading"
                :headers="headers"
                :items="items"
            />
        </div>
    </div>
</template>

<script>
import EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

export default {
    components: { EasyDataTable },
    props: {
        columns: {
            type: Array,
            default: []
        },
        url: String,
        title: String
    },
    data () {
        return {
            items: [],
            loading: false,
            length: 0,
            headers: [],
            filters: {},
            options: {
                page: 1,
                rowsPerPage: 25,
                sortBy: 'terminal_date',
                sortType: 'desc'
            }
        }
    },
    mounted() {
        this.buildHeaders(this.columns)
    },
    watch: {
        options: {
            handler: function(n, o) {
                this.load()
            },
            deep: true
        },
        columns: {
            handler: function(n, o) {
                this.buildHeaders(n)
            },
            deep: true
        }
    },
    methods: {
        async load () {
            this.loading = true
            let resp = await axios.get(this.url, {params: this.filters}).then(res => res.data)
            if(! resp.error)
                this.items = resp.data
                this.page = resp.meta.page
                this.length = resp.meta.length
                this.rowsPerPage = resp.meta.per_page
            
            this.loading = false
        },
        buildHeaders(columns) {
            let _this = this
            columns.forEach(e => {
                _this.headers.push({
                    text: e.text,
                    value: e.data,
                    sortable: e.is_ams
                });
            });
        } 
    }
}
</script>

<style lang="scss">

</style>