<template>
  <div id="overlay" @click="clickEvent">
    <div class="wrapper" @click="stopEvent">
      <div class="header">
        <h2>プロフィールを追加する</h2>
      </div>
      <hr />
      <div v-if="Object.keys(errors).length > 0">
        <ul class="alert alert-danger text-center">
          <template v-for="(message, key) in errors">
            <li
              v-for="(value, i) in message"
              :key="key + i"
              style="list-style: none"
            >
              {{ value }}
            </li>
          </template>
        </ul>
      </div>
      <ValidationObserver @submit.prevent="acount()" ref="observer" tag="form">
        <div class="fill">
          <validation-provider name="年齢" rules="required" v-slot="{ errors }">
            <select
              class="form-control"
              id="exampleFormControlSelect1"
              v-model="age"
            >
              <option disabled value="">年齢</option>
              <option value="10代〜">10代〜</option>
              <option value="20代〜">20代〜</option>
              <option value="30代〜">30代〜</option>
              <option value="40代〜">40代〜</option>
              <option value="50代〜">50代〜</option>
            </select>
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill">
          <validation-provider name="性別" rules="required" v-slot="{ errors }">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <label class="btn btn-primary">
                <input
                  type="radio"
                  name="options"
                  id="option1"
                  autocomplete="off"
                  v-model="gender"
                  value="男性"
                />男性
              </label>
              <label class="btn btn-primary">
                <input
                  type="radio"
                  name="options"
                  id="option2"
                  autocomplete="off"
                  v-model="gender"
                  value="女性"
                />女性
              </label>
              <label class="btn btn-primary">
                <input
                  type="radio"
                  name="options"
                  id="option3"
                  autocomplete="off"
                  v-model="gender"
                  value="その他"
                />その他
              </label>
              <label class="btn btn-primary">
                <input
                  type="radio"
                  name="options"
                  id="option4"
                  autocomplete="off"
                  v-model="gender"
                  value="無回答"
                />無回答
              </label>
            </div>
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill">
          <validation-provider
            name="アイコン"
            rules="image"
            v-slot="ProviderProps"
          >
            <div class="input-group mb-1">
              <div class="custom-file">
                <input
                  type="file"
                  class="custom-file-input"
                  id="customFile"
                  ref="file"
                  @change="uploadfile"
                />
                <label
                  class="custom-file-label"
                  for="customFile"
                  data-browse="参照"
                  >アイコン画像...</label
                >
              </div>
              <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary reset">
                  取消
                </button>
              </div>
            </div>
            <div class="alert alert-danger" v-show="ProviderProps.errors[0]">
              {{ ProviderProps.errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill">
          <validation-provider name="趣味" rules="max:30" v-slot="{ errors }">
            <input
              class="form-control"
              type="text"
              v-model="hobby"
              placeholder="趣味"
            />

            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill mb-4">
          <validation-provider
            name="プロフィール"
            rules="required|max:150"
            v-slot="{ errors }"
          >
            <textarea
              class="form-control"
              rows="4"
              v-model="profile"
              placeholder="プロフィール欄"
            />

            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="button mb-3">
          <button type="submit" class="btn btn-primary">
            プロフィール追加
          </button>
        </div>
      </ValidationObserver>

      <a class="forget btn-link text-center" @click="clickEvent">ー 戻る ー</a>
      {{ gender }}:{{ age }}:{{ hobby }}:{{ profile }}:{{ icon }}:{{ preview }}
    </div>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import { required, email } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "{_field_}は必須です",
});

extend("email", {
  ...email,
  message: "{_field_}は必須です",
});

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data: function () {
    return {
      age: "",
      gender: "",
      hobby: "",
      profile: "",
      icon: "",
      preview: "",
      errors: {},
      success: false,
    };
  },
  props: {
    userId: {
      type: Number,
    },
  },
  methods: {
    clickEvent: function () {
      this.$emit("profile-child");
    },
    stopEvent: function () {
      event.stopPropagation();
    },
    uploadfile(event) {
      //   const path = this.$refs.file.files[0];
      //   this.preview = URL.createObjectURL(path);

      //   let formData = new FormData();
      //   this.icon = formData.append("file", this.preview);
      var file = event.target.files[0];
      this.icon = file.name;
    },
    async acount() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        axios
          .post("/api/mypage/create/profile", {
            user_id: this.userId,
            gender: this.gender,
            age: this.age,
            profile: this.profile,
            hobby: this.hobby,
            icon: this.icon,
          })
          .then((response) => {
            window.location.href = "/mypage";
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
            this.success = false;
          });
      } else {
        // alert("失敗");
      }
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

    .button {
      .btn {
        width: 100%;
      }
      .ff4742 .btn-success {
        width: 100%;
      }
    }

    .forget {
      display: block;
      margin: 0 auto;
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
  }
  .alert {
    padding: 0.5rem 1.25rem;
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