import { createStore } from 'vuex';
import storeLogin from '../components/login/store'
import storeRegister from '../components/register/store'
import storeBot from '../components/bot/store';
import registers from '../components/registers/store';

const store = createStore({
    modules: {
        registers,
        storeLogin,
        storeRegister,
        storeBot,
    },
});

export default store;
