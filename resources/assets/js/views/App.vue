<template>
    <div class="container-fluid full-width">
        <div class="page-header">
            <h1>Event Manager</h1>
            <p>
                <router-link :to="{ name: 'home' }">Home</router-link> |
                <router-link :to="{ name: 'hello' }">Hello World</router-link> |
                <router-link :to="{ name: 'users.index' }">Users Index</router-link>
            </p>
        </div>

        <div class="row content">
            <router-view></router-view>
        </div>
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
