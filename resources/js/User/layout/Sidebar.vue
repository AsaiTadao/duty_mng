<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light">LK TMS</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    role="menu"
                    data-accordion="false"
                    v-if="routes.length > 0"
                >
                    <li
                        class="nav-item"
                        v-for="(route, index) in routes"
                        :key="index"
                        :class="{
                            'menu-open': '/user/' + route.path === currentRoute
                        }"
                    >
                        <router-link
                            :to="'/user/' + route.path"
                            class="nav-link"
                        >
                            <i :class="'nav-icon ' + route.icon"></i>
                            <p>
                                {{ route.anchor }}
                            </p>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>
<script>
import routes from "../../routes";

export default {
    data() {
        return {
            routes: []
        };
    },
    computed: {
        currentRoute() {
            const route = this.$route.path;
            return route;
        }
    },
    mounted() {
        const userRoutes = routes.find(({ path }) => path === "/user");
        this.routes = userRoutes.children;
    }
};
</script>
