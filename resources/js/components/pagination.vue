<template>
    <div>
        <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a @click="changePages(0)"  class="page-link" href="javascript:;">First</a></li>
            <li class="page-item" v-for="(n,i) in calcPage" :key="i">
                <a  @click="changePages(i*limit)" class="page-link" href="javascript:;">{{i+1}}</a>
            </li>                  
            <li class="page-item"><a @click="changePages((calcPage-1)*limit)"  class="page-link" href="javascript:;">Last</a></li>
        </ul>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
    export default {
        props:{
            total:{
                type:Number,
                required:true,
            }
        },
        data(){
            return{
                limit:5,
            }
        },
        methods:{
            changePages(n){
                this.$emit('changePage',n);
            }
        },
        components:{

        },
        computed:{
             calcPage(){
                 return Math.ceil(this.total/this.limit);
             },
             ...mapGetters(["GET_SESSION"]),  

        },
        beforeCreate(){
           // this.$store.dispatch('loadSession');
        },
        created(){
            this.$store.dispatch('loadSession');
            if(this.GET_SESSION  == null){
                axios.get('/getsession').then((res)=>{              
                    this.limit = res.data.limit;
                })
            }else{
                 this.limit = this.GET_SESSION.limit;
            }
           
        },
    }
</script>
