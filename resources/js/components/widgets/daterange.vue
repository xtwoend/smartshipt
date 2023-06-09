<template>
<!--    <date-range-picker-->
<!--        @update="updatePicker"-->
<!--        :locale-data="locale"-->
<!--        :dateRange="dateRange"-->
<!--        v-model="dateRange"-->
<!--    >-->
<!--    &lt;!&ndash;Optional scope for the input displaying the dates &ndash;&gt;-->
<!--&lt;!&ndash;    <div slot="picker" class="form-control" >&ndash;&gt;-->
<!--&lt;!&ndash;        {{ dateRange.startDate }} - {{ dateRange.endDate }}&ndash;&gt;-->
<!--&lt;!&ndash;    </div>&ndash;&gt;-->
<!--</date-range-picker>-->
</template>

  <script>
  import DateRangePicker from 'vue3-daterange-picker'
  import moment from 'moment'

export default {
    name: 'DateRange',
    components: { DateRangePicker },
    data() {
        return {
            dateRange: {
                startDate: '05-09-2023',
                endDate: '05-09-2023',
            },
            locale: {
                direction: 'ltr', //direction of text
                format: 'DD-MM-YYYY', //fomart of the dates displayed
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
        updatePicker() {
            console.log(this.dateRange.startDate)
        }
    }
}
  </script>

  <style>
    .reportrange-text{
        width: 100%!important;
        white-space: nowrap;
        padding: 0.4375rem 0.75rem!important;
        border: 1px solid #616876!important;
    }
</style>
