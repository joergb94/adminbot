import { findRegistersService } from '../services/RegistersService';

export const findRegistersAllRequest = ({ commit }, { registers, toast }) => {
    findRegistersService(
        registers,
        ({ data }) => {
            commit('setRegistersAll', data.records);
        },
        (errors) => {
            if (toast) {
                toast('error', 'Confirmacion.', errors.response.data.message);
            }
        }
    );
};

export const findRegistersAllFromBladeRequest = ({ commit }, { registers, toast }) => {
            commit('setRegistersBladeAll', registers);
};
