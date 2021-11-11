<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <h3 class="card-title mb-0">社員マスタ</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary" @click="addEmployee()">
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
                                class="table table-bordered table-master table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-grey text-white">
                                        <th>
                                            社員No
                                        </th>
                                        <th>
                                            氏　　名
                                        </th>
                                        <th>
                                            雇用形態
                                        </th>
                                        <th>
                                            在籍管理
                                        </th>
                                        <th rowspan="3"></th>
                                        <th rowspan="3"></th>
                                    </tr>
                                    <tr class="dark-grey text-white">
                                        <th>
                                            事業所
                                        </th>
                                        <th>
                                            エリア
                                        </th>
                                        <th>
                                            業種グループ
                                        </th>
                                        <th>
                                            本社グループ
                                        </th>
                                    </tr>
                                    <tr class="dark-grey text-white">
                                        <th colspan="2">
                                            メールアドレス
                                        </th>
                                        <th colspan="2">
                                            パスワード
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>A1234567</td>
                                        <td>阿部　一子</td>
                                        <td>正社員</td>
                                        <td>在籍中</td>
                                        <td rowspan="3" class="align-middle"><i class="fas fa-qrcode fa-lg"></i></td>
                                        <td rowspan="3" class="align-middle">
                                            <a href="#" class="mx-2">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>仙台本社</td>
                                        <td>東北エリア</td>
                                        <td>本社・本部Grp</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">xxxxxxxxxx@gmail.com</td>
                                        <td colspan="2">Abeitiko111</td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle pl-4">権限タイプ</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="authoriy" :value="1"/>
                                                    <div class="mb-0">admin</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="authoriy" :value="2"/>
                                                    <div class="mb-0">エリアmgr</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="authoriy" :value="3"/>
                                                    <div class="mb-0">事業所管理者</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="authoriy" :value="4"/>
                                                    <div class="mb-0">一般A</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="authoriy" :value="5"/>
                                                    <div class="mb-0">一般B</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">残業手当</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="zangyo" :value="1"/>
                                                    <div class="mb-0">月の所定労働時間超過分</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="zangyo" :value="2"/>
                                                    <div class="mb-0">1日8時間未満でもシフトを超えた分</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="zangyo" :value="3"/>
                                                    <div class="mb-0">1日に8時間以上勤務した分</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">給与控除</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="kyuyo" :value="1"/>
                                                    <div class="mb-0">月の所定労働時間の不足分</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="kyuyo" :value="2"/>
                                                    <div class="mb-0">シフト予定より勤務時間が少ない場合</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-middle">申請期間</td>
                                        <td colspan="5" class="align-middle text-left">
                                            <div class="align-middle d-flex">
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="request" :value="1"/>
                                                    <div class="mb-0">当日中</div>
                                                </div>
                                                <div class="d-flex align-items-center mr-3">
                                                    <input class="mr-1" type="radio" name="request" :value="2"/>
                                                    <div class="mb-0">当月中</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary float-right">CSV取込み</button>
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
                                                    <input type="text" name="office_number"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('hour') }"
                                                    placeholder="社員No">
                                                    <has-error :form="form" field="hour"></has-error>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="office_name"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('minute') }"
                                                    placeholder="氏名">
                                                    <has-error :form="form" field="minute"></has-error>
                                                </div>

                                                <div class="col-md-3">
                                                    <input type="radio" name="staff" :value="1">
                                                    <label class="ml-auto">正社員</label>
                                                    <input type="radio" name="staff" :value="2">
                                                    <label class="ml-auto">パート</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="radio" name="staff" :value="1">
                                                    <label class="ml-auto">在籍中</label>
                                                    <input type="radio" name="staff" :value="2">
                                                    <label class="ml-auto">退職</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option>仙台本社</option>
                                                        <option>仙台本社</option>
                                                        <option>仙台本社</option>
                                                        <option>仙台本社</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option>東北エリア</option>
                                                        <option>大阪エリア</option>
                                                        <option>九州エリア</option>
                                                        <option>沖縄エリア</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="no"
                                                        class="form-control" :class="{ 'is-invalid': form.errors.has('hour') }"
                                                    placeholder="No">
                                                    <has-error :form="form" field="hour"></has-error>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-control">
                                                        <option>8時間</option>
                                                        <option>7時間</option>
                                                        <option>6時間</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row align-items-center">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="email" placeholder="メールアドレス">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="email" placeholder="パスワード">
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
            addEmployee(){
                $("#addNew").modal("show");
            }
        },
        mounted() {

        },
        created() {

        }
    }
</script>
