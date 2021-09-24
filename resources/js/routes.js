export default [
    { path: '/home', component: require('./components/Home.vue').default },
    { path: '/ownAttend', component: require('./components/OwnAttend.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
