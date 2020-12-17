<template>
  <div id="overlay" @click="clickEvent">
    <div class="wrapper" @click="stopEvent" v-show="addModal">
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
      <ValidationObserver @submit.prevent="check()" ref="observer" tag="form">
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
                  name="file"
                  class="custom-file-input"
                  id="customFile"
                  ref="file"
                  accept=".png, .jpg, .svg"
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
                <button
                  @click="iconReset"
                  type="button"
                  class="btn btn-outline-secondary reset"
                >
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
          <validation-provider name="趣味" rules="max:50" v-slot="{ errors }">
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
          <button type="submit" class="btn btn-primary">確認</button>
        </div>
      </ValidationObserver>

      <a class="forget btn-link text-center" @click="clickEvent">ー 戻る ー</a>
    </div>

    <div class="wrapper" @click="stopEvent" v-show="confirmModal">
      <div class="confirm">
        <div class="header">
          <h2>プロフィールを確認する</h2>
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
        <div class="fill mb-4">
          <img v-if="preview" class="img-thumbnail" :src="preview" alt="" />
          <img
            v-else-if="gender === '男性'"
            src="http://localhost/storage/men.png"
            alt=""
          />
          <img
            v-else-if="gender === '女性'"
            src="http://localhost/storage/women.png"
            alt=""
          />
          <img v-else src="http://localhost/storage/none.png" alt="" />
        </div>

        <div class="fill mb-3">
          <table class="table mb-0">
            <tbody>
              <tr>
                <th scope="row">年齢</th>
                <td>{{ age }}</td>
              </tr>
              <tr>
                <th scope="row">性別</th>
                <td>{{ gender }}</td>
              </tr>
            </tbody>
          </table>
          <table class="table mb-0">
            <tbody>
              <tr>
                <th scope="row" style="white-space: nowrap">趣味</th>
              </tr>
              <tr>
                <td v-if="hobby" class="pt-0" style="border-top: none">
                  {{ hobby }}
                </td>
              </tr>
            </tbody>
          </table>
          <table class="table">
            <tbody>
              <tr>
                <th scope="row" style="white-space: nowrap">プロフィール</th>
              </tr>
              <tr>
                <td v-if="profile" class="pt-0" style="border-top: none">
                  {{ profile }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="button mb-3">
          <button @click="confirm" type="submit" class="btn btn-primary">
            プロフィール追加
          </button>
        </div>

        <a class="forget btn-link text-center" @click="backEvent">ー 戻る ー</a>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import { required, max } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "{_field_}は必須です",
});

extend("max", {
  ...max,
  message: "{_field_}は最大でも{length}文字までです",
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
      addModal: true,
      confirmModal: false,
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
    confirmEvent: function () {
      this.addModal = false;
      this.confirmModal = true;
    },
    backEvent: function () {
      this.addModal = true;
      this.confirmModal = false;
    },
    iconReset: function () {
      this.preview = "";
    },
    uploadfile(event) {
      const path = this.$refs.file.files[0];
      this.preview = URL.createObjectURL(path);

      this.icon = event.target.files[0];
    },

    async check() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        this.addModal = false;
        this.confirmModal = true;
      }
    },
    confirm: function () {
      const formData = new FormData();
      formData.append("user_id", this.userId);
      formData.append("gender", this.gender);
      formData.append("age", this.age);
      formData.append("profile", this.profile);
      formData.append("hobby", this.hobby);
      formData.append("icon", this.icon);

      axios
        .post("/mypage/create/profile", formData)
        .then((response) => {
          window.location.href = "/mypage";
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          this.success = false;
        });
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
        width: 160px;
        height: 160px;
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