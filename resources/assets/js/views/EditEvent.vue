
<template>
    <div class="container-fluid">
        <div class="event">
            <div v-if="error" class="error">
                <p class="error">Error: {{ error }}</p>
            </div>

            <div v-if="event" class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Event: {{ event.title }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="card-text" v-ajax action="/api/event/update">
                            <input type="hidden" name="id" :value="event.id" />
                            <input type="hidden" name="startdate" v-model="event.startdate" />
                            <input type="hidden" name="enddate" v-model="event.enddate" />
                            <div class="form-group row">
                                <label for="title" class="blue-grey--text col-sm-4 col-form-label label-right">Title</label>
                                <div class="col-sm-8">
                                    <input id="title" type="text" class="form-control" name="title" v-model="event.title">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image_path" class="blue-grey--text col-sm-4 col-form-label label-right">Image</label>
                                <div class="col-sm-8">
                                    <img class="venue-image-preview" :src="event.venue_image"></img>
                                    <input type="text" id="image_path" class="form-control" name="image_path" v-model="event.venue_image">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="blue-grey--text col-sm-4 col-form-label label-right">Description</label>
                                <div class="col-sm-8">
                                    <input id="description" type="text" class="form-control" name="description" v-model="event.description">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="datepicker" class="blue-grey--text col-sm-4 col-form-label">Event Date(s)</label>
                                <div class="col-sm-8">
                                    <input id="selectedDate_start" type="hidden" class="form-control" name="selectedDate.start" v-model="selectedDate.start">
                                    <input id="selectedDate_end" type="hidden" class="form-control" name="selectedDate.end" v-model="selectedDate.end">
                                    <div>{{ event.startdate_formatted }} - {{ event.enddate_formatted }}</div>
                                    <v-date-picker
                                        id="datepicker"
                                        mode="range"
                                        v-model="selectedDate"
                                        @dayclick="dayClicked"
                                        :popover="{ placement: 'bottom', visibility: 'click' }">
                                        <calendar-range-icon class="icon-medium" title="Select Date(s)" />
                                    </v-date-picker>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="blue-grey--text col-sm-4 col-form-label">City</label>
                                <div class="col-sm-8">
                                    <input id="city" type="text" class="form-control" name="city" v-model="event.city">
                                </div>
                                <label for="state" class="blue-grey--text col-sm-4 col-form-label">State</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="state" name="state" v-model="event.stateID">
                                        <option disabled value="">Select...</option>
                                        <option v-for="option in stateOptions" :key="option.stateId" :value="option.stateId">
                                            {{ option.stateName }}
                                        </option>
                                    </select>
                                </div>
                                <label for="country" class="blue-grey--text col-sm-4 col-form-label">Country</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="country" name="country" v-model="event.countryID">
                                        <option disabled value="">Select...</option>
                                        <option v-for="option in countryOptions" :key="option.countryId" :value="option.countryId">
                                            {{ option.countryName }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer">
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<script>

    import axios from 'axios';
    import SelectValuesApi from '../services/SelectValues';
    import CalendarRangeIcon from "vue-material-design-icons/CalendarRange";

    const getEvent = (id, callback) => {
        const params = { id };
        axios
            .get('/api/event/' + id, { params })
            .then(response => {
                // console.log('getEvent() response:', response); // todo
                callback(null, response.data);
            }).catch(error => {
            // console.log('axios error', error.response.data);
                callback(error, error.response.data);
            });
    };

    export default {
        components: {CalendarRangeIcon},
        data() {
            return {
                loading: true,
                event: {
                    id: null,
                    title: null,
                    location: null,
                    city: null,
                    stateID: null,
                    stateName: null,
                    countryID: null,
                    countryName: null,
                    description: null,
                    startdate: null,
                    enddate: null,
                    venue_image: null,
                },
                selectedDate: {
                    start: new Date(),
                    end: new Date(),
                },
                stateOptions: [],
                countryOptions: [],
                error: null
            };
        },
        beforeRouteEnter (to, from, next) {
            getEvent(to.params.id, (err, data) => {
                // console.log('beforeRouteEnter getEvent response:', data); // todo
                next(vm => vm.setData(err, data));
            });
        },
        beforeRouteUpdate (to, from, next) {
            this.event = null;
            this.stateOptions = null;
            this.countryOptions = null;
            this.selectedDate = null;
            getEvent(to.params.id, (err, data) => {
                this.setData(err, data);
                // console.log('beforeRouteUpdate data:', data); // todo
                next();
            });
        },
        created() {
            console.log('created() triggered'); // todo

            // Code that will run only after the
            // entire view has been rendered
            this.getStates();
            this.getCountries();

            console.log('[created] this', this); // todo
            console.log('[created] this.event', this.event);// todo
            return this.$route.params.id;
        },
        methods: {
            setData(err, { data: event }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    console.log('setData event', event); // todo
                    this.event = event;
                    this.selectedDate = {
                        start: new Date(event.startdate),
                        end: new Date(event.enddate),
                    }
                }
            },
            dayClicked() {
                this.startdate = this.selectedDate.start;
                this.enddate = this.selectedDate.end;
                console.log('this.selectedDate', this.selectedDate); // todo
            },
            getStates: function() {
                SelectValuesApi.getStates()
                    .then(result => this.stateOptions = result.data);
                // console.log('result', this.stateOptions); // todo
            },
            getCountries: function() {
                SelectValuesApi.getCountries()
                    .then(result => this.countryOptions = result.data);
                // console.log('result', this.countryOptions); // todo
            }
        }
    }

</script>
