<template>
    <div>
           <basicHtml>
            <h3 slot="header" class="card-title">Class List</h3> 
             <button slot="button" class="btn btn-primary">Add Class</button>       
            <table slot="table" class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Class</th>
                      <th>Division</th>                 
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                     
                  </tbody>
                </table>             
        </basicHtml>
    </div>
</template>

<script>
import basicHtml from "../components/basicHtml.vue";
    export default {
        data(){
            return{

            }
        },
        methods:{

        },
        components:{
            basicHtml,
        },
        computed:{

        },
        created(){

        },
    }
</script>
