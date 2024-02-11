<template>
    <div>
        <input type="file" ref="fileInput" @change="inputOnChange" />
        <button class="btn-upload">
            <img src="/img/icons/upload.svg" height="26">
        </button>
    </div>
</template>

<script>
export default {
    props: {
        action: String,
    },
    methods: {
        inputOnChange (e) {
            console.log(e)
        }
    }
}
</script>

<style lang="scss" scoped>

</style>