<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header calendar-title">
                        <div class="row">
                            <div class="col-md-3">
                                <h3 class="card-title mb-0">保育システム</h3>
                            </div>
                            <div class="col-md-3">
                                山田　光子
                            </div>
                            <div class="col-md-3">
                                <select class="form-control">
                                    <option>2022-1</option>
                                    <option>2022-2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table
                                class="table table-bordered table-striped table-calendar table-head-fixed table-hover mb-0"
                            >
                                <!-- <thead class="text-center">
                                    <tr class="dark-yellow text-white">
                                        <th>
                                            日付
                                        </th>
                                        <th>
                                            従業員枠企業名
                                        </th>
                                    </tr>
                                </thead> -->
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            1日[月]
                                        </td>
                                        <td width="13%">
                                            2日[火]
                                        </td>
                                        <td width="13%">
                                            3日[火]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            1日[月]
                                        </td>
                                        <td width="13%">
                                            2日[火]
                                        </td>
                                        <td width="13%">
                                            3日[火]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody class="text-center">
                                    <tr class="dark-yellow">
                                        <td width="5%">
                                            日付
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            -
                                        </td>
                                        <td width="13%">
                                            1日[月]
                                        </td>
                                        <td width="13%">
                                            2日[火]
                                        </td>
                                        <td width="13%">
                                            3日[火]
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            登園
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            -
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            降園
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">

                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="24" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                </div>
                                                <span class="p-1">:</span>
                                                <div>
                                                    <input type="number" class="form-control p-1" min="0" max="60" :class="{'is-invalid' : errors.startTime}" @change="errors.startTime = null">
                                                    <span v-if="errors.startTime" class="error invalid-feedback">
                                                        {{ errors.startTime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            欠席
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="align-middle">
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
            errors: [],
        }
    },
    methods: {
        childcarePlan() {
            this.$router.push('childcare-plan');
        }
    }
};
</script>
