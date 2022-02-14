<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a
                    class="nav-link"
                    data-widget="pushmenu"
                    href="#"
                    role="button"
                >
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-3">
            <li class="nav-item kintai-system system-selected">
                <a
                    class="nav-link px-4"
                    href="#"
                    role="button"
                >
                    勤怠
                </a>
            </li>
            <li class="nav-item childcare-system system-unselected">
                <a
                    class="nav-link px-4"
                    href="/child"
                    role="button"
                >
                    保育
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="top-profile-link">
                        <div class="top-avatar">
                            <img src="/images/dummy-avatar.png" />
                        </div>
                        <div class="top-profile-name">
                            {{ session.name }}
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" @click="signOut" class="nav-link" style="font-size: 20px;">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
import { handleSignOut } from '../helpers/error';
import { mapState } from 'vuex';

export default {
    computed: mapState({
        session: state => state.session.info
    }),
    methods: {
        signOut() {
            handleSignOut();
        }
    }
};
</script>
