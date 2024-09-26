export const setRegisterEntityAll = (state, data) => {
    state.entity.records = data;
};

export const setRegisterEntity = (state, data) => {
    state.entity.record = data;
};

export const setIsUpdate= (state, data) => {
    state.isUpdate = data;
};

export const setAddress = (state, data) => {
    state.entity.address = data;
};

export const setShowMainProgressBar = (state, show) => {
    state.showMainProgressBar = show;
};

export const setShowFormProgressBar = (state, show) => {
    state.showFormProgressBar = show;
};

export const setShowLoading = (state, show) => {
    state.showLoading = show;
};

export const setShowModalForm = (state, show) => {
    state.showModalForm = show;
};

export const setShowModalReport = (state, show) => {
    state.showModalReport = show;
};

export const resetRegisterEntity = (state) => {
    setRegisterEntity(state, state.entity.initialValues);
};

export const setSegisterEntitySearch = (state, data) => {
    state.search = data;
};
