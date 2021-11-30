<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <h3 class="card-title mb-0">休暇理由</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary" @click="addVacation()">
                                        新規登録
                                </button>
                            </div>
                            <div class="input-group w-auto">
                                <input type="search" class="form-control form-control-sm" placeholder="休暇理由">
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
                                            休暇理由
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            体調不良
                                        </td>
                                        <td style="width: 200px;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" name="display" :value="1">
                                                <label class="mr-2 mb-0">表示</label>
                                                <input type="radio" name="display" :value="2">
                                                <label class="mr-2 mb-0">非表示</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
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
                                            私用
                                        </td>
                                        <td style="width: 200px;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" name="display" :value="1">
                                                <label class="mr-2 mb-0">表示</label>
                                                <input type="radio" name="display" :value="2">
                                                <label class="mr-2 mb-0">非表示</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
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
                                            育児休暇
                                        </td>
                                        <td style="width: 200px;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" name="display" :value="1">
                                                <label class="mr-2 mb-0">表示</label>
                                                <input type="radio" name="display" :value="2">
                                                <label class="mr-2 mb-0">非表示</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
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
                                            慶弔休暇
                                        </td>
                                        <td style="width: 200px;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" name="display" :value="1">
                                                <label class="mr-2 mb-0">表示</label>
                                                <input type="radio" name="display" :value="2">
                                                <label class="mr-2 mb-0">非表示</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
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
                                            リフレッシュ休暇
                                        </td>
                                        <td style="width: 200px;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" name="display" :value="1">
                                                <label class="mr-2 mb-0">表示</label>
                                                <input type="radio" name="display" :value="2">
                                                <label class="mr-2 mb-0">非表示</label>
                                            </div>
                                        </td>
                                        <td class="align-middle">
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
                                                <div class="col-md-10">
                                                    <input type="text" name="office_number"
                                                        class="form-control"
                                                    placeholder="休暇理由">
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
                // form: new Form({
                //     id : '',
                //     date: '',
                //     type : 0,
                //     hour: '',
                //     minute: '',
                //     new_hour: '',
                //     new_minute: '',
                //     memo: '',
                // })
            }
        },
        methods: {
            addVacation(){
                $("#addNew").modal("show");
            }
        },
        mounted() {

        },
        created() {

        }
    }
</script>
