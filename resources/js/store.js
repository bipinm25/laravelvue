import Axios from 'axios'
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

const store = new Vuex.Store({
    state : {
        conuter : 1000,
        dataChanged:false,
        deleteModalObj : {
            showDeleteModal: false,
            deleteUrl : '',
            data : null,
            deletingIndex: -1,
            isDeleted : false,

        },
        mainheader:'Dashboard',
        user: false,
        userPermission: null,
        addModalObj:{
            showAddModal: false,
            addUrl:'',
            isChanged:false,
            label:'',
            data:'',
            edit:false,
            id:0
        },
        allsession:null,
    },
    getters: {
        getheader(state){
            return state.mainheader
        },
        getCounter(state){
           return state.conuter
        },
        getDeleteModalObj(state){
            return state.deleteModalObj
        },

        getUserPermission(state){
            return state.userPermission
        },
        getAddModalObj(state){
            return state.addModalObj
        },
        getdataChanged(state){
            return state.dataChanged;
        },
        GET_SESSION(state){
            return state.allsession;
        }

    },

    mutations: {
        changeTheCounter(state, data){
            state.conuter += data
        },
        setDataChanged(state,data){           
            state.dataChanged = data
        },
        setHeader(state, data){
            state.mainheader = data;
        },
        setDeleteModal(state, data){
            const deleteModalObj = {
                showDeleteModal: false,
                deleteUrl : '',
                data : null,
                deletingIndex: -1,                
            }
            state.deleteModalObj = deleteModalObj
            state.addModalObj.isChanged=true;   
        },
        setDeletingModalObj(state, data){           
            state.deleteModalObj = data
        },
        setUpdateUser(state, data){
            state.user = data
        },
        setUserPermission(state, data){
            state.userPermission = data
        },

        setAddModal(state,data){
            const setaddModalObj = {
                showAddModal: data,
                addUrl:'',
                isChanged:false,
                label:'',
                data:'',
                edit:false,
                id:0
            }
            state.addModalObj = setaddModalObj
        },

        typeAddModalObj(state,data){           
            state.addModalObj = data
        },

        SET_SESSION(state, data){
            //console.log(data);
            state.allsession = data;
        }

    },



    actions :{
        changeCounterAction({commit}, data){
            commit('changeTheCounter', data)
        },

        async loadSession({commit}){
            await axios.get('/getsession').then((res)=>{
                //console.log(res.data);
                commit('SET_SESSION',res.data);
            })
        }

    }


});

//store.dispatch('loadSession');

export default store