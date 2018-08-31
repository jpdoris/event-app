<template>
    <div class="container">
        <div class="page-header">
            <h1>Event Manager</h1>
            <p>
                <router-link :to="{ name: 'home' }">Home</router-link> |
                <router-link :to="{ name: 'hello' }">Hello World</router-link> |
                <router-link :to="{ name: 'users.index' }">Users Index</router-link>
            </p>
        </div>

        <div class="row">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
