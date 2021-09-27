<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">事業所マスタ</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary">
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
                                class="table table-bordered table-striped table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="heavy-green">
                                        <th>
                                            事業所No
                                        </th>
                                        <th>
                                            事業所名
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            A123
                                        </td>
                                        <td>
                                            ラテラルキッズ本社
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2" @click="requestModal()">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#" @click="requestModal()">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            B456
                                        </td>
                                        <td>
                                            いずみく保育園
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2" @click="requestModal()">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#" @click="requestModal()">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            C789
                                        </td>
                                        <td>
                                            沖縄本部
                                        </td>
                                        <td>
                                            <a href="#" class="mx-2" @click="requestModal()">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#" @click="requestModal()">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
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
