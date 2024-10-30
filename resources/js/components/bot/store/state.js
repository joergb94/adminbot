export default {
    title: 'Mis Bots',
    detailTitle:'',
    icon: 'pi pi-comments',
    showLoading: false,
    showFormProgressBar: false,
    showModalForm: false,
    showModalReport: false,
    isUpdate:false,
    bot: {
        records: [],
        record: {},
        validateBotName:null,
        address: {},
        initialValues: {
            name: '',
            content: '',
            flows:[]
        },
        initialValuesName: {name: '',},
    },
    flow:{
        record:{},
        initialValues:{
            name: '',
            description:'',
        }
    }
};
