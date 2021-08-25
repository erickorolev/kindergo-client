/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// @ts-ignore
import Alpine from 'alpinejs';
// @ts-ignore
window.Alpine = Alpine;

Alpine.start();

import {createApp} from 'vue';
import { createRouter, createWebHistory } from 'vue-router'; 
import 'bootstrap';
import '../css/style.css';
import '../sass/modal.scss';
import '../css/fontawesome.min.css';
import '../css/all.css';

import App from './App.vue';

const routes = [   
    { path: '/login', name: 'login', component: function() {        
        return import('./components/LoginComponent.vue');
      },  
    },
    { path: '/trips', name: 'trips', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/TripsComponent.vue');
      },  
    },
    { path: '/trips/:id', name: 'trip', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/TripComponent.vue');
      },  
    },
    { path: '/timetables', name: 'timetables', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/TimetablesComponent.vue');
      },  
    },
    { path: '/timetables/:id', name: 'timetable', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/TimetableComponent.vue');
      },  
    },
    { path: '/payments', name: 'payments', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/PaymentsComponent.vue');
      },  
    },
    { path: '/payments/:id', name: 'payment', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/PaymentComponent.vue');
      },  
    },
    { path: '/children', name: 'children', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/ChildrenComponent.vue');
      },  
    },
    { path: '/children/:id', name: 'child', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/ChildComponent.vue');
      },  
    },
    { path: '/child/edit/:id', name: 'childedit', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/ChildEditComponent.vue');
      },  
    },
    { path: '/attendants', name: 'attendants', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/AttendantsComponent.vue');
      },  
    },
    { path: '/attendants/:id', name: 'attendant', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/AttendantComponent.vue');
      },  
    },
    { path: '/lk', name: 'lk', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/LkComponent.vue');
      },  
    },
    { path: '/lk/edit/:id', name: 'lkedit', component: function() {
        if (localStorage.getItem("token") == null) {          
          document.location = <any>"";
        }
        return import('./components/LkEditComponent.vue');
      },  
    },
    { path: '/**', redirect: { name: 'login' }},
    { path: '/', redirect: { name: 'login' }}
]

const router = createRouter({
    history: createWebHistory('/#'),
    routes
}) 

const app = createApp(App);
app.use(router);
app.mount('#app');
