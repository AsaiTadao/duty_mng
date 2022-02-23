<template>
    <section class="content">
        <template v-if="allowed">
            <router-view />
        </template>
    </section>
</template>
<script>
import { mapState } from 'vuex';
import { Guards } from '../global/consts';
import { handleSignOut, showError } from '../helpers/error';
import routes from "../router/routes";

export default {
    components: {},
    computed: {
        ...mapState({
            roleId: state =>  state.session.info.roleId || Guards.PARENT
        }),
        matchedRoute: function() {
            const resolved = this.$router.resolve(this.$route.path)
            const routeName = resolved.route.name;
            const targetRoutes = this.roleId !== Guards.PARENT ? routes[0] : routes[1]
            return targetRoutes.children.find(({name}) => name === routeName);
        }
    },
    watch: {
        matchedRoute: function(value) {
            this.checkRoute(value);
        }
    },
    data() {
        return {
            allowed: true,
        }
    },
    mounted() {
        this.checkRoute(this.matchedRoute)
    },
    methods: {
        checkRoute(value) {
            if (!value) return;
            if (!value.meta.guards) return;
            if (!value.meta.guards.includes(this.roleId)) {
                showError(this.$t("You are not allowed"))
                this.allowed = false;
                // setTimeout(() => {
                //     handleSignOut();
                // }, 5000);
            } else {
                this.allowed = true;
            }
        }
    }
}
</script>

