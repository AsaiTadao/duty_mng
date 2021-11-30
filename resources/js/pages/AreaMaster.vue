<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">エリアマスタ</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary" @click="addArea()">
                                        新規登録
                                </button>
                            </div>
                            <div class="input-group w-auto">
                                <input type="search" class="form-control form-control-sm" placeholder="エリア名">
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
                                            エリア名
                                        </th>
                                        <th>
                                            所轄事業所
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            大阪エリア
                                        </td>
                                        <td>
                                            天王寺ひよこ園、日本橋ひよこ園、日本橋園
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
                                            九州エリア
                                        </td>
                                        <td>

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
                                            沖縄エリア
                                        </td>
                                        <td>

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
                                            <div class="form-row">
                                                <div class="col-md-3">
                                                    <input type="text" name="office_number" class="form-control" placeholder="エリア名入力">
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-6">
                                                    <div class="form-row">
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="1">
                                                            <label class="ml-auto">天王寺ひよこ園</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="2">
                                                            <label class="ml-auto">日本橋ひよこ園</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="3">
                                                            <label class="ml-auto">日本橋園</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="1">
                                                            <label class="ml-auto">梅田あひる園</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="2">
                                                            <label class="ml-auto">福岡かえる園</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="3">
                                                            <label class="ml-auto">福岡すずめ園</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="1">
                                                            <label class="ml-auto">新大阪支店</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="2">
                                                            <label class="ml-auto">心斎橋支店</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="checkbox" name="type" :value="3">
                                                            <label class="ml-auto">沖縄本部</label>
                                                        </div>
                                                    </div>
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
            addArea(){
                $("#addNew").modal("show");
            }
        },
        mounted() {

        },
        created() {

        }
    }
</script>
<style scoped>
.calendar-center {
    display: flex;
    justify-content: center;
    align-items: center;
}
.calendar-title {
    display: flex;
    align-items: center;
}
</style>
