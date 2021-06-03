Nova.booting((Vue, router, store) => {
  Vue.component('custom-date-filter', require('./components/Filter'));
  Vue.component('date-time-picker', require('./components/DateTimePicker'));
})
