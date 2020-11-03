<template>
    <div>
        <Modal
        :value="getAddModalObj.showAddModal"
        :mask-closable="false"
		:closable="false"
         width="360">
            <p slot="header" style="text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>Add {{getAddModalObj.label}}</span>
            </p>
            <div style="text-align:center">
               <form role="form">
                   <input type="hidden" v-if="getAddModalObj.edit" v-model="getAddModalObj.id">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{getAddModalObj.label}}</label>
                        <input type="text"  v-model="fieldValue" class="form-control" :placeholder="getAddModalObj.label">
                    </div>
                    </div>
                </form>
            </div>
            <div slot="footer">
                <Button type="default" size="large" @click="closeModal" >Close</Button>
                <Button type="error" @click.prevent="saveForm" size="large" >Save</Button>
            </div>
        </Modal>
    </div>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
    data(){
        return {
            isDeleing : false,
        }
    },
    methods:{        
        closeModal(){           
            this.$store.commit('setAddModal', false)            
        },
        saveForm(){
            var data = {'fieldvalue':this.fieldValue}
            if(this.getAddModalObj.edit){
                data['id'] = this.getAddModalObj.id
            }
            axios.post(this.getAddModalObj.addUrl, data).then((data)=>{
               if(data.status == 200){
                   this.closeModal();
                   this.$store.commit('setDataChanged', true)  
                   this.$toast.success("Saved", {
                                    position: "bottom-right",
                                    timeout: 3000,
                                    closeOnClick: true,
                                });                   
               }
           });

        }
    },
      computed : {
        ...mapGetters(['getAddModalObj']),
        fieldValue:{
            set(value) {
               
                const setaddModalObj = {
                showAddModal: true,
                addUrl:this.getAddModalObj.addUrl,
                isChanged:false,
                label:this.getAddModalObj.label,
                data:value,
                edit:this.getAddModalObj.edit,
                id:this.getAddModalObj.id
            }
             this.$store.commit("typeAddModalObj", setaddModalObj);     
            },
            get() {
                return this.getAddModalObj.data
            }
        }
    }
}
</script>