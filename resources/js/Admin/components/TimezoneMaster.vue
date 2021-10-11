<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <h3 class="card-title mb-0">時間帯マスタ</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary" @click="addTimeZone()">
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
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="full-time-tab" data-toggle="pill" href="#this-year-table" role="tab" aria-controls="this-year-table" aria-selected="true">正社員</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="short-time-tab" data-toggle="pill" href="#next-year-table" role="tab" aria-controls="next-year-table" aria-selected="false">時短社員</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="part-time-tab" data-toggle="pill" href="#next-year-table" role="tab" aria-controls="next-year-table" aria-selected="false">パート</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="this-year-table" role="tabpanel" aria-labelledby="this-year-tab">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                            </div>
                            <div class="tab-pane fade" id="next-year-table" role="tabpanel" aria-labelledby="next-year-tab">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                            </div>
                            <div class="tab-pane fade" id="next-year-table" role="tabpanel" aria-labelledby="next-year-tab">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                                            <tr draggable="true" @dragstart="start()"  @dragover="dragover()">
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
                            </div>
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
                                                <div class="col-md-3">
                                                    <div class="d-flex align-items-center">
                                                        <input type="radio" name="staff" :value="1">
                                                        <label class="mr-2 mb-0">正社員</label>
                                                        <input type="radio" name="staff" :value="2">
                                                        <label class="mr-2 mb-0">時短社員</label>
                                                        <input type="radio" name="staff" :value="3">
                                                        <label class="mr-2 mb-0">パート</label>
                                                    </div>
                                                </div>
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
                row: null,
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
            addTimeZone(){
                $("#addNew").modal("show");
            },
            start(){
                this.row = event.target;
            },
            dragover(){
                var e = event;
                e.preventDefault();

                let children= Array.from(e.target.parentNode.parentNode.children);

                if(children.indexOf(e.target.parentNode)>children.indexOf(this.row))
                    e.target.parentNode.after(this.row);
                else
                    e.target.parentNode.before(this.row);
            }
        },
        mounted() {

        },
        created() {
        }
    }
</script>
