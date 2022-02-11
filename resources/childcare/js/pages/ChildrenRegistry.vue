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
                                    新規登録
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
                                            <input class="form-control"/>
                                        </td>
                                        <td>
                                            <input class="form-control"/>
                                        </td>
                                        <td>
                                            <select class="form-control">
                                                <option>男</option>
                                                <option>女</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60">
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
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
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60">
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60">
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-control"/>
                                        </td>
                                        <td>
                                            <input class="form-control"/>
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
                                            従業員枠企業所名
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" class="align-middle" :value="1" name="district">
                                                <div class="ml-1 mr-4">従業員枠（自社）</div>
                                                <input type="radio" class="align-middle" :value="2" name="district">
                                                <div class="ml-1 mr-4">従業員枠（他社）</div>
                                                <input type="radio" class="align-middle" :value="3" name="district">
                                                <div class="ml-1 mr-4">他域枠（通常）</div>
                                                <input type="radio" class="align-middle" :value="4" name="district">
                                                <div class="ml-1 mr-4">他域枠（弾力）</div>
                                            </div>
                                        </td>
                                        <td>
                                            <input class="form-control"/>
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
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" class="align-middle" :value="1" name="district">
                                                <div class="ml-1 mr-4">対象</div>
                                                <input type="radio" class="align-middle" :value="2" name="district">
                                                <div class="ml-1 mr-4">対象外</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" class="align-middle" :value="1" name="district">
                                                <div class="ml-1 mr-4">有り</div>
                                                <input type="radio" class="align-middle" :value="2" name="district">
                                                <div class="ml-1 mr-4">無し</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">年</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60">
                                                </div>
                                                <span class="p-1">月</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24">
                                                </div>
                                                <span class="p-1">日</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <input type="radio" class="align-middle" :value="1" name="district">
                                                <div class="ml-1 mr-4">対象</div>
                                                <input type="radio" class="align-middle" :value="2" name="district">
                                                <div class="ml-1 mr-4">対象外</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-0">
                            <table
                                class="table table-bordered table-hover mb-0"
                            >
                                <tbody class="text-center">
                                    <tr>
                                        <td class="light-blue align-middle">
                                            備考欄
                                        </td>
                                        <td class="p-0 bg-white">
                                            <textarea class="textarea-fit">

                                            </textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right d-flex align-items-center mt-2">
                            <button class="btn btn-primary float-right">登録</button>
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
