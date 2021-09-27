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
                                            B時間帯
                                        </td>
                                        <td>
                                            8:00
                                        </td>
                                        <td>
                                            16:00
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
                                            C時間帯
                                        </td>
                                        <td>
                                            16:00
                                        </td>
                                        <td>
                                            17:30
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
                                            D時間帯
                                        </td>
                                        <td>
                                            17:30
                                        </td>
                                        <td>
                                            19:00
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
                                            E時間帯
                                        </td>
                                        <td>
                                            19:00
                                        </td>
                                        <td>
                                            20:00
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
