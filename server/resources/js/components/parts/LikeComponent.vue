<template>
  <div v-if="authId !== '[]'" class="like d-flex align-items-center ml-auto">
    <div v-if="!liked" class="d-flex align-items-center">
      <i class="far fa-heart mt-2 h3" @click="like(countryId)"></i>
      <p v-if="this.count !== 0" class="ml-1 mb-0 h5">{{ this.count }}</p>
    </div>
    <div v-else class="d-flex align-items-center">
      <i class="red fas fa-heart mt-2 h3" @click="unlike(countryId)"></i>
      <p v-if="this.count !== 0" class="red ml-1 mb-0 h5">{{ this.count }}</p>
    </div>
    <!-- <div>私のいいね数：{{ likeCheck }}</div> -->
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
      type: Object | Boolean,
    },
    likeCount: {
      type: Number,
    },
  },
  created: function () {
    //いいねのしている場合いいね解除ボタンを追加
    if (this.likeCheck) {
      this.liked = this.likeCheck;
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
i {
  cursor: pointer;
}

.like {
  width: 40px;
}

.red {
  color: #ff4742;
}
</style>