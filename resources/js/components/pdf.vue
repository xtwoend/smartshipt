<template>
    <div>
        <PDFViewer :source="url" style="height: 100vh; width: 100vw" />
    </div>
</template>

<script>
import PDFViewer from 'pdf-viewer-vue'

// OR THE FOLLOWING IMPORT FOR VUE 2
// import PDFViewer from 'pdf-viewer-vue/dist/vue2-pdf-viewer'

export default {
    props: {
        url: String
    },
    components: {
        PDFViewer,
    },

    data() {
        return {
            // 
        }
    },
    methods: {
        // handleDownload
    }
}
</script>