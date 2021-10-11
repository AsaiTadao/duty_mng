<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        設定管理
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-square-full"></i>
                            <div class="font-size-25 ml-2">端数設定</div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-row align-items-center">
                                <div>出勤時間［</div>
                                <input type="text" class="fixed-width-30"/>
                                <div>］ 分</div>

                                <div class="d-flex align-items-center ml-5 mr-2">
                                    <input type="radio" name="shukkin-minutes" value="1"/>
                                    <div class="mx-1">切り捨て</div>
                                </div>
                                <div class="d-flex align-items-center ml-2">
                                    <input type="radio" name="shukkin-minutes" value="2"/>
                                    <div class="mx-1">切り上げ</div>
                                </div>
                            </div>
                            <br>
                            <div class="form-row align-items-center">
                                <div>退勤時間［</div>
                                <input type="text" class="fixed-width-30"/>
                                <div>］ 分</div>

                                <div class="d-flex align-items-center ml-5 mr-2">
                                    <input type="radio" name="taikin-minutes" value="1"/>
                                    <div class="mx-1">切り捨て</div>
                                </div>
                                <div class="d-flex align-items-center ml-2">
                                    <input type="radio" name="taikin-minutes" value="2"/>
                                    <div class="mx-1">切り上げ</div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-square-full"></i>
                            <div class="font-size-25 ml-2">連勤設定</div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="form-row align-items-center">
                                <div>日曜日を起算日として［</div>
                                <input type="text" class="fixed-width-40" placeholder="７日"/>
                                <div>］日目を手当対象日とする。</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
