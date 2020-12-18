<template>
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
</template>