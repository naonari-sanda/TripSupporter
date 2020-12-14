<template>
  <div id="overlay" v-on:click="clickEvent">
    <div class="wrapper">
      <div class="header d-flex align-items-center">
        <h5 class="title">レビューを投稿</h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="閉じる"
          v-on:click="clickEvent"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="body" v-on:click="stopEvent">
        <div
          v-if="
            (errors.safe,
            errors.cost,
            errors.tourism,
            errors.food,
            errors.english,
            errors.fun)
          "
          class="alert alert-danger text-center"
        >
          評価は１以上で記入してください
        </div>
        <div v-show="min" class="alert alert-danger text-center">
          評価は１以上で記入してください
        </div>
        <ValidationObserver
          class="form-horizontal"
          enctype="multipart/form-data"
          ref="observer"
          action="/detail/review/post"
          method="post"
          id="review"
          tag="form"
          @submit.prevent="onSubmit()"
        >
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="country_id" :value="countryId" />
          <input type="hidden" name="user_id" :value="userId" />
          <input type="hidden" name="recommend" :value="recommend" />
          <validation-provider rules="required|min_value:1">
            <div class="star d-flex align-items-center">
              <label class="">治安</label>
              <div class="d-flex align-items-center" style="line-heigth: 1.6">
                <star-rating
                  v-bind:increment="1"
                  v-model="safe"
                  v-bind:show-rating="true"
                  v-bind:star-size="28"
                ></star-rating>

                <input type="hidden" name="safe" :value="safe" />
              </div>
            </div>
          </validation-provider>

          <validation-provider rules="required|min_value:1">
            <div class="star d-flex align-items-center">
              <label>費用</label>
              <div class="d-flex align-items-center">
                <star-rating
                  v-bind:increment="1"
                  v-model="cost"
                  v-bind:show-rating="true"
                  v-bind:star-size="28"
                ></star-rating>

                <input type="hidden" name="cost" :value="cost" />
              </div>
            </div>
          </validation-provider>

          <validation-provider rules="required|min_value:1">
            <div class="star d-flex align-items-center">
              <label>観光</label>
              <div class="d-flex align-items-center">
                <star-rating
                  v-bind:increment="1"
                  v-model="tourism"
                  v-bind:show-rating="true"
                  v-bind:star-size="28"
                ></star-rating>

                <input type="hidden" name="tourism" :value="tourism" />
              </div>
            </div>
          </validation-provider>

          <validation-provider rules="required|min_value:1">
            <div class="star d-flex align-items-center">
              <label>料理</label>
              <div class="d-flex align-items-center">
                <star-rating
                  v-bind:increment="1"
                  v-model="food"
                  v-bind:show-rating="true"
                  v-bind:star-size="28"
                ></star-rating>

                <input type="hidden" name="food" :value="food" />
              </div>
            </div>
          </validation-provider>

          <validation-provider rules="required|min_value:1">
            <div class="star d-flex align-items-center">
              <label>英語</label>
              <div class="d-flex align-items-center">
                <star-rating
                  v-bind:increment="1"
                  v-model="english"
                  v-bind:show-rating="true"
                  v-bind:star-size="28"
                ></star-rating>

                <input type="hidden" name="english" :value="english" />
              </div>
            </div>
          </validation-provider>

          <validation-provider rules="required|min_value:1">
            <div class="star d-flex align-items-center mb-3">
              <label>楽しさ</label>
              <div class="d-flex align-items-center">
                <star-rating
                  v-bind:increment="1"
                  v-model="fun"
                  v-bind:show-rating="true"
                  v-bind:star-size="28"
                ></star-rating>

                <input
                  class="form-control"
                  type="hidden"
                  name="fun"
                  :value="fun"
                />
              </div>
            </div>
          </validation-provider>

          <validation-provider name="画像" rules="image" v-slot="{ errors }">
            <div class="input-group mb-1">
              <div class="custom-file">
                <input
                  type="file"
                  class="custom-file-input"
                  id="customFile"
                  name="imgpath"
                  accept=".png, .jpg, .svg"
                />
                <label
                  class="custom-file-label"
                  for="customFile"
                  data-browse="参照"
                  >ファイル選択...</label
                >
              </div>
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary reset">
                  取消
                </button>
              </div>
            </div>
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>

          <div class="">
            <label class="review">レビュー</label>
            <div class="mx-auto">
              <validation-provider
                name="レビュー"
                rules="required|max:200"
                v-slot="{ errors }"
              >
                <textarea class="form-control" name="review" v-model="review" />

                <div class="alert alert-danger" v-show="errors[0]">
                  {{ errors[0] }}
                </div>
              </validation-provider>
              <div
                v-if="errors.review"
                class="error alert alert-danger text-center"
              >
                {{ errors.review }}
              </div>
            </div>
          </div>

          <div class="">
            <button class="button" type="submit">
              <i class="spinner"></i>
              <span class="state">投稿</span>
            </button>
          </div>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import { required, max, min_value, image } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "{_field_}は必須です",
});
extend("max", {
  ...max,
  message: "{_field_}は最大でも{length}文字までです",
});
extend("min_value", {
  ...min_value,
  message: "評価は{min}以上でなければなりません",
});
extend("image", {
  ...image,
  message: "{_field_}は有効な画像形式ではありません",
});

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
      imgpath: "",

      min: false,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  components: {
    StarRating,
    ValidationProvider,
    ValidationObserver,
  },
  props: {
    countryId: {
      type: Number,
    },
    userId: {
      type: Object | Array,
    },
    errors: {
      type: Object | Array,
    },
  },
  computed: {
    recommend: function () {
      let $sum =
        this.safe +
        this.cost +
        this.fun +
        this.tourism +
        this.food +
        this.english;

      let $total = $sum / 6;
      return Math.round($total * 10) / 10;
    },
  },
  methods: {
    async onSubmit() {
      if (
        this.safe >= 1 &&
        this.cost >= 1 &&
        this.fun >= 1 &&
        this.tourism >= 1 &&
        this.english >= 1
      ) {
        this.min = false;
      } else {
        this.min = true;
      }
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        document.querySelector("#review").submit();
      }
    },
    clickEvent: function () {
      this.$emit("review-child");
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
}

