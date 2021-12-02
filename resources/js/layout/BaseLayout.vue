<template>
    <div class="wrapper">
        <template v-if="session">
            <topbar />
            <sidebar />
            <div class="content-wrapper">
                <section class="content">
                    <router-view />
                </section>
            </div>
        </template>
        <loading :active="!session || actionLoading" color="#007BFF"></loading>
    </div>
</template>
<script>
import Topbar from "./Topbar.vue";
import Sidebar from "./Sidebar.vue";
import { mapState } from 'vuex';
import LocalStorage from '../helpers/localStorage';
import Loading from 'vue-loading-overlay';
import { handleSignOut } from '../helpers/error';
import actionLoading from '../mixin/actionLoading';

export default {
    mixins: [actionLoading],
    components: {
        Topbar,
        Sidebar,
        Loading
    },
    computed: mapState({
        session: state =>  state.session.info,
    }),
    mounted() {
        const token = LocalStorage.getToken();
        if (token && !this.session) {
            this.$store.dispatch('session/fetchSession');
        }
        if (!token) {
            handleSignOut();
            return;
        }
    }
};
</script>
