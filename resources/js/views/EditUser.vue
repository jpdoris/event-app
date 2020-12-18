
<template>
    <div class="container-fluid">
        <div class="user">
            <div v-if="error" class="error">
                <p class="error">Error: {{ error }}</p>
            </div>

            <div v-if="user" class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit User: {{ user.firstname }} {{ user.lastname }}</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="card-text" v-ajax action="/api/user/update">
                            <input type="hidden" name="id" :value="user.id" />
                            <div class="form-group row">
                                <label for="username" class="blue-grey--text col-sm-4 col-form-label label-right">Username</label>
                                <div class="col-sm-8">
                                    <input id="username" type="text" class="form-control" name="username" v-model="user.username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="firstname" class="blue-grey--text col-sm-4 col-form-label label-right">First Name</label>
                                <div class="col-sm-8">
                                    <input id="firstname" type="text" class="form-control" name="firstname" v-model="user.firstname">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lastname" class="blue-grey--text col-sm-4 col-form-label">Last Name</label>
                                <div class="col-sm-8">
                                    <input id="lastname" type="text" class="form-control" name="lastname" v-model="user.lastname">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="blue-grey--text col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input id="email" type="text" class="form-control" name="email" v-model="user.email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="blue-grey--text col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input id="password" type="password" class="form-control" name="password" v-model="user.password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirm" class="blue-grey--text col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm-8">
                                    <input id="password_confirm" type="password" class="form-control" name="password_confirm" v-model="user.password">
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

    const getUser = (username, callback) => {
        const params = { username };

        axios
            .get('/api/user/' + username, { params })
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
                user: {
                  id: null,
                  email: null,
                  name: null,
                  username: null
                },
                error: null,
            };
        },
        created() {
            return this.$route.params.username;
        },
        beforeRouteEnter (to, from, next) {
            getUser(to.params.username, (err, data) => {
                console.log('beforeRouteEnter data:', data); // todo
                next(vm => vm.setData(err, data));
            });
        },
        beforeRouteUpdate (to, from, next) {
            this.user = null;
            getUser(to.params.username, (err, data) => {
                console.log('beforeRouteUpdate data:', data); // todo
                this.setData(err, data);
                next();
            });
        },
        methods: {
            setData(err, { data: user }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.user = user;
                    console.log('setData user', this.user); // todo
                }
            },
        }
    }

</script>