.wrapper {
  top: -10%;
  max-width: 340px;
  background: #fff;
  position: relative;
}

.header {
  padding: 18px 20px;
  border-bottom: 2px solid #eee;
  margin-bottom: 8px;

  h5 {
    font-size: 15px;
    margin-bottom: 0;
    margin-right: auto;
  }
}

.body {
  padding: 0 20px;
  padding-bottom: 80px;
}
label {
  margin-bottom: 0;
}

.star {
  width: 80%;
  margin: 0 auto;
  margin-bottom: 6px;
  label {
    margin-bottom: 0;
    width: 20%;
  }
}

.button {
  width: 100%;
  height: 100%;
  padding: 10px 10px;
  background: $primary;
  color: #fff;
  display: block;
  border: none;
  margin-top: 20px;
  max-height: 60px;
  border: 0px solid rgba(0, 0, 0, 0.1);
  border-radius: 0 0 2px 2px;
  transform: rotateZ(0deg);

  transition: all 0.1s ease-out;
  border-bottom-width: 7px;
  position: absolute;
  left: 0px;

  .spinner {
    display: block;
    width: 40px;
    height: 40px;
    position: absolute;
    border: 4px solid #ffffff;
    border-top-color: rgba(255, 255, 255, 0.3);
    border-radius: 100%;
    left: 50%;
    top: 0;
    opacity: 0;
    margin-left: -20px;
    margin-top: -20px;
    animation: spinner 0.6s infinite linear;
    transition: top 0.3s 0.3s ease, opacity 0.3s 0.3s ease,
      border-radius 0.3s ease;
    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.2);
  }
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
.alert {
  margin-bottom: 5px;
  padding: 0.5rem 1.25rem;
}
</style>