import {
    findRegisterEntityAllService,
    findPostalCodeService,
    findRegisterEntityByIdService,
    storeRegisterEntityService,
    updateRegisterEntityService,
    findRegisterEntityByRFCService
} from '../services/EntityService.js';

export const moduleRequest = async ({ commit }, { action, params, toast }) => {
    let response = null;
    commit('setShowMainProgressBar', true);
    commit('setShowLoading', true);
    try {
        switch (action) {
            case 'findRegisterEntityAllBladeRequest':
                commit('setRegisterEntityAll', params);
                commit('setShowLoading', false);
                break;
            case 'findRegisterEntityAllRequest':
                response = await findRegisterEntityAllService();
                commit('setRegisterEntityAll', response.data.records);
                commit('setShowLoading', false);
                break;
            case 'findRegisterEntityByIdRequest':
                response = await findRegisterEntityByIdService(params);
                commit('setRegisterEntity', response.data.record );
                commit('setShowModalForm', true);
                break;
        }
        commit('setShowMainProgressBar', false);
    } catch (errors) {
        
        commit('setShowMainProgressBar', false);
    }
};

//--- state modal request --------------------------------
const thenModalRequest = (commit, dispatch, toast) => {
    commit('setShowModalForm', false);
    dispatch('moduleRequest', { action: 'findRegisterEntityAllRequest', params: null, toast });
};

export const modalRequest = async ({ commit, dispatch }, { action, params, toast }) => {
    let response = null;
    commit('setShowFormProgressBar', true);
    try {
        switch (action) {
            case 'storeRegisterEntityRequest':
                await storeRegisterEntityService(params);
                thenModalRequest(commit, dispatch, toast);
                break;
            case 'updateRegisterEntityRequest':
                await updateRegisterEntityService(params);
                thenModalRequest(commit, dispatch, toast);
                break;
            case 'findPostalCodeRequest':
                response = await findPostalCodeService(params);
                commit('setAddress', response.data);
            break;
            case 'findRegisterEntityByRFCRequest':
                response = await findRegisterEntityByRFCService(params);
                commit('setRegisterEntity', response.data.record );
            break;
        }
        commit('setShowFormProgressBar', false);
    } catch (errors) {
        const { error } = errors.response.data.errors;
        const errorMessage = errors.response.data.errors;
        
        if (error) {
            toast('error', 'Error.', error);
        } else {
            Object.values(errorMessage).forEach(errorArray => {
                errorArray.forEach(errorMsg => {
                  if (errorMsg.trim()) {
                    toast('error', 'Error.', errorMsg);
                  }
                });
            });
        }
        commit('setShowFormProgressBar', false);
    }
};

//--- state without action request --------------------------------
export const showModalFormState = ({ commit }, show) => {
    commit('setShowModalForm', show);
};

export const resetRegisterEntityState = ({ commit }) => {
    commit('resetRegisterEntity');
};

export const registerEntitySearch = ({ commit }) => {
    commit('setSegisterEntitySearch');
};
