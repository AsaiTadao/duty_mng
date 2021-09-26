<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <h3 class="card-title mb-0">マスタ管理</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            <router-link to="/admin/office-master"
                                >事業所マスタ</router-link
                            >
                            <router-link to="/admin/employee-master"
                                >社員マスタ</router-link
                            >
                            <router-link to="/admin/timezone-master"
                                >時間帯マスタ</router-link
                            >
                            <router-link to="/admin/vacation-master"
                                >休暇マスタ</router-link
                            >
                            <router-link to="/admin/schedule-master"
                                >所定労働時間マスタ</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
