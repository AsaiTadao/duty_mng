import Home from "./components/Home";
import OwnAttend from "./components/OwnAttend";
import NotFound from "./components/NotFound";

// export default [
//     { path: '/home', component: require('./components/Home.vue').default },
//     { path: '/ownAttend', component: require('./components/OwnAttend.vue').default },
//     { path: '*', component: require('./components/NotFound.vue').default }
// ];
export default [
    {
        path: "/home",
        component: Home,
    },
    {
        path: "/ownAttend",
        component: OwnAttend,
    },
    {
        path: "*",
        component: NotFound,
    },
];
