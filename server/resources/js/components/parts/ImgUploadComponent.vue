<template>
  <div id="overlay" @click="clickEvent">
    <div class="wrapper" @click="stopEvent" v-show="addModal">
      <div class="header">
        <h2>画像を投稿する:{{ country }}</h2>
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
        <div class="fill" v-if="countryId == 0">
          <validation-provider name="国名" rules="required" v-slot="{ errors }">
            <select
              v-model="country"
              class="form-control"
              id="exampleFormControlSelect1"
            >
              <option disabled value="">国名...</option>
              <option value="1">アメリカ</option>
              <option value="2">カナダ</option>
              <option value="3">メキシコ</option>
              <option value="4">ブラジル</option>
              <option value="5">アルゼンチン</option>
              <option value="6">日本</option>
              <option value="7">中国</option>
              <option value="8">韓国</option>
              <option value="9">インドネシア</option>
              <option value="10">インド</option>
              <option value="11">サウジアラビア</option>
              <option value="12">トルコ</option>
              <option value="13">フランス</option>
              <option value="14">ドイツ</option>
              <option value="15">イタリア</option>
              <option value="16">英国</option>
              <option value="17">ロシア</option>
              <option value="18">南アフリカ</option>
              <option value="19">オーストラリア</option>
              <option value="20">ニュージーランド</option>
            </select>
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="fill">
          <validation-provider name="画像" rules="image" v-slot="ProviderProps">
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-primary">
                  画像選択<input
                    type="file"
                    name="file"
                    ref="file"
                    accept=".png, .jpg, .svg"
                    @change="uploadfile"
                    style="display: none"
                  />
                </span>
              </label>
              <input type="text" class="form-control" readonly="" />
            </div>

            <div class="alert alert-danger" v-show="ProviderProps.errors[0]">
              {{ ProviderProps.errors[0] }}
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
          <img class="img-thumbnail" :src="preview" alt="" />
        </div>
      </div>

      <div class="fill mb-3">
        <table class="table mb-0">
          <tbody>
            <tr>
              <th scope="row">国名</th>
              <td v-if="country == 1">アメリカ</td>
              <td v-if="country == 2">カナダ</td>
              <td v-if="country == 3">メキシコ</td>
              <td v-if="country == 4">ブラジル</td>
              <td v-if="country == 5">アルゼンチン</td>
              <td v-if="country == 6">日本</td>
              <td v-if="country == 7">中国</td>
              <td v-if="country == 8">韓国</td>
              <td v-if="country == 9">インドネシア</td>
              <td v-if="country == 10">インド</td>
              <td v-if="country == 11">サウジアラビア</td>
              <td v-if="country == 12">トルコ</td>
              <td v-if="country == 13">フランス</td>
              <td v-if="country == 14">ドイツ</td>
              <td v-if="country == 15">イタリア</td>
              <td v-if="country == 16">英国</td>
              <td v-if="country == 17">ロシア</td>
              <td v-if="country == 18">南アフリカ</td>
              <td v-if="country == 19">オーストラリア</td>
              <td v-if="country == 20">ニュージーランド</td>
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
</template>

<script>
import { ValidationProvider, ValidationObserver, extend } from "vee-validate";
import { required, max, image } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "{_field_}は必須です",
});

extend("image", {
  ...image,
  message: "{_field_}は有効な画像形式ではありません",
});

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  data: function () {
    return {
      country: "",
      imgpath: "",
      preview: "",
      addModal: true,
      confirmModal: false,
      errors: {},
      success: false,

      uploadedImage: "",
      img_name: "",
    };
  },
  props: {
    userId: {
      type: Number,
    },
    countryId: {
      type: Number | String,
    },
  },
  methods: {
    clickEvent: function () {
      this.$emit("image-child");
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
    uploadfile(event) {
      const path = this.$refs.file.files[0];
      this.preview = URL.createObjectURL(path);

      this.imgpath = event.target.files[0];
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
      formData.append("country_id", this.country);
      formData.append("imgpath", this.imgpath);

      axios
        .post("/upload/img", formData)
        .then((response) => {
          window.location.reload();
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
      margin-bottom: 0;
    }

    hr {
      margin-bottom: 30px;
    }

    .fill {
      margin-bottom: 15px;
    }

    input,
    select,
    textarea,
    .custom-file-label {
      background-color: #fafafa;
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
      .btn-success {
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
        width: 100%;
        height: auto;
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
    // position: absolute;
    .wrapper {
      margin: 0;
      // max-width: 100%;
    }
  }
}
</style>