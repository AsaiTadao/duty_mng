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
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div type="button" class="border-radius-15 border-color-orange border-style-solid border-width-thin background-grey py-1" @click="getResults(this.currentDate)">
                    <h3 class="text-white text-center mb-0 mt-2">
                        社員マスタ
                    </h3>
                    <div class="text-white text-center mb-2">社員情報の登録｜編集｜削除</div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center my-5">
            <div class="col-md-3">
                <div type="button" class="border-radius-15 border-color-purple border-style-solid border-width-thin background-grey py-1" @click="getResults(this.currentDate)">
                    <h3 class="text-white text-center mb-0 mt-2">
                        時間帯マスタ
                    </h3>
                    <div class="text-white text-center mb-2">時間帯の登録｜編集｜削除</div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div type="button" class="border-radius-15 border-color-orange border-style-solid border-width-thin background-grey py-1" @click="getResults(this.currentDate)">
                    <h3 class="text-white text-center mb-0 mt-2">
                        社員マスタ
                    </h3>
                    <div class="text-white text-center mb-2">社員情報の登録｜編集｜削除</div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center my-5">
            <div class="col-md-3">
                <div type="button" class="border-radius-15 border-color-blue border-style-solid border-width-thin background-grey py-1" @click="getResults(this.currentDate)">
                    <h3 class="text-white text-center mb-0 mt-2">
                        事業所マスタ
                    </h3>
                    <div class="text-white text-center mb-2">事業所の登録｜編集｜削除</div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
</template>
