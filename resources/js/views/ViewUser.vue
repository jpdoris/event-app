
<template>
    <div class="container-fluid">
        <div class="user">

            <div v-if="user" class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View User: {{ user.firstname }} {{ user.lastname }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">Name</div>
                            <div class="col-sm-8">{{ user.fullname }}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">Email</div>
                            <div class="col-sm-8">{{ user.username }}</div>
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
