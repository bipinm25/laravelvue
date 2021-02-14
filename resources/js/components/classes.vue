<template>
    <div>
         <div class="row">            
            <div class="col-12 col-sm-12">
                <form @submit.prevent="saveForm" role="form">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">General</a>
                  </li>                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">                    
                <div class="card-body">
                  <div class="row">
                    <div class="col-4 col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Class Name</label>
                    <input type="text" v-model="form.class_name" class="form-control" placeholder="Class Name">
                  </div>
                    </div>
                     <div class="col-4 col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Class Division</label>
                    <input type="text" v-model="form.class_division" class="form-control" placeholder="Class Division">
                  </div>
                  </div>
                   <div class="col-4 col-sm-4">
                   <div class="form-group">
                    <label>Class Teacher</label>
                    <select  v-model="form.teacher_id"  class="form-control">
                        <option value="0">Class Teacher</option>
                        <option v-for="(r, i) in teacherlist" :value="r.id" :key="i">{{r.full_name}}</option>                   
                    </select>
                  </div>
                   </div>                   
                  </div>    <!-- row -->              
                </div>
                <!-- /.card-body -->              
             
                  </div>   
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button @click="resetForm" class="btn btn-default">Reset</button>
                </div>               
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
            </form>
          </div>        
        </div>
           <basicHtml>
            <h3 slot="header" class="card-title">Class List</h3>                
            <table slot="table" class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Class</th>
                      <th>Division</th>                 
                      <th>Class Teacher</th>                 
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr v-for="(row,i) in allclass" :key="i">
                        <td>{{row.id}}</td>
                        <td>{{row.class_name}}</td>
                        <td>{{row.class_division}}</td>
                        <td>{{row.teacher.full_name}}</td>
                        <td><i @click="getClass(row.id)" class="fas fa-edit"></i>
                            <i @click="deleteclass(row.id)" class="fa fa-trash" aria-hidden="true"></i>
                          </td>
                    </tr>
                     
                  </tbody>
                </table>             
        </basicHtml>
        <deleteModal></deleteModal>
    </div>
</template>

<script>
import basicHtml from "../components/basicHtml.vue";
import deleteModal from "../components/deleteModal.vue";
import { mapGetters } from "vuex";

    export default {
        data(){
            return{
                form :{
                    id:0,
                    class_name:'',
                    class_division:'',
                    teacher_id:0
                },
                allclass:null,
                total:0,
                teacherlist:null,
            }
        },
        methods:{

          listClass(n = 0){
                axios.get('listclass',{
                            params: {
                                page: n
                            }
                        }).then((res)=>{
                        this.total =  res.data.count;                
                        this.allclass = res.data.data;
                  });
          },

          getTeacher(){
             axios.get('listteacher',{
                        params: {
                            'getall': true
                        }
                    }).then((res)=>{                   
                    this.teacherlist = res.data;                    
                });
          },

          getClass(id){
              var self = this; 
                  axios.get('getclass',{
                        params: {
                            id: id
                        }
                    }).then((res)=>{                      
                       $.each(res.data, function(key, value) {  
                         if(typeof self.form[key] != 'undefined'){                          
                            self.form[key] = value;
                         }                         
                        });                        
                    });               
          },
          deleteclass(id){
               const deleteModalObj = {
                                        showDeleteModal: true,
                                        deleteUrl: "/deleteclass",
                                        data: {'id':id},                                   
                                        isDeleted: false,
                                        msg:'Do you want to delete the Class'
                                    };
                    this.$store.commit("setDeletingModalObj", deleteModalObj);
                    this.$store.commit('setDataChanged', false);              
            },

          saveForm(){
            var self = this;
            let formData = new FormData();
            $.each(this.form,function(key,val){
              formData.append(key,val);
            });
            axios.post('saveclass', formData).then((res)=>{
                if(res.status == 200){
                  this.$toast.success("Saved", {
                                    position: "bottom-right",
                                    timeout: 2000,
                                    closeOnClick: true,
                                });
                                this.resetForm();
                                this.listClass();
                }
            });
          },

           resetForm() {               
                var self = this;
                Object.keys(this.form).forEach(function(key,index) {
                  if(typeof(self.form[key]) == 'number'){
                    self.form[key] = 0;
                  }else{
                     self.form[key] = '';
                  }
               
                });
            },

        },
        components:{
            basicHtml,deleteModal,
        },
        computed:{
            ...mapGetters(["getdataChanged"]),
        },
        beforeCreate(){
          this.$store.commit("setHeader", 'Class');
        },
        created(){
            this.listClass();
            this.getTeacher();
        },
        watch:{
           getdataChanged(obj){        
                if(obj){
                this.listClass();
                }
            }
        }
    }
</script>
