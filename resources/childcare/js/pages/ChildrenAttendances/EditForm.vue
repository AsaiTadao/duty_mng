<template>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">編集</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <div class="col-md-3">
                    日付
                </div>
                <div class="col-md-5">
                    2021年10月11日（月）
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    事業所
                </div>
                <div class="col-md-5">
                    ラテラル保育園
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">登園時間</div>
                <div class="col-md-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="24" class="form-control mr-2">
                    </div>
                </div>
                <div class="form-control-label">時</div>
                <div class="col-md-3">
                    <div class="d-flex is-invalid">
                        <input type="number" min="0" max="24" class="form-control mr-2">
                    </div>
                </div>
                <div class="form-control-label">分</div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">降園時間</div>
                    <div class="col-md-3">
                        <div class="d-flex is-invalid">
                            <input type="number" min="0" max="24" class="form-control mr-2">
                        </div>
                    </div>
                    <div class="form-control-label">時</div>
                    <div class="col-md-3">
                        <div class="d-flex is-invalid">
                            <input type="number" min="0" max="24" class="form-control mr-2">
                        </div>
                    </div>
                    <div class="form-control-label">分</div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">欠席</div>
                <div class="col-md-6">
                    <select class="form-control">
                        <option>コロナ欠席</option>
                        <option>コロナ欠席</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">遅刻</div>
                    <div class="col-md-4">
                        <div class="d-flex is-invalid">
                            <input type="number" min="0" max="24" class="form-control mr-2">
                        </div>
                    </div>
                    <div class="form-control-label">時</div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">延長</div>
                    <div class="col-md-4">
                        <div class="d-flex is-invalid">
                            <input type="number" min="0" max="24" class="form-control mr-2">
                        </div>
                    </div>
                    <div class="form-control-label">時</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </div>
</template>
<script>
import moment from 'moment-timezone';
import { mapState } from 'vuex';
import api, { apiErrorHandler } from '../../global/api';
import actionLoading from '../../mixin/actionLoading';
import { showSuccess } from '../../helpers/error';

    export default {
        watch: {
        },
        data() {
            return {
                errors: {
                    applicationClassId: null,
                    startTime: '',
                    endTime: '',
                    reason:  '',
                },
                formData: {
                    applicationClassId: 1,
                    applicationDate: '',
                    startTimeHour: '',
                    startTimeMin:  '',
                    endTimeHour:   '',
                    endTimeMin:    '',
                    reason:        '',
                    attendanceId: null,
                    isApproved: null,
                },
            }
        },
        methods: {

        }
    }
</script>
