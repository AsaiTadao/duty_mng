import api, { apiErrorHandler } from "../global/api"

export default {
    namespaced: true,
    state: {
        applicationClasses: [],
        reasonForVacations: [],
        employmentStatuses: [],
        restDeductions: []
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
            const { applicationClasses, reasonForVacations, employmentStatuses, restDeductions } = payload;
            state.applicationClasses = applicationClasses;
            state.reasonForVacations = reasonForVacations;
            state.employmentStatuses = employmentStatuses;
            state.restDeductions = restDeductions;
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
