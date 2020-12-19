<template>
  <div id="overlay" @click="clickEvent">
    <div class="wrapper" @click="stopEvent">
      <div class="confirm">
        <div class="header">
          <h2>プロフィールを確認する</h2>
        </div>
        <hr />

        <div class="fill mb-3">
          <table class="table mb-0">
            <tbody>
              <tr>
                <th scope="row">総合</th>
                <td>
                  <star-rating
                    v-bind:increment="0.5"
                    v-bind:rating="1"
                    v-bind:read-only="true"
                    v-bind:show-rating="false"
                    v-bind:star-size="25"
                  ></star-rating>
                </td>
              </tr>
              <tr>
                <th scope="row">治安</th>
                <td>
                  <star-rating
                    v-bind:increment="0.5"
                    v-bind:rating="1"
                    v-bind:read-only="true"
                    v-bind:show-rating="false"
                    v-bind:star-size="25"
                  ></star-rating>
                </td>
              </tr>
              <tr>
                <th scope="row">費用</th>
                <td>
                  <star-rating
                    v-bind:increment="0.5"
                    v-bind:rating="1"
                    v-bind:read-only="true"
                    v-bind:show-rating="false"
                    v-bind:star-size="25"
                  ></star-rating>
                </td>
              </tr>
              <tr>
                <th scope="row">楽しさ</th>
                <td>
                  <star-rating
                    v-bind:increment="0.5"
                    v-bind:rating="1"
                    v-bind:read-only="true"
                    v-bind:show-rating="false"
                    v-bind:star-size="25"
                  ></star-rating>
                </td>
              </tr>
              <tr>
                <th scope="row">観光</th>
                <td>
                  <star-rating
                    v-bind:increment="0.5"
                    v-bind:rating="1"
                    v-bind:read-only="true"
                    v-bind:show-rating="false"
                    v-bind:star-size="25"
                  ></star-rating>
                </td>
              </tr>
              <tr>
                <th scope="row">料理</th>
                <td>
                  <star-rating
                    v-bind:increment="0.5"
                    v-bind:rating="1"
                    v-bind:read-only="true"
                    v-bind:show-rating="false"
                    v-bind:star-size="25"
                  ></star-rating>
                </td>
              </tr>
              <tr>
                <th scope="row">英語</th>
                <td>
                  <star-rating
                    v-bind:increment="0.5"
                    v-bind:rating="1"
                    v-bind:read-only="true"
                    v-bind:show-rating="false"
                    v-bind:star-size="25"
                  ></star-rating>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="table mb-0">
            <tbody>
              <tr>
                <th scope="row" style="white-space: nowrap">お気に入り都市</th>
              </tr>
            </tbody>
          </table>

          <table class="table">
            <tbody>
              <tr>
                <th scope="row" style="white-space: nowrap">お気に入り都市</th>
              </tr>
              <tr>
                <td class="pt-0" style="border-top: none">
                  {{ city }}
                </td>
              </tr>
              <tr>
                <th scope="row" style="white-space: nowrap">レビュー</th>
              </tr>
              <tr>
                <td class="pt-0" style="border-top: none">
                  {{ review }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="button mb-3">
          <button type="submit" class="btn btn-primary">戻る</button>
        </div>

        <a class="forget btn-link text-center" @click="clickEvent"
          >ー 戻る ー</a
        >
      </div>
    </div>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  data() {
    return {
      safe: 0,
      cost: 0,
      fun: 0,
      tourism: 0,
      food: 0,
      english: 0,
      review: "",
      city: "",
    };
  },
  components: {
    StarRating,
  },
  props: {
    reviewDateil: {
      type: Object | Array,
    },
  },
  methods: {
    clickEvent: function () {
      this.$emit("review-detail-child");
    },
    stopEvent: function () {
      event.stopPropagation();
    },
  },
};
</script>

<style lang="scss" scoped>
$primary: #2196f3;

#overlay {
  z-index: 1;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;

  .wrapper {
    margin: auto;
    position: relative;
    top: 0%;
    max-width: 360px;
    width: 100%;
    border: 1px solid #dbdbdb;
    background-color: #fff;
    padding: 20px 30px;

    h2 {
      font-size: 18px;
      font-weight: bold;
    }

    hr {
      margin-bottom: 30px;
    }

    .fill {
      margin-bottom: 15px;
    }

    input,
    select,
    textarea {
      background-color: #fafafa;
    }

    .input-group {
      width: 100%;
      margin: 0 auto;
    }
    .custom-file {
      overflow: hidden;
    }
    .custom-file-label {
      white-space: nowrap;
    }
    .btn-group {
      width: 100%;
      .btn {
        width: 25%;
      }
    }

    .button {
      .btn {
        width: 100%;
      }
      .ff4742 .btn-success {
        width: 100%;
      }
    }

    .else {
      margin: 18px 0;
      justify-content: center;
      align-items: center;

      .line {
        background-color: #dbdbdb;
        height: 1px;
        width: 40%;
      }

      .text {
        font-size: 13px;
        margin: 0 10px;
        white-space: nowrap;
      }
    }

    .confirm {
      hr {
        margin-bottom: 20px;
      }
      .forget {
        display: block;
        margin: 0 auto;
      }

      img {
        display: block;
        margin: 0 auto;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
      }

      .row th,
      .row td {
        width: 100%;
        display: block;
      }
    }
  }
  .forget {
    display: block;
    margin: 0 auto;
  }
}

@media screen and (max-width: 767px) {
  /*　画面サイズが767px以下の場合読み込む　*/
  #overlay {
    position: absolute;
    .wrapper {
      margin: 0;
      max-width: 100%;
    }
  }
}
</style>