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
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="top-profile-link">
                        <div class="top-avatar">
                            <img src="/images/dummy-avatar.png" />
                        </div>
                        <div class="top-profile-name">
                            阿部 一子
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <router-link to="/" class="nav-link" style="font-size: 20px;">
                    <i class="fas fa-sign-out-alt"></i>
                </router-link>
            </li>
        </ul>
    </nav>
</template>
<script>
export default {};
</script>
