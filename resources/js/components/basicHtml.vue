<template>
    <div>
        <div class="container-fluid">
        <div class='row'> 
            <div class="col-md-12">
                <div class="card">
              <div class="card-header">                
                 <slot name="header"></slot>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <div class="" style="float: right;">
                       <!-- /.button slot -->
                       <slot name="button"></slot>
                    </div>
                 
               <!-- table goes here -->
                <slot name="table"></slot>
                
              </div>
              <!-- /.pagination -->
              <slot name="pagination"></slot>
             
            </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return{

            }
        },
        methods:{

        },
    }
</script>
