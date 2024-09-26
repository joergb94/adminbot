import {
    signInService
} from '../services/loginService.js';

export const moduleRequest = async ({ commit }, { action, params, toast }) => {
    let response = null;
    commit('setShowLoading', true);
    try {
        switch (action) {
            case 'signInRequest':
                response = await signInService(params);
                window.location.href = "/cliente/inicio";
                break;
        }
    } catch (errors) {
        const { error } = errors.response.data.errors;
        const { url } = errors.response.config;
        const errorMessage = errors.response.data.errors;
        
        if (error) {
            toast('error', 'Error.', error);
        } else {
            errorMessage.split('*').forEach(part => {
                if (part.trim()) {
                    toast('error', 'Error.', part);
                }
            });
        }
        commit('setShowLoading', false);
    }
};
