<template>
    <div class="container-fluid full-width">
        <div class="page-header">
            <h1>Event Manager</h1>
            <p>
                <router-link :to="{ name: 'home' }">Home</router-link> |
                <router-link :to="{ name: 'users.index' }">Users Index</router-link> |
                <router-link :to="{ name: 'events.index' }">Events Index</router-link>
            </p>
        </div>

        <div class="row content">
            <router-view></router-view>
        </div>

        <footer class="page-footer fixed-bottom font-small">
            <div class="footer-copyright text-center py-3">Copyright © 2018 Some Company</div>
        </footer>
    </div>
</template>
<script>
    export default {
        name: 'app'
    }
</script>

<style lang="scss">
    @import '../../sass/app.scss';
    @import '../../../../node_modules/bootstrap/scss/bootstrap.scss';
</style>
