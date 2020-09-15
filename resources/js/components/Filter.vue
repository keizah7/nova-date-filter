<template>
    <div>
        <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
            {{ filter.name }}
        </h3>

        <div class="p-2">
            <date-time-picker
                class="w-full form-control form-input form-input-bordered"
                dusk="date-filter"
                name="date-filter"
                autocomplete="off"
                :value="value"
                :alt-format="altFormat"
                :date-format="dateFormat"
                :placeholder="placeholder"
                :enable-time="enableTime"
                :enable-seconds="enableSeconds"
                :first-day-of-week="firstDayOfWeek"
                @input.prevent=""
                @change="handleChange"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        resourceName: {
            type: String,
            required: true,
        },
        filterKey: {
            type: String,
            required: true,
        },
    },

    methods: {
        handleChange(value) {
            this.$store.commit(`${this.resourceName}/updateFilterState`, {
                filterClass: this.filterKey,
                value,
            });
            this.$emit('change');
        },
    },
    
    computed: {
        filter() {
            return this.$store.getters[`${this.resourceName}/getFilter`](
                this.filterKey,
            );
        },

        value() {
            return this.filter.currentValue;
        },

        altFormat() {
            return this.filter.options.altFormat || 'Y-m-d H:i';
        },

        dateFormat() {
            return this.filter.options.altFormat || 'Y-m-d H:i';
        },

        placeholder() {
            return this.filter.options.placeholder || this.__('Choose date');
        },

        enableTime() {
            return this.filter.options.enableTime || true;
        },

        enableSeconds() {
            return this.filter.options.enableSeconds || false;
        },

        firstDayOfWeek() {
            return this.filter.options.firstDayOfWeek || 0;
        },
    },
}
</script>
