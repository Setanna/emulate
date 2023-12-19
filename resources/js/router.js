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
            path: '/:genre',
            component: () => import('./pages/genre.vue')
        },
        {
            name: 'talents',
            path: '/:genre/talents',
            component: () => import('./pages/talents.vue')
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
        },
        {
            path: '/:pathMatch(.*)',
            redirect: "/not_found"
        },
        {
            name: 'not_found',
            path: '/not_found',
            component: () => import('./pages/not_found.vue')
        }
    ]
})

export default router;
