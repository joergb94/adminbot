import { createStore } from 'vuex';
import storeLogin from '../components/login/store'
import storeRegister from '../components/register/store'
import storeBoot from '../components/boot/store';
import registers from '../components/registers/store';

const store = createStore({
    modules: {
        registers,
        storeLogin,
        storeRegister,
        storeBoot,
    },
});

export default store;
