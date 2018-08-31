
<template>
    <div class="users">
        <h2>Users</h2>
        <div v-if="error" class="error">
            <p>{{ error }}</p>
        </div>

        <div v-if="users">
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="{ id, username, name, email } in users">
                        <td scope="row">{{ id }}</td>
                        <td>{{ username }}</td>
                        <td>{{ name }}</td>
                        <td>{{ email }}</td>
                        <td :username="users.username" @click="linkToUser(username)"><eye-icon title="View User Account" /></td>
                        <td :username="users.username" @click="linkToUser(username)"><account-edit-icon title="Edit User" /></td>
                        <td><account-remove-icon title="Delete User" /></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <button type="button" class="btn btn-sm btn-info" :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
            <div class="mx-auto">{{ paginationCount }}</div>
            <button type="button" class="btn btn-sm btn-info" :disabled="! nextPage" @click.prevent="goToNext">Next</button>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import EyeIcon from "vue-material-design-icons/Eye";
    import AccountEditIcon from "vue-material-design-icons/AccountEdit";
    import AccountRemoveIcon from "vue-material-design-icons/AccountRemove";

    const getUsers = (page, callback) => {
        const params = { page };

        axios
            .get('/api/users', { params })
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
                    users: null,
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
                getUsers(to.query.page, (err, data) => {
                    next(vm => vm.setData(err, data));
                });
            },
            // when route changes and this component is already rendered,
            // the logic will be slightly different.
            beforeRouteUpdate (to, from, next) {
                this.users = this.links = this.meta = null
                getUsers(to.query.page, (err, data) => {
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
                        name: 'users.index',
                        query: {
                            page: this.prevPage,
                        }
                    });
                },
                linkToUser(username) {
                    this.$router.push({
                        name: 'user.view',
                        params: {
                            username: username,
                        }
                    });
                    event.preventDefault()
                },
                setData(err, { data: users, links, meta }) {
                    if (err) {
                        this.error = err.toString();
                    } else {
                        this.users = users;
                        this.links = links;
                        this.meta = meta;
                    }
                },
            }
        }
</script>
