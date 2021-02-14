<template>
    <div> <h1 class="m-0 text-dark">{{this.getheader}}</h1> </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
    computed:{
        ...mapGetters(['getheader']),
    }
}
</script>