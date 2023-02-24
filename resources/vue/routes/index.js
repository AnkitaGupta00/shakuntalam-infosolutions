import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

let routes = [
    {
        path: '/',
        component: require('../layouts/Master').default,
        children: [
            {
                path: '/',
                component: require('../pages/Dashboard').default,
                name: 'dashboard',
                meta: {
                    title: 'dashboard',
                    requireAuth: true
                }
            },
            {
                path: '/register',
                component: require('../pages/registration/Register').default,
                name: 'register',
                meta: {
                    title: 'create',
                    requireAuth: true
                }
            },
            {
                path: '/about',
                component: require('../pages/About').default,
                name: 'about',
                meta: {
                    title: 'about',
                    requireAuth: true
                }
            },
            {
                path: '/packages',
                component: require('../pages/Packages').default,
                name: 'packages',
                meta: {
                    title: 'packages',
                    requireAuth: true
                }
            },
            {
                path: '/service',
                component: require('../pages/Services').default,
                name: 'service',
                meta: {
                    title: 'service',
                    requireAuth: true
                }
            },
            {
                path: '/contact',
                component: require('../pages/Contact').default,
                name: 'contact',
                meta: {
                    title: 'contact',
                    requireAuth: true
                }
            }
        ]
    },
    {
        path: '/',
        component: require('../layouts/Auth').default,
        children: [
            {
                path: '/registration',
                component: require('../pages/registration/Register').default,
                name: 'registration',
                meta: {
                    title: 'registration',
                }
            },
            {
                path: '/policy',
                component: require('../pages/policy/Policy').default,
                name: 'policy',
                meta: {
                    title: 'policy',
                }
            },
            {
                path: '/authentication',
                component: require('../pages/auth/Authenticatoin').default,
                name: 'authentication',
                meta: {
                    title: 'authentication',
                }
            },
            {
                path: '/terms/uses',
                component: require('../pages/policy/TermsOfUses').default,
                name: 'terms',
                meta: {
                    title: 'terms',
                }
            },{
                path: '/privacy',
                component: require('../pages/policy/PrivacyPolicy').default,
                name: 'privacy',
                meta: {
                    title: 'privacy',
                }
            },
        ]
    },

];

const router = new VueRouter({
    mode: 'history',
    routes
});


export default router;
