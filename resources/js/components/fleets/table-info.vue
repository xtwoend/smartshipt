<template>
    
    <div class="row">
        <div class="col-12">
            <div class="table-title">
                <h6>Data Information</h6>
            </div>
            <table class="table table-sm" v-if="data">
                <tbody>
                    <tr>
                        <th scope="row">•</th>
                        <td>Updated at</td>
                        <td class="text-end">{{ data.terminal_time }}</td>
                    </tr>
                    <tr v-for="a in mapping" :key="a.data">
                        <th scope="row">•</th>
                        <td>{{ a.text }}</td>
                        <td class="text-end">{{ data[a.data] }} <span v-html="a.unit"></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        url: String,
        mapping: Array
    },
    data () {
        return {
            data: null
        }
    },
    created() {
        this.fetchData()
    },
    mounted() {
        setInterval(() => this.fetchData(), 5 * 1000)
    },
    methods: {
        async fetchData() {
            this.data = await axios.get(this.url).then(res => res.data);
        }
    }
}

</script>

<style lang="scss" scoped></style>