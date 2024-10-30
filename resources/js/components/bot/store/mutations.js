export const setRegisterBotAll = (state, data) => {
    state.bot.records = data;
};

export const setRegisterBot = (state, data) => {
    state.bot.record = data;
};

export const setDetailTitle = (state, data) => {
    state.detailTitle = data;
};

export const setRegisterFlow = (state, data) => {
    state.flow.record = data;
};

export const setRegisterValidateBotName = (state,data) => {
    state.bot.validateBotName = data;
}

export const setIsUpdate= (state, data) => {
    state.isUpdate = data;
};

export const setAddress = (state, data) => {
    state.bot.address = data;
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

export const setShowModalFormDetail = (state, show) => {
    state.showModalFormDetail = show;
};

export const resetRegisterBot = (state) => {
    setRegisterBot(state, state.bot.initialValues);
};

export const setSegisterBotSearch = (state, data) => {
    state.search = data;
};
