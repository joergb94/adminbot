import {
    signUpService
} from '../services/registerService.js';

export const moduleRequest = async ({ commit }, { action, params, toast }) => {
    let response = null;
    commit('setShowLoading', true);
    try {
        switch (action) {
            case 'signUpRequest':
                response = await signUpService(params);
                window.location.href = "/cliente/entrar";
                break;
        }
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
        commit('setShowLoading', false);
    }
};
