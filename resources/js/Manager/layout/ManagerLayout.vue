<template>
    <div class="wrapper">
        <topbar />
        <sidebar />
        <div class="content-wrapper">
            <section class="content">
                <router-view />
            </section>
        </div>
    </div>
</template>
<script>
import Topbar from "./Topbar.vue";
import Sidebar from "./Sidebar.vue";

export default {
    components: {
        Topbar,
        Sidebar
    }
};
</script>
