/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

// Plugins
import { registerPlugins } from '@/plugins'

import { createRouter, createWebHistory } from 'vue-router'
// Components
import App from './App.vue'
import HomeVue from './components/Home.vue';
import LoginVue from './components/Login.vue';
import RegisterVue from './components/User/Register.vue';
import UserListVue from './components/User/List.vue';
import DashboardVue from './components/Dashboard/Index.vue';

// Composables
import { createApp } from 'vue'
import { createPinia } from 'pinia'
// Utils
import AuthService from "./services/AuthService";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { 
            path: '/', 
            component: HomeVue, 
            children: [ 
                { path: '', component: LoginVue },
                { path: 'register', component: RegisterVue }
            ]
        },
        { 
            path: '/dashboard', 
            component: DashboardVue,
            beforeEnter: checkAuth,
            children: [ 
                { path: 'users', component: UserListVue },
                // { path: 'register', component: RegisterVue }
            ]
        },
        
    ]
});

function checkAuth(to, from, next) 
{   
    if (AuthService.isAuthenticated()) next();
    else{
        console.log('ASDF')
        next("/");
    }
        
}

const app = createApp(App)
app.use(createPinia())
app.use(router)
registerPlugins(app)

app.mount('#app')
