<template>
  <div class="like d-flex align-items-center ml-auto" v-if="authId !== '[]'">
    <i v-if="!liked" class="far fa-heart mt-2 h3" @click="like(countryId)"></i>
    <i v-else class="fas fa-heart mt-2 h3" @click="unlike(countryId)"></i>
    <p class="ml-1 mb-0 h5" v-if="this.count !== 0">{{ this.count }}</p>
  </div>
  <div v-else class="like d-flex align-items-center ml-auto">
    <i
      class="far fa-heart mt-2 h3"
      data-toggle="modal"
      data-target="#guestModal"
    ></i>
    <p class="ml-1 mb-0 h5" v-if="this.count !== 0">
      {{ this.count }}
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      liked: false,
      count: 0,
      showCount: true,
    };
  },

  props: {
    authId: {
      type: Object | Number,
    },
    countryId: {
      type: Object | Number,
    },
    likeCheck: {
      type: Object,
    },
    likeCount: {
      type: Number,
    },
  },
  created: function () {
    //いいねのしている場合いいね解除ボタンを追加
    if (this.countryId == this.likeCheck.country_id) {
      this.liked = this.likeCheck.check;
    }

    //いいね数を追加
    this.count = this.likeCount;
  },
  methods: {
    like(countryId) {
      let url = `/api/${countryId}/like`;

      axios
        .post(url, {
          user_id: this.authId,
        })
        .then((response) => {
          this.liked = true;
          this.count = response.data.likeCount;
        })
        .catch((error) => {
          alert(error);
        });
    },
    unlike(countryId) {
      let url = `/api/${countryId}/unlike`;

      axios
        .post(url, {
          user_id: this.authId,
        })
        .then((response) => {
          this.liked = false;
          this.count = response.data.likeCount;
        })
        .catch((error) => {
          alert(error);
        });
    },
  },
};
</script>

<style scoped>
.far {
  cursor: pointer;
}

.like {
  width: 40px;
}
</style>