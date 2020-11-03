<template>
    <div>
        <basicHtml>
            <h3 slot="header" class="card-title">Blog List</h3>            
            <router-link slot="button" to="/add_blog" class="btn btn-primary">Add Blog</router-link>
            <table slot="table" class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Category</th>                 
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(blog,i) in allblog" :key="i"> 
                        <td>{{blog.id}}</td>       
                        <td>{{blog.title}}</td>
                        <td>{{blog.category.category}}</td>
                        <td><router-link slot="button" :to="`/add_blog/${blog.id}`" class="btn btn-primary">Edit</router-link>
                        <button @click="blog_delete(blog.id)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>        
                  </tbody>
                </table> 
             <div slot="pagination" class="card-footer clearfix">
                  <pagination :total="total"  v-on:changePage="listBlog($event)"></pagination>
              </div>  
        </basicHtml>
         <deleteModal></deleteModal>        
    </div>
</template>

<script>

import basicHtml from "../components/basicHtml.vue";
import deleteModal from "../components/deleteModal.vue";
//import pagination from "../components/pagination.vue";
import { mapGetters } from "vuex";

    export default {
        data(){
            return{
                allblog:'',             
                total:0
            }
        },
        methods:{
            listBlog(n = 0){                         
                axios.get('/listblog',{
                        params: {
                            page: n
                        }
                    }).then((res)=>{
                    this.total =  res.data.count;                
                    this.allblog = res.data.data;

                });
            },

            blog_delete(id){
                const deleteModalObj = {
                                    showDeleteModal: true,
                                    deleteUrl: "/deleteblog",
                                    data: {'id':id},                                   
                                    isDeleted: false,
                                    msg:'Do you want to delete the Blog'
                                    };
                    this.$store.commit("setDeletingModalObj", deleteModalObj);
                    this.$store.commit('setDataChanged', false) 

            }

        },
        components:{
            basicHtml, deleteModal
        },
        created(){          
            this.listBlog()
        },
        beforeCreate(){
            
        },
        computed:{
             ...mapGetters(["getdataChanged","GET_SESSION"]),         

        },
        watch:{
            getdataChanged(obj){        
                if(obj){
                this.listBlog();
                }
            }
        }
       
    }
</script>


