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
            name: 'talent',
            path: '/:genre/talents/:id',
            component: () => import('./pages/talent.vue')
        },
        {
            name: 'races',
            path: '/:genre/races',
            component: () => import('./pages/races.vue')
        },
        {
            name: 'account',
            path: '/account',
            component: () => import('./pages/account.vue')
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
