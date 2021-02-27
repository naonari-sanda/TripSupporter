require('./bootstrap');
require('./script');


window.Vue = require('vue');

import Vue from 'vue'
import axios from 'axios'
import StarRating from "vue-star-rating";
import Notifications from 'vue-notification'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import RankingComponent from './components/pages/RankingComponent'
import LoginComponent from './components/pages/LoginComponent'
import RegisterComponent from './components/pages/RegisterComponent'
import ForgetPassComponent from './components/pages/ForgetPassComponent'

import ImgUploadComponent from './components/parts/ImgUploadComponent'
import ReviewCreateComponent from './components/parts/ReviewCreateComponent'
import ReviewEditComponent from './components/parts/ReviewEditComponent'
import AcountComponent from './components/parts/AcountComponent'
import AcountEditComponent from './components/parts/AcountEditComponent'
import LikeComponent from './components/parts/LikeComponent'


Vue.prototype.$http = axios;

Vue.use(Notifications);
Vue.use(Loading);


const app = new Vue({
    el: '#app',
    data: {
        rating: "0",
        isActive: 1,
        guestModal: false,
        reviewModal: false,
        profileModal: false,
        profileEditModal: false,
        imageModal: false,
        countryId: 0,
        countryName: "",
        reviewDetailModal: true,
        reviewDetail: ""
    },
    components: {
        LikeComponent,
        StarRating,
        LoginComponent,
        RegisterComponent,
        ForgetPassComponent,
        ReviewCreateComponent,
        ReviewEditComponent,
        AcountComponent,
        AcountEditComponent,
        RankingComponent,
        ImgUploadComponent
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
        showReview: function (num, name, data) {
            this.reviewModal = true;
            this.countryId = num;
            this.countryName = name;
            this.reviewDetail = data;
        },
        //レビューモーダルレビューを非表示
        closeReview: function () {
            this.reviewModal = false;
        },
        //レビュー詳細モーダル表示
        showReviewDetail: function (data) {
            this.reviewDetailModal = true;
            this.reviewDetail = data;
        },
        closeReviewDetail: function () {
            this.reviewDetailModal = false;
        },
        //プロフィールモーダルレビューを表示
        showProfile: function () {
            this.profileModal = true;
        },
        //プロフィールモーダルレビューを非表示
        closeProfile: function () {
            this.profileModal = false;
        },
        //プロフィールモーダルレビューを表示
        showProfileEdit: function () {
            this.profileEditModal = true;
        },
        //プロフィールモーダルレビューを非表示
        closeProfileEdit: function () {
            this.profileEditModal = false;
        },
        //画像モーダルレビューを表示
        showImage: function () {
            this.imageModal = true;
        },
        //画像モーダルレビューを非表示
        closeImage: function () {
            this.imageModal = false;
        },
    }
});

