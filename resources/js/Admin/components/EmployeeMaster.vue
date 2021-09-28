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
                                            所　　属
                                        </th>
                                        <th>
                                            権　　限
                                        </th>
                                        <th rowspan="3"></th>
                                        <th rowspan="3"></th>
                                    </tr>
                                    <tr class="dark-grey text-white">
                                        <th colspan="2">
                                            住　　　　　所
                                        </th>
                                        <th colspan="2">
                                            電話番号
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
                                        <td>AAAAA保育園</td>
                                        <td>スタッフ</td>
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
                                        <td colspan="2">宮城県仙台市泉区1-2-3</td>
                                        <td colspan="2">090-1234-5678</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">xxxxxxxxxx@gmail.com</td>
                                        <td colspan="2">Abeitiko111</td>
                                    </tr>
                                    <tr>
                                        <td>B8912345</td>
                                        <td>伊藤　二子</td>
                                        <td>BBBBB保育園</td>
                                        <td></td>
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
                                        <td colspan="2">宮城県仙台市青葉区4-5-6</td>
                                        <td colspan="2">080-9876-5432</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">yyyyyyyyyy@i.softbank.jp</td>
                                        <td colspan="2">Itolucky777</td>
                                    </tr>
                                    <tr>
                                        <td>C678912</td>
                                        <td>上野　三子</td>
                                        <td>CCCCC保育園</td>
                                        <td>スタッフ</td>
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
                                        <td colspan="2">宮城県仙台市太白区7-8-9</td>
                                        <td colspan="2">090-5432-6789</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">zzzzzzzzzz@docomo.co.jp</td>
                                        <td colspan="2">Uenowin333</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary float-right">CSV取込み</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
