import {
    findRegisterBotAllService,
    findRegisterBotByIdService,
    storeRegisterBotService,
    updateRegisterBotService,
    turnOnOrOffRegisterBotService,
    findRegisterBotByNameService,
    deleteRegisterBotService
} from '../services/BotService.js';

export const moduleRequest = async ({ commit }, { action, params, toast }) => {
    let response = null;
    commit('setShowMainProgressBar', true);
    commit('setShowLoading', true);
    try {
        switch (action) {
            case 'findRegisterBotAllBladeRequest':
                commit('setRegisterBotAll', params);
                commit('setShowLoading', false);
                break;
            case 'findRegisterBotAllRequest':
                response = await findRegisterBotAllService();
                commit('setRegisterBotAll', response.data.records);
                commit('setShowLoading', false);
                break;
            case 'findRegisterBotByIdRequest':
                response = await findRegisterBotByIdService(params);
                commit('setRegisterBot', response.data.record );
                commit('setShowModalForm', true);
                break;
            case 'turnOnOrOffRegisterBotRequest':
                    await turnOnOrOffRegisterBotService(params);
                    response = await findRegisterBotAllService();
                    commit('setRegisterBotAll', response.data.records);
                    commit('setShowLoading', false);
            break;
            case 'deleteRegisterBotRequest':
                    await deleteRegisterBotService(params);
                    response = await findRegisterBotAllService();
                    commit('setRegisterBotAll', response.data.records);
                    commit('setShowLoading', false);
            break;
            case 'findRegisterBotByIdDetailRequest':
                    response = await findRegisterBotByIdService(params);
                    commit('setRegisterBot', response.data.record );
                    console.log(response.data.record.name)
                    commit('setDetailTitle', 'Informacion de '+response.data.record.name );
                    commit('setShowModalFormDetail', true);
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
    dispatch('moduleRequest', { action: 'findRegisterBotAllRequest', params: null, toast });
};

export const modalRequest = async ({ commit, dispatch }, { action, params, toast }) => {
    let response = null;
    commit('setShowFormProgressBar', true);
    try {
        switch (action) {
            case 'storeRegisterBotRequest':
                await storeRegisterBotService(params);
                thenModalRequest(commit, dispatch, toast);
                break;
            case 'updateRegisterBotRequest':
                await updateRegisterBotService(params);
                thenModalRequest(commit, dispatch, toast);
                break;
            case 'findRegisterBotByNameRequest':
                response = await findRegisterBotByNameService(params);
                commit('setRegisterValidateBotName', response.data.record );
            break;
            case 'AddFlowRequest':
                console.log(params)
                commit('setRegisterFlow',params);
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
        commit('setRegisterValidateBotName', null);
        commit('setShowFormProgressBar', false);
    }
};

//--- state without action request --------------------------------
export const showModalFormState = ({ commit }, show) => {
    commit('setShowModalForm', show);
    commit('setRegisterValidateBotName', null);
};

export const showModalFormDetailState = ({ commit }, show) => {
    commit('setShowModalFormDetail', show);
};

export const resetRegisterBotState = ({ commit }) => {
    commit('resetRegisterBot');
};

export const registerBotSearch = ({ commit }) => {
    commit('setSegisterBotSearch');
};
