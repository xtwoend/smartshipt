<template>
    <div class="voyage-section">
        <div class="card voyage-card">
            <div class="card-header justify-content-between">
                <button @click="$emit('close', true)" class="btn btn-link bg-transparent p-0">
                    <img :src="'/img/icons/close-fill.png'" alt="" />
                </button>
                <h5 class="fw-normal m-0">Information</h5>
            </div>
            <div class="card-body">
                {{ info }}
            </div>
        </div>
    </div>
</template>

<script >
export default {
    props: {
        info: Object
    },
    emits: ['close'],
    watch: {
        info: function(n, o) {
            console.log(n)
        }
    }
}
</script>

<style lang="scss" scoped>

</style>