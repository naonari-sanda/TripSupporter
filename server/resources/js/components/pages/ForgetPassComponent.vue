<template>
  <div class="back">
    <div class="wrapper">
      <div class="header">
        <h2>パスワード再設定</h2>
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
      <ValidationObserver
        id="forget"
        action="/password/email"
        method="post"
        @submit.prevent="forget()"
        ref="observer"
        tag="form"
        v-slot="{ invalid }"
      >
        <input type="hidden" name="_token" :value="csrf" />

        <div class="fill mb-4">
          <validation-provider
            name="メールアドレス"
            rules="required|email"
            v-slot="{ errors }"
          >
            <input
              id="email"
              type="email"
              class="form-control"
              name="email"
              v-model="email"
              placeholder="メールアドレス"
              autocomplete="email"
            />
            <div class="alert alert-danger" v-show="errors[0]">
              {{ errors[0] }}
            </div>
          </validation-provider>
        </div>

        <div class="button mb-3">
          <button :disabled="invalid" type="submit" class="btn btn-primary">
            パスワード再設定メールを送信
          </button>
        </div>
      </ValidationObserver>

      <div class="else d-flex">
        <div class="line"></div>
        <div class="text">または</div>
        <div class="line"></div>
      </div>

      <div class="button">
        <a href="/register" class="btn btn-success">ユーザー登録</a>
      </div>
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
  data() {
    return {
      email: "",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  props: {
    errors: {
      type: Object | Array,
      default: {},
    },
  },
  methods: {
    async forget() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        document.querySelector("#forget").submit();
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.back {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #fafafa;

  .wrapper {
    margin: 60px 0 100px;
    position: relative;
    top: -20%;
    max-width: 340px;
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
      margin-bottom: 12px;
    }

    input {
      background-color: #fafafa;
    }

    .button {
      .btn {
        width: 100%;
      }

      .btn-success {
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
}

@media screen and (max-width: 767px) {
  /*　画面サイズが767px以下の場合読み込む　*/
  .back {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #fafafa;

    .wrapper {
      width: 100%;
      margin: 50px 0 60px;
    }
  }
}
</style>