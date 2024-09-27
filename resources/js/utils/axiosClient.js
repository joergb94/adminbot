import axios from 'axios';

axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.headers.common['XSRF-TOKEN'] = document.querySelector('[name="csrf-token"]').content;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; 

console.log(import.meta.env.VITE_APP_API_BASE_URL);

const axiosClient = axios.create({ baseURL: import.meta.env.VITE_APP_API_BASE_URL});

axiosClient.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        switch (error.response.status) {
            case 405:
            case 400:
            case 401:
                // setTimeout(() => {
                //     window.location.href = '/#/';
                //     setTimeout(() => {
                //         window.location.reload();
                //     }, 500);
                // }, 3000);
                break;
            case 403:
                break;
            case 404:
                RemoveCookies();
                break;
            case 500:
                alert('Ocurrio un Error, Comuniquese con el area de sistemas');
                //window.location.href = window.location;
                break;
        }
        return Promise.reject(error);
    }
);

export default axiosClient;