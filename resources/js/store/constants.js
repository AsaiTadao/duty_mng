import api, { apiErrorHandler } from "../global/api"

export default {
    namespaced: true,
    state: {
        applicationClasses: [],
        reasonForVacations: [],
        employmentStatuses: [],
        restDeductions: [],

        overtimePayOptions: [],
        salaryDeductionOptions: [],
        applicationDeadlineOptions: [],
        applicationStatusOptions: []
    },
    getters: {
        getApplicationClasses(state) {
            return state.applicationClasses;
        },
        getReasonForVacations(state) {
            return state.reasonForVacations;
        },
        getEmploymentStatuses(state) {
            return state.employmentStatuses;
        }
    },
    mutations: {
        setConstants(state, payload) {
            const {
                applicationClasses,
                reasonForVacations,
                employmentStatuses,
                restDeductions,

                overtimePayOptions,
                salaryDeductionOptions,
                applicationDeadlineOptions,
                applicationStatusOptions
            } = payload;
            state.applicationClasses = applicationClasses;
            state.reasonForVacations = reasonForVacations;
            state.employmentStatuses = employmentStatuses;
            state.restDeductions = restDeductions;
            state.salaryDeductionOptions = salaryDeductionOptions;
            state.applicationDeadlineOptions = applicationDeadlineOptions;
            state.applicationStatusOptions = applicationStatusOptions;
            state.overtimePayOptions = overtimePayOptions
            return
        }
    },
    actions: {
        fetchConstants(context) {
            api.get('constants')
                .then(response => {
                    context.commit('setConstants', response);
                })
                .catch(e => {
                    apiErrorHandler(e);
                })
        }
    }
}
