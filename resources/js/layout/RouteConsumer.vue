<template>
    <router-view />
</template>
<script>
import { mapState } from 'vuex';
import { handleSignOut } from '../helpers/error';
import routes from "../router/routes";

export default {
    computed: mapState({
        session: state =>  state.session.info
    }),
    mounted() {
        const resolved = this.$router.resolve(this.$route.path)
        const routeName = resolved.route.name;
        const matchedRoute = routes[0].children.find(({name}) => name === routeName);
        if (!matchedRoute) return;

        if (!matchedRoute.guards) return;
        console.log({matchedRoute}, this.session.roleId);
        if (!matchedRoute.guards.includes(this.session.roleId)) {
            handleSignOut();
        }
    }
}
</script>

