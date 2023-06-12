<template>
    <date-range-picker
            ref="picker"
            v-model="dateRange"
            :dateRange="dateRange"
            :locale-data="locale"
            timePicker
            timePicker24Hour
            @update="updatePicker"
            @select="updatePicker"
    >
        <template v-slot:input="picker" style="min-width: 350px;">
            {{ $filters.dateformat(picker.startDate) }} - {{ $filters.dateformat(picker.endDate) }}
        </template>
    </date-range-picker>
</template>

<script>
import moment from 'moment';
import DateRangePicker from 'vue3-daterange-picker'
var d = new Date()
export default {
    name: 'DateRange',
    components: { DateRangePicker },
    data() {
        return {
            dateRange: {
                startDate: new Date(),
                endDate: new Date(),
            },
            locale: {
                direction: 'ltr', //direction of text
                separator: ' - ', //separator between the two ranges
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                weekLabel: 'W',
                customRangeLabel: 'Custom Range',
                daysOfWeek: moment.weekdaysMin(), //array of days - see moment documenations for details
                monthNames: moment.monthsShort(), //array of month names - see moment documenations for details
                firstDay: 1 //ISO first day of week - see moment documenations for details
            }
        }
    },
    methods: {
        updatePicker(e) {
            this.$emit('selected', e)
        }
    }
}
</script>

<style>
.reportrange-text {
    width: 100% !important;
    white-space: nowrap;
    padding: 0.4375rem 0.75rem !important;
    border: 1px solid #616876 !important;
}
</style>
