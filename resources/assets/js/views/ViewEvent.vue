
<template>
    <div class="container-fluid">
        <div class="event">

            <div v-if="event" class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View Event: {{ event.title }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">Description</div>
                            <div class="col-sm-8">{{ event.description }}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">Venue</div>
                            <div class="col-sm-8">{{ event.location }}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">Date</div>
                            <div class="col-sm-8">{{ event.startdate }} - {{ event.enddate }}</div>
                        </div>
                    </div>

                    <div class="card-footer"></div>
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
                error: null,
            };
        },
        created() {
            return this.$route.params.id;
        },
        beforeRouteEnter (to, from, next) {
            getEvent(to.params.id, (err, data) => {
                // console.log('beforeRouteEnter data:', data); // todo
                next(vm => vm.setData(err, data));
            });
        },
        beforeRouteUpdate (to, from, next) {
            this.event = null;
            getEvent(to.params.id, (err, data) => {
                // console.log('beforeRouteUpdate data:', data); // todo
                this.setData(err, data);
                next();
            });
        },
        methods: {
            setData(err, { data: event }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.event = event;
                    console.log('setData event', this.event); // todo
                }
            },
        }
    }

</script>
