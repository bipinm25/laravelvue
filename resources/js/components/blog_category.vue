<template>
    <div>
        <div class="container-fluid">
        <div class='row'> 
            <div class="col-md-6">
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Blog Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <div class=""> 
                      <button @click="add_modal" type="button" class="btn btn-primary">Add</button>
                    </div>
                 
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Category</th>
                      <th>Actions</th>                     
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(cat,i) in categorylist" :key="cat.id">
                      <td>{{cat.id}}</td>
                      <td>{{toUpper[cat.id]}}</td>
                      <td>        
                        <a href="#" @click="add_modal(true, cat.category, cat.id)" >Edit</a>                 
                        <i class="fa fa-trash" @click="showDeletingModal(cat,i)" aria-hidden="true"></i>                        
                      </td>                     
                    </tr>                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
                </div>
            </div>
        </div>       
      <deleteModal></deleteModal>
     <addModal></addModal>
    </div>
</template>
<script>
import deleteModal from "../components/deleteModal.vue";
import addModal from "../components/addModal.vue";
import { mapGetters } from "vuex";
export default {
    data(){
        return{
            category:'',
            categorylist:'',
        }
    },
    created(){
        this.getCategory();        
    },
    methods:{
        getCategory(){
            axios.get('/getcategory').then((res)=>{
                this.categorylist = res.data;                
            })
        },
        add_modal(edit = false,data = '',id=0){
            const setaddModalObj = {
                showAddModal: true,
                addUrl:'/savecategory',
                isChanged:false,
                label:'Category',
                data:data,
                edit:edit,
                id:id
            }
            this.$store.commit("typeAddModalObj", setaddModalObj);
            this.$store.commit('setDataChanged', false) 
        },
         showDeletingModal(category, i) {
             const deleteModalObj = {
                                    showDeleteModal: true,
                                    deleteUrl: "/deletecategory",
                                    data: category,
                                    deletingIndex: i,
                                    isDeleted: false,
                                    msg:'Do you want to delete the Category'
                                };
        this.$store.commit("setDeletingModalObj", deleteModalObj);
        this.$store.commit('setDataChanged', false) 
         }
        
    },//End of methods
    computed:{
       ...mapGetters(["getAddModalObj","getdataChanged"]),

       toUpper(){
         return this.categorylist.reduce((acc, item) => {          
            acc[item.id] = item.category.charAt(0).toUpperCase() + item.category.slice(1);
            return acc;
        }, {});
       }
    },
    components:{
            deleteModal,
            addModal
    },
    watch:{
     getdataChanged(obj){
       console.log('coming '+obj);
        if(obj){
          this.getCategory();
        }
      }
    }
}
</script>