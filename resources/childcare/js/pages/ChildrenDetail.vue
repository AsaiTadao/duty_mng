<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="card-title mb-0">保育システム</h3>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat">検索</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="align-middle" :value="1" v-model="retiredDisplay">
                                    <div class="ml-1">退園児を含む</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-sm btn-primary float-right" @click="childcarePlan()">
                                    託児計画作成
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary float-right mr-2">
                                    <i class="fas fa-qrcode fa-lg"></i>
                                    QRコード発行
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-children table-hover mb-0"
                            >
                                <thead class="text-center">
                                    <tr class="dark-brown text-white">
                                        <th>
                                            園児ID
                                        </th>
                                        <th>
                                            園児氏名
                                        </th>
                                        <th>
                                            性別
                                        </th>
                                        <th>
                                            生年月日
                                        </th>
                                        <th>
                                            年齢
                                        </th>
                                        <th>
                                            クラス
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            000123
                                        </td>
                                        <td>
                                            山田　太郎
                                        </td>
                                        <td>
                                            男
                                        </td>
                                        <td>
                                            2021年3月1日
                                        </td>
                                        <td>
                                            0歳7ヶ月
                                        </td>
                                        <td>
                                            0歳児
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table
                                class="table table-bordered table-children table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-brown text-white">
                                        <th>
                                            入園日
                                        </th>
                                        <th>
                                            退園日
                                        </th>
                                        <th>
                                            メールアドレス
                                        </th>
                                        <th>
                                            パスワード
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            2021年10月1日
                                        </td>
                                        <td>
                                            2021年10月1日
                                        </td>
                                        <td>
                                            oyaji@gmail.com
                                        </td>
                                        <td>
                                            Ha1E3syZ
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div class="pager-wrapper">
                                <pagination v-model="pager.current" :records="pager.total" :per-page="pager.size" :options="{texts: pager.texts}" @paginate="getUsers"/>
                                <div class="pager-per-page">
                                    <select class="form-control" @change="onPerPageChange">
                                        <option v-for="(page, index) in perPages" :key="index" :value="page">{{ page }}</option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                        <div class="p-0 mb-1">
                            <table
                                class="table table-bordered table-hover mb-0"
                            >
                                <tbody class="text-center">
                                    <tr>
                                        <td class="light-blue align-middle">
                                            備考欄
                                        </td>
                                        <td class="p-0 bg-white">
                                            <input class="textarea-fit" placeholder="テキスト入力" maxlength="20"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td rowspan="3" class="text-center text-white dark-pink align-middle">
                                            登園予定
                                        </td>
                                        <td class="light-pink text-center">火曜・水曜・木曜</td>
                                        <td class="light-pink text-center">8:00～17:00</td>
                                    </tr>
                                    <tr class="light-pink text-center">
                                        <td>月曜・金曜</td>
                                        <td>9:00～18:00</td>
                                    </tr>
                                    <tr class="light-pink text-center">
                                        <td>ー</td>
                                        <td>ー</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-registry table-hover mb-0"
                            >
                                <thead class="text-center">
                                    <tr class="dark-yellow text-white">
                                        <th>
                                            区分
                                        </th>
                                        <th>
                                            従業員枠企業名
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            従業員枠（自社）
                                        </td>
                                        <td>
                                            （株）仙台商事
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table
                                class="table table-bordered table-registry table-hover"
                            >
                                <thead class="text-center">
                                    <tr class="dark-yellow text-white">
                                        <th>
                                            無償化
                                        </th>
                                        <th>
                                            支給認定証
                                        </th>
                                        <th>
                                            支給認定証有効期限
                                        </th>
                                        <th>
                                            非課税世帯
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            対象
                                        </td>
                                        <td>
                                            有り
                                        </td>
                                        <td>
                                            2022年1月1日
                                        </td>
                                        <td>
                                            〇
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="float-right d-flex align-items-center mt-2">
                            <button class="btn btn-primary float-right mr-2" @click="presentManagement()">登降園管理</button>
                            <button class="btn btn-primary float-right">編集</button>
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
            retiredDisplay: false,
        }
    },
    methods: {
        childcarePlan() {
            this.$router.push('childcare-plan');
        },
        presentManagement() {
            this.$router.push('present-management');
        }
    }
};
</script>
