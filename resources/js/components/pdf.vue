<template>
    <div>
        <PDF :src="url" />
    </div>
</template>

<script>
import PDF from "pdf-vue3";

export default {
    props: {
        url: String
    },
    components: {
        PDF,
    },
    data() {
        return {
            // 
        }
    },
    methods: {
        // handleDownload
    },
}
</script>