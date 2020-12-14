require('./bootstrap');
require('./script');

window.Vue = require('vue');

import Vue from 'vue'
import axios from 'axios'
import StarRating from "vue-star-rating";
import Notifications from 'vue-notification'
import LikeComponent from './components/pages/LikeComponent'
import LoginComponent from './components/pages/LoginComponent'
import RegisterComponent from './components/pages/RegisterComponent'
import ForgetPassComponent from './components/pages/ForgetPassComponent'
import ReviewComponent from './components/pages/ReviewComponent'


Vue.prototype.$http = axios;

Vue.use(Notifications);


const app = new Vue({
    el: '#app',
    data: {
        rating: "0",
        isActive: 1,
        guestModal: false,
        reviewModal: false,
    },
    components: {
        LikeComponent,
        StarRating,
        LoginComponent,
        RegisterComponent,
        ForgetPassComponent,
        ReviewComponent,
    },
    props: {
        authId: {
            type: Number
        },
    },
    methods: {
        tabChange: function (num) {
            this.isActive = num;
        },
        showReview: function () {
            this.reviewModal = true;
        },
        closeReview: function () {
            this.reviewModal = false;
        },
    }
});

