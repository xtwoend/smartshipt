<template>
    <div class="card">
        <div class="card-body">
            <img :src="location" v-if="location">
        </div>
        <div class="card-footer m-0 p-0">
            <input id="mimic" type="file" class="form-control" @change="upload" :value="location">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            path: String,
            group: String,
        },
        data () {
            return {
                location: null
            }
        },
        watch: {
            path: function(n, o) {
                this.location = n
            }
        },
        methods: {
            upload(e) {
                console.log(e)
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>