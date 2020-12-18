<template>
    <v-date-picker
        mode='range'
        v-model='selectedDate'
        show-caps>
    </v-date-picker>
</template>

<script>
    // let startdate =
    export default {
        data() {
            return {
                selectedDate: {
                    start: new Date.now(),
                    end: new Date.now()
                }
            };
        },
    };
</script>
