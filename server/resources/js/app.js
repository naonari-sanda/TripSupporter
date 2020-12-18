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
import ReviewCreateComponent from './components/pages/ReviewCreateComponent'
import ReviewDetailComponent from './components/pages/ReviewDetailComponent'
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
        countryNumber: 0
    },
    components: {
        LikeComponent,
        StarRating,
        LoginComponent,
        RegisterComponent,
        ForgetPassComponent,
        ReviewCreateComponent,
        ReviewDetailComponent,
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
        //レビューモーダルレビューを表示
        showReview: function (id) {
            this.reviewModal = true;
            this.countryNumber = id;
        },
        // showReview: function () {
        //     this.reviewModal = true;
        // },
        //レビューモーダルレビューを非表示
        closeReview: function () {
            this.reviewModal = false;
        },
        //プロフィールモーダルレビューを表示
        showProfile: function () {
            this.profileModal = true;
        },
        //プロフィールモーダルレビューを非表示
        closeProfile: function () {
            this.profileModal = false;
        },
    }
});

