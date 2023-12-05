import {createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'home',
            path: '/',
            component: () => import('./pages/genres.vue')
        },
        {
            name: 'genres',
            path: '/:name',
            component: () => import('./pages/genre.vue')
        },
        {
            name: 'login',
            path: '/login',
            component: () => import('./pages/login.vue')
        },
        {
            name: 'register',
            path: '/register',
            component: () => import('./pages/register.vue')
        }
    ]
})

export default router;
