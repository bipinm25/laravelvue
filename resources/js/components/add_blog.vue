<template>
    <div>
        <basicHtml>
            <h3 slot="header" class="card-title">{{text}}</h3>
            <form slot="table" @submit.prevent="onSubmit" role="form">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Blog Title</label>
                        <input type="text" v-model="form.title" class="form-control" :class="{'is-invalid':errors.title}" id="exampleInputEmail1" placeholder="Enter Title">
                        <span v-if="errors" class="error-msg" >{{errors.title}}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                       <select v-model="form.category_id" class="form-control" :class="{'is-invalid':errors.category_id}">
                           <option value="0">--SELETCT--</option>                           
                           <option v-for="(cat,i) in categorylist" :key="i" :value="cat.id">{{cat.category}}</option>
                       </select>
                        <span  v-if="errors" class="error-msg">{{errors.category_id}}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Content</label>
                         <editor
                                v-model="form.content"
                                api-key="hmddeisl3819zr3vbi7w3quqsdzlxs47ysgyuw59x94xkpgp"
                                initial-value="Once upon a time..."
                                :init="{
                                    height: 500,
                                    menubar: false,
                                    plugins: [
                                    'advlist autolink lists link image charmap print preview anchor',
                                    'searchreplace visualblocks code fullscreen',
                                    'insertdatetime media table paste code help wordcount'
                                    ],
                                    toolbar:
                                    'undo redo | formatselect | bold italic backcolor | \
                                    alignleft aligncenter alignright alignjustify | \
                                    bullist numlist outdent indent | removeformat | help'
                                }"
                                />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" ref="img" @change="handleFileUpload()" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>                       
                        </div>
                        <img v-if="imgsrc.length > 0" :src="imgsrc" width="150" height="150" class="img-fluid mb-2">
                    </div>

                    <div class="form-group">
                        <label>Tag</label>
                        <multiselect 
                            v-model="selectedtags" 
                            :options="options" 
                            :multiple="true" 
                            :close-on-select="false" 
                            :clear-on-select="false" 
                            :preserve-search="true" 
                            placeholder="Pick some"                            
                            label="tag" 
                            track-by="id">                              
                        </multiselect>                        
                    </div>
                    
                    <div class="form-check">
                        <input type="checkbox" v-model="form.status" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Enable</label>
                    </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
        </basicHtml>
    </div>
</template>

<script>
import basicHtml from "../components/basicHtml.vue";
import Editor from '@tinymce/tinymce-vue';
import Multiselect from 'vue-multiselect'
    export default {
        data(){
            return{               
                selectedtags:[], //{ "id": 22, "tag": "klpoyyy"}, { "id": 17, "tag": "gghtyxxx", }
                options: [],                
                form:{
                    id:0,
                    title:'',
                    content:'',
                    status:'',
                    image:'',
                    category_id:0,
                    tag_id:[]
                },
                categorylist:'',
                imgsrc:'',
                text:'Add Blog',
                errors:"{}"
            }
        },
        created(){
             this.getCategory();
             this.getTag();

            let blog_id = this.$route.params.id || 0;

            if(blog_id > 0){
                this.text = 'Edit Blog'
                this.getBlog(blog_id);
            }
           
        },
        methods:{
            onSubmit(){

                let formData = new FormData();                  
                $.each(this.form, function(key, value) {
                    formData.append(key, value);
                });               
              
                axios.post('/saveblog',formData).then((res)=>{
                    if(res.status==200){
                         this.$toast.success("Saved", {
                                    position: "bottom-right",
                                    timeout: 2000,
                                    closeOnClick: true,
                                });
                         this.$router.push({ name: 'blog_list' });
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
            handleFileUpload(){
                this.form.image = this.$refs.img.files[0];
            },
            getCategory(){
                axios.get('/getcategory').then((res)=>{
                    this.categorylist = res.data;                
                })
            },
             getTag(){
                axios.get('/gettag').then((res)=>{
                    this.options = res.data.data
                    // console.log(res.data);
                    // for (const [key, value] of res.data) {
                    //  this.options[key] = {'id':}
                    // }
                });
                
            },
            getBlog(id){
                axios.get('/getblog/'+id).then((res)=>{
                    let data = res.data;
                    //console.log(data);

                   this.form.id = data.id;           
                   this.form.title = data.title;
                   this.form.category_id = data.category_id;
                   this.form.content = data.blog_content;
                   this.form.status = data.status?true:false;
                   this.imgsrc = data.image;
                   this.selectedtags = data.tag;
                     
                });
            }


        },
        components:{
            basicHtml,
            Editor,
            'multiselect':Multiselect,

        },
        computed:{
            value: {
                get () {
                    return this.options.filter(
                        option => this.selectedNames.includes(option.id)
                    )
                },
                set (newSelectedOptions) {
                    console.log(this.selectedNames);
                        this.selectedNames = newSelectedOptions.map(option => option.id)
                }
            },       
        },
        watch: {
            selectedtags (newValues) {
                this.form.tag_id = newValues.map(obj => obj.id)
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>