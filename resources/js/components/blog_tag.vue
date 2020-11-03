<template>
    <div>
      <basicHtml>
         <h3 slot="header" class="card-title">Blog Tag</h3>
          <button slot="button" @click="add_modal(false)" type="button" class="btn btn-primary">Add</button>
          <table slot="table" class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Tag</th>
                      <th>Actions</th>                     
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(tag,i) in taglist" :key="i">
                      <td>{{tag.id}}</td>
                      <td>{{toUpper[tag.id]}}</td>
                      <td>                      
                        <a href="#" @click="add_modal(true,tag.tag,tag.id)" >Edit</a>
                        <i class="fa fa-trash" @click="showDeletingModal(tag,i)" aria-hidden="true"></i>
                      </td>                     
                    </tr>                    
                  </tbody>
                </table>
                
                <div slot="pagination" class="card-footer clearfix">
                  <pagination :total="total"  v-on:changePage="getTag($event)"></pagination>               
                </div>
      </basicHtml>
      
      <addModal></addModal>
      <deleteModal></deleteModal>
    </div>
</template>
<script>
import basicHtml from "../components/basicHtml.vue";
import addModal from "../components/addModal.vue";
import deleteModal from "../components/deleteModal.vue";
import { mapGetters } from "vuex";

export default {
    data(){
        return {
          taglist:'',
          uppercase:'',
          total:0,
        }
    },
    created(){
      this.getTag();
    },    
    components:{
        addModal,deleteModal,basicHtml
    },
    methods:{
        add_modal(edit = false,data = '',id=0){ 
            const setaddModalObj = {
                showAddModal: true,
                addUrl:'/savetag',
                isChanged:false,
                label:'Tag',
                data:data,
                edit:edit,
                id:id
            }
            this.$store.commit("typeAddModalObj", setaddModalObj);
            this.$store.commit('setDataChanged', false) 
        },
        getTag(n=0){
          axios.get('/gettag',{
                        params: {
                            page: n
                        }
                    }).then((res)=>{
                      this.total =  res.data.count;
                      this.taglist = this.uppercase = res.data.data;
          });
        },
        showDeletingModal(tag, i) {            
             const deleteModalObj = {
                                    showDeleteModal: true,
                                    deleteUrl: "/deletetag",
                                    data: tag,
                                    deletingIndex: i,
                                    isDeleted: false,
                                    msg:'Do you want to delete the Tag'
                                };
        this.$store.commit("setDeletingModalObj", deleteModalObj);
        this.$store.commit('setDataChanged', false) 
         }

    },
    computed:{
       ...mapGetters(["getAddModalObj","getdataChanged"]),

      //  toUpper(){
      //    return this.taglist.reduce((acc, item) => {          
      //       acc[item.id] = item.tag.charAt(0).toUpperCase() + item.tag.slice(1);
      //       return acc;
      //   }, {});
      //  }


    },
    watch:{
      getdataChanged(obj){        
        if(obj){
          this.getTag();
        }
      }
    }

}
</script>