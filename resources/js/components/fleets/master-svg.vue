<template>
    <div class="card">
        <div class="card-body">
            <img :src="location" v-if="location">
        </div>
        <div class="card-footer m-0 p-0">
            <input id="mimic" type="file" ref="file" class="form-control" @change="upload">
        </div>
        <div class="loading" v-show="isLoading">Loading...</div>
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
                location: null,
                isLoading: false,
            }
        },
        mounted(){
            this.location = '/' + this.path;
        },
        methods: {
            upload(e) {
                this.isLoading = true
                let file = e.target.files[0];
                let formData = new FormData();
                formData.append('file', file);
                formData.append('group', this.group);
                formData.append('fleet_id', this.fleetId);
                let that = this
                axios.post('/upload/svg',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                    ).then(function(e){
                        that.location = '/' + e.data.path
                        that.isLoading = false
                    }).catch(function(e){
                        console.log(e);
                        that.isLoading = false
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>
.loading {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    text-align: center;
    padding-top: 2rem;
    background: rgba(0, 0, 0, 0.2);
}
</style>