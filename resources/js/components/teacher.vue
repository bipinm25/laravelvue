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
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">tab2</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">tab3</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">tab4</a>
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
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" v-model="form.first_name" class="form-control" placeholder="First Name">
                  </div>
                    </div>
                     <div class="col-4 col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Last Name</label>
                    <input type="text" v-model="form.last_name" class="form-control" placeholder="Last name">
                  </div>
                  </div>
                   <div class="col-4 col-sm-4">
                   <div class="form-group">
                    <label>Gender</label>
                    <select  v-model="form.gender"  class="form-control">
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                  </div>
                   </div>
                   <div class="col-4 col-sm-4">
                   <div class="form-group">
                    <label>Email</label>
                    <input type="email" v-model="form.email" class="form-control" placeholder="Email">
                  </div>
                   </div>
                   <div class="col-4 col-sm-4">
                   <div class="form-group">
                    <label>DOJ</label>
                    <datepicker v-model="form.doj" format="dd-MM-yyyy" input-class="form-control"></datepicker>                    
                  </div>
                   </div>
                   <div class="col-4 col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputFile">Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>  
                   </div>
                  </div>    <!-- row -->              
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
             
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    tab2
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    tab3
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                    tab4
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
                      <th>First Name</th>
                      <th>Last Name</th>                 
                      <th>Email</th>
                      <th>Phone</th>
                      <th>DOJ</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr v-for="(data,i) in allteacher" :key="i">
                          <td>{{data.id}}</td>
                          <td>{{data.first_name}}</td>
                          <td>{{data.last_name}}</td>
                          <td>{{data.email}}</td>
                          <td>{{data.phone}}</td>
                          <td>{{data.doj}}</td>
                          <td><i @click="edit(data.id)" class="fas fa-edit"></i>
                              <i @click="deleteteacher(data.id)" class="fa fa-trash" aria-hidden="true"></i>
                          </td>
                      </tr>
                     
                  </tbody>
                </table> 
                <div slot="pagination" class="card-footer clearfix">
                  <pagination :total="total"  v-on:changePage="listTeacher($event)"></pagination>
              </div>              
        </basicHtml>
        <deleteModal></deleteModal>
    </div>
</template>

<script>
import basicHtml from "../components/basicHtml.vue";
import Datepicker from 'vuejs-datepicker';
import deleteModal from "../components/deleteModal.vue";
import { mapGetters } from "vuex";

    export default {
        data(){
            return{
                form:{
                    id:0,
                    first_name:'',
                    last_name:'',
                    gender:'',
                    email:'',
                    doj:'',
                },
                errors:"{}",
                total:0,
                allteacher:null,
            }
        },
        methods:{
            saveForm(){
                var self = this;
                let formData = new FormData();                  
                $.each(this.form, function(key, value) {
                  if(key == 'doj'){
                    value = self.formatDate(value);
                  }
                  formData.append(key, value);
                });
                

                axios.post('/saveteacher',formData).then((res)=>{
                    if(res.status==200){
                         this.$toast.success("Saved", {
                                    position: "bottom-right",
                                    timeout: 2000,
                                    closeOnClick: true,
                                });
                                this.resetForm();
                                this.listTeacher();
                         //this.$router.push({ name: 'blog_list' });
                    }
                }).catch(err =>{
                    //let error = err.response.data.errors;                    
                    var allerror={};
                     $.each( err.response.data.errors, function(key, value) {
                        allerror[key] = value[0];
                    });    
                   this.errors = allerror;
                })
               
            },
            resetForm() {               
                var self = this; //you need this because *this* will refer to Object.keys below`
                //Iterate through each object field, key is name of the object field`
                Object.keys(this.form).forEach(function(key,index) {
                self.form[key] = '';
                });
            },

            listTeacher(n = 0){                         
                axios.get('listteacher',{
                        params: {
                            page: n
                        }
                    }).then((res)=>{
                    this.total =  res.data.count;                
                    this.allteacher = res.data.data;

                });
            },
            edit(id){
                  var self = this; 
                  axios.get('getteacher',{
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
            deleteteacher(id){
               const deleteModalObj = {
                                        showDeleteModal: true,
                                        deleteUrl: "/deleteteacher",
                                        data: {'id':id},                                   
                                        isDeleted: false,
                                        msg:'Do you want to delete the Teacher'
                                    };
                    this.$store.commit("setDeletingModalObj", deleteModalObj);
                    this.$store.commit('setDataChanged', false);              
            },
            formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }

        },
        components:{
            basicHtml, Datepicker, deleteModal
        },
        computed:{
            ...mapGetters(["getdataChanged"]),    
        },
        created(){
                this.listTeacher();
        },
        watch:{
            getdataChanged(obj){        
                if(obj){
                this.listTeacher();
                }
            }
        },
    }
</script>
