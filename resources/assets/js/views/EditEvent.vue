
<template>
    <div class="container-fluid">
        <div class="event">
            <div v-if="error" class="error">
                <p class="error">Error: {{ error }}</p>
            </div>

            <div v-if="event" class="col-6">
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
                                <label for="description" class="blue-grey--text col-sm-4 col-form-label label-right">Description</label>
                                <div class="col-sm-8">
                                    <input id="description" type="text" class="form-control" name="description" v-model="event.description">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="blue-grey--text col-sm-4 col-form-label">Location</label>
                                <div class="col-sm-8">
                                    <input id="location" type="text" class="form-control" name="location" v-model="event.location">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="selectedDate" class="blue-grey--text col-sm-4 col-form-label">Event Date(s)</label>
                                <div class="col-sm-8">
                                    <input id="selectedDate" type="hidden" class="form-control" name="selectedDate" v-model="selectedDate">
                                    <v-date-picker
                                        mode='range'
                                        v-model='selectedDate'>
                                    </v-date-picker>
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

    const getEvent = (id, callback) => {
        const params = { id };
        axios
            .get('/api/event/' + id, { params })
            .then(response => {
                console.log('response:',response); // todo
                callback(null, response.data);
            }).catch(error => {
            callback(error, error.response.data);
        });
    };

    export default {
        data() {
            return {
                event: {
                    id: null,
                    title: null,
                    location: null,
                    description: null,
                    startdate: null,
                    enddate: null,
                },
                selectedDate: {
                    start: new Date(),
                    end: new Date()
                },
                error: null,
            };
        },
        created() {
            return this.$route.params.id;
        },
        beforeRouteEnter (to, from, next) {
            getEvent(to.params.id, (err, data) => {
                console.log('beforeRouteEnter data:', data); // todo
                console.log('this:', this); // todo
                next(vm => vm.setData(err, data));
            });
        },
        beforeRouteUpdate (to, from, next) {
            this.event = null;
            getEvent(to.params.id, (err, data) => {
                this.setData(err, data);
                console.log('beforeRouteUpdate data:', data); // todo
                console.log('selectedDate:', selectedDate); // todo
                next();
            });
        },
        methods: {
            setDates(start,end) {
                selectedDate.start = start;
                selectedDate.end = end;
            },
            setData(err, { data: event }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    console.log('setData data', event); // todo
                    // event.startdate = selectedDate.start;
                    // event.enddate = selectedDate.end;
                    this.event = event;
                    console.log('setData event', this.event); // todo
                }
            },
        }
    }

</script>
