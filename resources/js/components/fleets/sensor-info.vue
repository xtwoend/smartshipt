<template>
    <div class="row">
        <div class="col-12">
            <div class="table-title">
                <h6>{{ title }}</h6>
            </div>
            <table class="table table-sm">
                <tbody>
                    <tr v-for="(row, index) in sensors">
                        <th scope="row">•</th>
                        <td>{{ row.name  }}</td>
                        <td class="text-end">{{ row.value }} {{ row.unit }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        fleet: Object,
        sensors: Array
    },
    data() {
        return {

        }
    }
}
</script>

<style lang="scss" scoped></style>