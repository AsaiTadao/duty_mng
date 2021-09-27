<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        設定管理
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <router-link to="/admin/office-master">
                                    <div type="button" class="border-radius-15 border-color-blue border-style-solid border-width-thin background-grey py-1">
                                        <h3 class="text-white text-center mt-2">
                                            休憩設定
                                        </h3>
                                    </div>
                                </router-link>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <router-link to="/admin/employee-master">
                                    <div type="button" class="border-radius-15 border-color-orange border-style-solid border-width-thin background-grey py-1">
                                        <h3 class="text-white text-center mt-2">
                                            端数設定
                                        </h3>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-center mt-5">
                            <div class="col-md-3">
                                <router-link to="/admin/timezone-master">
                                    <div type="button" class="border-radius-15 border-color-purple border-style-solid border-width-thin background-grey py-1">
                                        <h3 class="text-white text-center mt-2">
                                            連勤設定
                                        </h3>
                                    </div>
                                </router-link>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <router-link to="/admin/vacation-master">
                                    <div type="button" class="border-radius-15 border-color-green border-style-solid border-width-thin background-grey py-1">
                                        <h3 class="text-white text-center mt-2">
                                            権限設定
                                        </h3>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
