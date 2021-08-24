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

import App from './App.vue';

import LoginComponent from './components/LoginComponent.vue';
import PasswordChangeComponent from './components/PasswordChangeComponent.vue';
import TripsComponent from './components/TripsComponent.vue';
import TripComponent from './components/TripComponent.vue';
import TimeTablesComponent from './components/TimeTablesComponent.vue';
import TimeTableComponent from './components/TimeTableComponent.vue';
import PaymentsComponent from './components/PaymentsComponent.vue';
import PaymentComponent from './components/PaymentComponent.vue';
import ChildrenComponent from './components/ChildrenComponent.vue';
import ChildComponent from './components/ChildComponent.vue';
import AttendantsComponent from './components/AttendantsComponent.vue';
import AttendantComponent from './components/AttendantComponent.vue';

const auth = (param: object): any => {
    if (localStorage.getItem('token') === null) {
        window.location.href = '/#/login';        
    } else {
       return param;    
    }     
}

const routes = [   
    { path: '/login', name: 'login', component: LoginComponent },
    { path: '/passwordchange', name: 'passwordchange', component: PasswordChangeComponent },
    { path: '/trips', name: 'trips', component: auth(TripsComponent) },
    { path: '/trips/:id', name: 'trip', component: auth(TripComponent) },
    { path: '/timetables', name: 'timetables', component: auth(TimeTablesComponent) },
    { path: '/timetables/:id', name: 'timetable', component: auth(TimeTableComponent) },
    { path: '/payments', name: 'payments', component: auth(PaymentsComponent) },
    { path: '/payments/:id', name: 'payment', component: auth(PaymentComponent) },
    { path: '/children', name: 'children', component: auth(ChildrenComponent) },
    { path: '/children/:id', name: 'child', component: auth(ChildComponent) },
    { path: '/attendants', name: 'attendants', component: auth(AttendantsComponent) },
    { path: '/attendants/:id', name: 'attendant', component: auth(AttendantComponent) },
    { path: '/', redirect: { name: 'login' }}
]

const router = createRouter({
    history: createWebHistory('/#'),
    routes
}) 

const app = createApp(App);
app.use(router);
app.mount('#app');
