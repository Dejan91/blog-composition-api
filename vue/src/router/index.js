import { createRouter, createWebHistory } from 'vue-router'

import Home from "../pages/Home.vue";
import Post from "../pages/Post.vue";
import Login from "../pages/Login.vue";
import Posts from "../pages/admin/Posts.vue";
import store from "../store";
import Edit from "../pages/admin/Edit.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/posts/:uuid',
        name: 'post',
        component: Post,
        props: true
    },
    {
        path: '/admin/login',
        name: 'admin.login',
        component: Login
    },
    {
        path: '/admin/posts/:uuid/edit',
        name: 'admin.posts.edit',
        component: Edit,
        props: true,
        beforeEnter: (to, from, next) => {
            if (! store.getters.authenticated) {
                return next({ name: 'admin.login' })
            }

            return next()
        }
    },
    {
        path: '/admin/posts',
        name: 'admin.posts',
        component: Posts,
        beforeEnter: (to, from, next) => {
            if (! store.getters.authenticated) {
                return next({ name: 'admin.login' })
            }

            return next()
        }
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})