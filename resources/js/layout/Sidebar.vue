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
                >
                    <li class="nav-item menu-open">
                        <router-link to="/home" class="nav-link">
                            <i class="nav-icon fas fa-clock"></i>
                            <p>
                                打刻
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                勤怠状況
                            </p>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
</template>
<script>
export default {};
</script>
