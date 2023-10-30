<template>
    <div class="card">
        <div class="card-body">
            <img :src="location" v-if="location">
        </div>
        <div class="card-footer m-0 p-0">
            <input id="mimic" type="file" ref="file" class="form-control" @change="upload" :value="location">
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            path: String,
            group: String,
            fleetId: String
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
                let file = e.target.files[0];
                let formData = new FormData();
                formData.append('file', file);
                formData.append('group', this.group);
                formData.append('fleet_id', this.fleetId);

                axios.post('/upload/svg',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                    ).then(function(e){
                        console.log(e);
                    }).catch(function(e){
                        console.log(e);
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>