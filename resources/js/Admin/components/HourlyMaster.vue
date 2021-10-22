<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <h3 class="card-title mb-0">時給テーブルマスタ</h3>
                        <h3 class="card-title mb-0 ml-5">ラテラル保育園</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary" @click="addHourly()">
                                        新規登録
                                </button>
                            </div>
                            <div class="input-group w-auto">
                                <input type="search" class="form-control form-control-sm" placeholder="事業所名">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-striped table-master table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-grey text-white">
                                        <th>
                                            時間帯名
                                        </th>
                                        <th>
                                            開始
                                        </th>
                                        <th>
                                            終了
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            A時間帯
                                        </td>
                                        <td>
                                            7:30
                                        </td>
                                        <td>
                                            10:00
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            B時間帯
                                        </td>
                                        <td>
                                            8:00
                                        </td>
                                        <td>
                                            16:00
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            C時間帯
                                        </td>
                                        <td>
                                            16:00
                                        </td>
                                        <td>
                                            17:30
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            D時間帯
                                        </td>
                                        <td>
                                            17:30
                                        </td>
                                        <td>
                                            19:00
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            E時間帯
                                        </td>
                                        <td>
                                            19:00
                                        </td>
                                        <td>
                                            20:00
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                            <div class="modal-dialog modal-huge" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">新規登録</h5>
                                        <!-- <h5 class="modal-title" v-show="editmode">再申請</h5> -->
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option>ラテラル保育園</option>
                                                        <option>仙台本社</option>
                                                        <option>仙台本社</option>
                                                        <option>仙台本社</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="time-zone" placeholder="時間帯名入力">
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-1">
                                                    <input v-model="form.hour" type="number" name="hour"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('hour') }">
                                                    <has-error :form="form" field="hour"></has-error>
                                                </div>
                                                :
                                                <div class="col-md-1">
                                                    <input v-model="form.minute" type="number" name="minute"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('minute') }">
                                                    <has-error :form="form" field="minute"></has-error>
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-1">
                                                    <input v-model="form.new_hour" type="number" name="new_hour"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('new_hour') }">
                                                    <has-error :form="form" field="new_hour"></has-error>
                                                </div>
                                                :
                                                <div class="col-md-1">
                                                    <input v-model="form.new_minute" type="number" name="new_minute"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('new_minute') }">
                                                    <has-error :form="form" field="new_minute"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                        <button type="submit" class="btn btn-primary">登録</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                editmode: false,
                currentDate: new Date(),
                days: [],
                attends : [],
                requests : [],
                form: new Form({
                    id : '',
                    date: '',
                    type : 0,
                    hour: '',
                    minute: '',
                    new_hour: '',
                    new_minute: '',
                    memo: '',
                })
            }
        },
        methods: {
            addHourly(){
                $("#addNew").modal("show");
            }
        },
        mounted() {

        },
        created() {

        }
    }
</script>
