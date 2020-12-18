<template>
    <div class="events">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Events</h3>
            </div>

            <div class="card-body">
                <div v-if="error" class="error">
                    <p>{{ error }}</p>
                </div>

                <div v-if="events">
                    <table class="table table-responsive table-striped table-condensed">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Date</th>
                            <th scope="col">Location</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="{ id, title, startdate, location } in events">
                            <td scope="row">{{ id }}</td>
                            <td>{{ title }}</td>
                            <td>{{ startdate }}</td>
                            <td>{{ location }}</td>
                            <td class="link" :id="events.id" @click="viewEvent(id)"><eye-icon title="View Event Details" /></td>
                            <td class="link" :id="events.id" @click="editEvent(id)"><account-edit-icon title="Edit Event" /></td>
                            <td class="link"><account-remove-icon title="Delete Event" /></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <div class="pagination">
                    <button type="button" class="btn btn-sm btn-info" :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
                    <div class="mx-auto">{{ paginationCount }}</div>
                    <button type="button" class="btn btn-sm btn-info" :disabled="! nextPage" @click.prevent="goToNext">Next</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import EyeIcon from "vue-material-design-icons/Eye";
    import AccountEditIcon from "vue-material-design-icons/AccountEdit";
    import AccountRemoveIcon from "vue-material-design-icons/AccountRemove";

    const getEvents = (page, callback) => {
        const params = { page };

        axios
            .get('/api/events', { params })
            .then(response => {
                callback(null, response.data);
            })
            .catch(error => {
                callback(error, error.response.data);
            });
    };

    export default {
        components: {AccountRemoveIcon, AccountEditIcon, EyeIcon},
        data() {
            return {
                events: null,
                stateOptions: null,
                countryOptions: null,
                meta: null,
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null,
            };
        },
        computed: {
            nextPage() {
                if (! this.meta || this.meta.current_page === this.meta.last_page) {
                    return;
                }

                return this.meta.current_page + 1;
            },
            prevPage() {
                if (! this.meta || this.meta.current_page === 1) {
                    return;
                }

                return this.meta.current_page - 1;
            },
            paginationCount() {
                if (! this.meta) {
                    return;
                }

                const { current_page, last_page } = this.meta;

                return `${current_page} of ${last_page}`;
            }
        },
        beforeRouteEnter (to, from, next) {
            getEvents(to.query.page, (err, data) => {
                next(vm => vm.setData(err, data));
            });
        },
        // when route changes and this component is already rendered,
        // the logic will be slightly different.
        beforeRouteUpdate (to, from, next) {
            this.events = this.links = this.meta = null
            getEvents(to.query.page, (err, data) => {
                this.setData(err, data);
                next();
            });
        },
        methods: {
            goToNext() {
                this.$router.push({
                    query: {
                        page: this.nextPage,
                    },
                });
            },
            goToPrev() {
                this.$router.push({
                    name: 'events.index',
                    query: {
                        page: this.prevPage,
                    }
                });
            },
            viewEvent(id) {
                this.$router.push({
                    name: 'event.view',
                    params: {
                        id: id,
                    }
                });
                event.preventDefault()
            },
            editEvent(id) {
                this.$router.push({
                    name: 'event.edit',
                    params: {
                        id: id,
                    }
                });
                event.preventDefault()
            },
            setData(err, { data: events, links, meta }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.events = events;
                    this.links = links;
                    this.meta = meta;
                }
            },
        }
    }
</script>

<style scoped>

</style>
