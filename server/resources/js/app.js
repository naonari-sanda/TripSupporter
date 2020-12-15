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
import AcountComponent from './components/pages/AcountComponent'

Vue.prototype.$http = axios;

Vue.use(Notifications);


const app = new Vue({
    el: '#app',
    data: {
        rating: "0",
        isActive: 1,
        guestModal: false,
        reviewModal: false,
        profileModal: false,
    },
    components: {
        LikeComponent,
        StarRating,
        LoginComponent,
        RegisterComponent,
        ForgetPassComponent,
        ReviewComponent,
        AcountComponent
    },
    props: {
        authId: {
            type: Number
        },
    },
    methods: {
        //タグの変更
        tabChange: function (num) {
            this.isActive = num;
        },
        //レビューのモーダルレビューを表示
        showReview: function () {
            this.reviewModal = true;
        },
        //レビューのモーダルレビューを非表示
        closeReview: function () {
            this.reviewModal = false;
        },
        //レビューのモーダルレビューを表示
        showProfile: function () {
            this.profileModal = true;
        },
        //レビューのモーダルレビューを非表示
        closeProfile: function () {
            this.profileModal = false;
        },
    }
});

