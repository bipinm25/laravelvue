import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'

import dashboard from './components/dashboard.vue'
import category from './components/blog_category.vue'
import tag from './components/blog_tag.vue'
import blog_list from './components/blog_list.vue'
import add_blog from './components/add_blog.vue'

Vue.use(VueRouter)

const routes = [
    {
        path:'/dashboard', 
        component:dashboard,        
        // beforeEnter: (to, from, next) => {           
        //     store.dispatch('loadSession');     
        // }
    },    
    {
        path:'/category', 
        component:category,        
    },
    {
        path:'/addtag', 
        component:tag,        
    },
    {
        path:'/blog_list', 
        component:blog_list,
        name:'blog_list'       
    },
    {
        path:'/add_blog/:id?', 
        component:add_blog,
        name:'add_blog'     
    },
];

export default new VueRouter({
    mode: 'history',
    routes
});