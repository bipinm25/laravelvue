<template>
    <div>
        <!-- delete alert modal -->
        <Modal
        :value="getDeleteModalObj.showDeleteModal"
        :mask-closable="false"
		:closable="false"

         width="360">
            <p slot="header" style="color:#f60;text-align:center">
                <Icon type="ios-information-circle"></Icon>
                <span>Delete confirmation!</span>
            </p>
            <div style="text-align:center">
                <p>{{getDeleteModalObj.msg}}</p>

            </div>
            <div slot="footer">
                <Button type="default" size="large" @click="closeModal" >Close</Button>
                <Button type="error" size="large"  :loading="isDeleing" :disabled="isDeleing" @click="deleteTag" >Delete</Button>
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
    methods : {
        deleteTag(){           
            axios.post(this.getDeleteModalObj.deleteUrl,this.getDeleteModalObj.data).then((res)=>{
               if(res.status == 200){                  
                   this.closeModal();                   
                   this.$toast.error("Deleted", {
                                    position: "bottom-right",
                                    timeout: 3000,
                                    closeOnClick: true,
                                });                   
               }
            })
		},
        closeModal(){
            this.$store.commit('setDeleteModal', false)
            this.$store.commit('setDataChanged', true)
        }
    },
    computed : {
        ...mapGetters(['getDeleteModalObj'])
    }
}
</script>