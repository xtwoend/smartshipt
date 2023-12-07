<template>
    <date-range-picker
            ref="picker"
            v-model="dateRange"
            auto-apply
            @update:modelValue="updatePicker"
            :dateRange="dateRange"
            :locale-data="locale"
            format="DD/MM/YYYY"
    >
        <!-- <template v-slot:input="picker" style="min-width: 350px;">
            {{ $filters.dateformat(picker.startDate, 'DD/MM/YYYY') }} - {{ $filters.dateformat(picker.endDate, 'DD/MM/YYYY') }}
        </template> -->
    </date-range-picker>
    <input type="hidden" name="from" v-model="localFrom">
    <input type="hidden" name="to" v-model="localTo">
</template>

<script>
import moment from 'moment';
import DateRangePicker from 'vue3-daterange-picker'

export default {
    name: 'DateRange',
    components: { DateRangePicker },
    props: {
        from: String,
        to: String,
    },
    data() {
        return {
            localFrom:  this.from ? moment(Date.parse(this.from)).format('YYYY-MM-DD') : moment(new Date()).format('YYYY-MM-DD'),
            localTo: this.to ? moment(Date.parse(this.to)).format('YYYY-MM-DD') : moment(new Date()).format('YYYY-MM-DD'),
            dateRange: {
                startDate: this.from ? Date.parse(this.from) : new Date(),
                endDate: this.to ? Date.parse(this.to) : new Date(),
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
            this.localFrom = moment(e.startDate).format('YYYY-MM-DD');
            this.localTo = moment(e.endDate).format('YYYY-MM-DD');
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
