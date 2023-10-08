<template>
    <div class="progress">
        <div class="progress-bar" :class="color" :style="{ width: `${percentage}%` }" role="progressbar" aria-valuenow="0"
            aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</template>

<script>
export default {
    props: {
        min: Number,
        max: Number,
        value: Number,
        normal: Number,
        danger: Number
    },
    data() {
        return {
            // 
        }
    },
    computed: {
        percentage() {
            let percentage = (this.value / this.max) * 100;
            return percentage;
        },
        color() {
            let color = 'bg-success';
            let percentage = (this.value / this.max) * 100;
            let normal = (this.normal / this.max) * 100;
            let danger = (this.danger / this.max) * 100;

            if(percentage > normal && percentage < danger) {
                color = 'bg-warning'
            }else if(percentage > danger) {
                color = 'bg-danger'
            }
            return color;
        }
    }
}
</script>

<style lang="scss" scoped></style>