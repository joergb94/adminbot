export const getRegisterEntityAll = (state) => {
    return state.entity.records;
};

export const getInitialValues = (state) => {
    return state.entity.initialValues;
};
export const getInitialValuesRFC = (state) => {
    return state.entity.initialValuesRFC;
};

export const getRegisterEntity = (state) => {
    return state.entity.record;
};

export const getAddress = (state) => {
    return state.entity.address;
};

export const getTitle = (state) => {
    return state.title;
};

export const getSubTitle = (state) => {
    return state.entity.subTitle;
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

export const getShowModalReport = (state) => {
    return state.showModalReport;
};

export const getModuleName = (state) => {
    return state.moduleName;
};

export const getRegisterEntitySearch = (state) => {
    return state.search;
};

export const getIsUpdate= (state, data) => {
    return state.isUpdate;
};