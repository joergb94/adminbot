export const getRegisterBotAll = (state) => {
    return state.bot.records;
};

export const getInitialValues = (state) => {
    return state.bot.initialValues;
};
export const getFlowInitialValues = (state) => {
    return state.flow.initialValues;
};
export const getInitialValuesName = (state) => {
    return state.bot.initialValuesName;
};

export const getRegisterBot = (state) => {
    return state.bot.record;
};

export const getRegisterFlow = (state) => {
    return state.flow.record;
};

export const getRegisterValidateBotName = (state) => {
    return state.bot.validateBotName;
};

export const getAddress = (state) => {
    return state.bot.address;
};

export const getTitle = (state) => {
    return state.title;
};

export const getDetailTitle = (state) => {
    return state.detailTitle;
};


export const getIcon = (state) => {
    return state.icon;
};

export const getSubTitle = (state) => {
    return state.bot.subTitle;
};

export const getBreadcrumb = (state) => {
    return state.breadcrumb;
};

export const getShowMainProgressBar = (state) => {
    return state.showMainProgressBar;
};

export const getShowFormProgressBar = (state) => {
    return state.showFormProgressBar;
};

export const getShowLoading = (state) => {
    return state.showLoading;
};

export const getShowModalForm = (state) => {
    return state.showModalForm;
};

export const getShowModalFormDetail = (state) => {
    return state.showModalFormDetail;
};

export const getModuleName = (state) => {
    return state.moduleName;
};

export const getRegisterBotSearch = (state) => {
    return state.search;
};

export const getIsUpdate= (state, data) => {
    return state.isUpdate;
};