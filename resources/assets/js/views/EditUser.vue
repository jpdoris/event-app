
<template>
    <div class="container">
        <div class="user">
            <div v-if="error" class="error">
                <p class="error">Error: {{ error }}</p>
            </div>

            <div v-if="user">
                <h2>Edit User: {{ user.username }}</h2>
                <form>

                </form>
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
