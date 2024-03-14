import {createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'home',
            path: '/',
            component: () => import('./pages/genre/genres.vue')
        },
        {
            name: 'genres',
            path: '/:genre',
            component: () => import('./pages/genre/genre.vue')
        },
        {
            name: 'workshop',
            path: '/:genre/workshop',
            component: () => import('./pages/workshop.vue'),
        },
        {
            path: '/:genre/talents',
            component: () => import('./pages/talent/talents.vue'),
            children: [
                {name: 'talents', path: '', component: () => import('./components/talent/view_talents.vue')},
                {
                    path: ':id', component: () => import('./pages/talent/talent.vue'),
                    children: [
                        {name: 'talent', path: '', component: () => import('./components/talent/view_talent.vue')},
                        {
                            name: 'edit_talent',
                            path: 'edit',
                            component: () => import('./components/talent/edit_talent.vue')
                        }
                    ]
                }
            ]

        },
        {
            path: '/:genre/races',
            component: () => import('./pages/race/races.vue'),
            children: [
                {name: 'races', path: '', component: () => import('./components/race/view_races.vue')},
                {
                    path: ':id', component: () => import('./pages/race/race.vue'),
                    children: [
                        {name: 'race', path: '', component: () => import('./components/race/view_race.vue')}
                    ]
                }
            ]
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
