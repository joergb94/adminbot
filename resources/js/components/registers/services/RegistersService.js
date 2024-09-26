import axiosClient from "@/utils/axiosClient.js";

export const findRegistersService = (params, responseCallback, catchCallback) => {    
    const request = {
        params: { register: params },
    };
    axiosClient.get('/register', request).then(responseCallback).catch(catchCallback);
};
