<template>
  <div>
    <section class="jumbotron text-center d-flex align-items-center visual">
      <div class="bg">
        <img
          class="card-img-top country_img"
          src="https://tripsupporter.s3-ap-northeast-1.amazonaws.com/ranking.jpg"
          alt="Card image cap"
        />
        <div class="container text">
          <div class="mb-0">
            <h1 class="jumbotron-heading text-light mb-0 font-weight-bold">
              ランキング
            </h1>
          </div>
          <p class="lead text-light">check your favorite countris ranking</p>

          <a href="/" type="button" class="btn btn-primary"
            >お気に入りの国をさがそう!</a
          >
        </div>
      </div>
    </section>

    <div class="container">
      <ul class="nav d-flex justify-content-around nav nav-tabs">
        <li @click="tabChange(1)" :class="{ active: isActive === 1 }">面積</li>
        <li @click="tabChange(2)" :class="{ active: isActive === 2 }">人口</li>
        <li @click="tabChange(3)" :class="{ active: isActive === 3 }">GDP</li>
        <li @click="tabChange(4)" :class="{ active: isActive === 4 }">
          幸福度
        </li>
      </ul>
      <article>
        <h2 v-if="isActive == 1">面積</h2>
        <h2 v-else-if="isActive == 2">人口</h2>
        <h2 v-else-if="isActive == 3">GDP</h2>
        <h2 v-else-if="isActive == 4">
          幸福度
          <a
            href="https://ja.wikipedia.org/wiki/%E4%B8%96%E7%95%8C%E5%B9%B8%E7%A6%8F%E5%BA%A6%E5%A0%B1%E5%91%8A"
            class="h4"
            >(世界幸福度報告:wikipedia)</a
          >
        </h2>

        <table class="table table-hover">
          <thead class="">
            <tr>
              <th scope="col">順位</th>
              <th scope="col">国名</th>
              <th
                scope="col"
                @click="tabChange(1)"
                class="tag"
                :class="{ active: isActive === 1 }"
              >
                面積
              </th>
              <th
                scope="col"
                @click="tabChange(2)"
                class="tag"
                :class="{ active: isActive === 2 }"
              >
                人口
              </th>
              <th
                scope="col"
                @click="tabChange(3)"
                class="tag"
                :class="{ active: isActive === 3 }"
              >
                GDP
              </th>
              <th
                scope="col"
                @click="tabChange(4)"
                class="tag"
                :class="{ active: isActive === 4 }"
              >
                幸福度
              </th>
              <th scope="col">詳細</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(country, index) in countries" :key="index">
              <th>{{ index + 1 }}位</th>
              <th>
                <a
                  :href="'/detail/' + country.id"
                  class="text-dark d-flex align-items-center"
                >
                  <img
                    class="cycle img-thumbnail mr-2"
                    :src="country.imgpath"
                    :alt="country.name + 'の画像'"
                  />
                  {{ country.name }}</a
                >
              </th>
              <td class="tag" :class="{ active: isActive === 1 }">
                約{{ country.area.toLocaleString() }}万km2
              </td>

              <td class="tag" :class="{ active: isActive === 2 }">
                約{{ country.population.toLocaleString() }}万人
              </td>
              <td class="tag" :class="{ active: isActive === 3 }">
                約{{ country.gdp.toLocaleString() }}万ドル
              </td>
              <td class="tag" :class="{ active: isActive === 4 }">
                {{ country.happiness.toLocaleString() }}
              </td>
              <td>
                <a :href="'/detail/' + country.id" class="btn btn-primary"
                  >詳細</a
                >
              </td>
            </tr>
          </tbody>
        </table>
      </article>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isActive: 1,
      countries: [],
    };
  },
  methods: {
    //タグの変更
    tabChange: function (num) {
      this.isActive = num;

      if (num === 1) {
        axios
          .get("/api/area")
          .then((res) => {
            this.countries = res.data;
          })
          .catch((error) => {
            alert("失敗");
          });
      } else if (num === 2) {
        axios
          .get("/api/population")
          .then((res) => {
            this.countries = res.data;
          })
          .catch((error) => {
            alert("失敗");
          });
      } else if (num === 3) {
        axios
          .get("/api/gdp")
          .then((res) => {
            this.countries = res.data;
          })
          .catch((error) => {
            alert("失敗");
          });
      } else {
        axios
          .get("/api/happiness")
          .then((res) => {
            this.countries = res.data;
          })
          .catch((error) => {
            alert("失敗");
          });
      }
    },
  },
  mounted() {
    axios
      .get("/api/area")
      .then((res) => {
        this.countries = res.data;
      })
      .catch((error) => {
        alert("失敗");
      });
  },
};
</script>

<style lang="scss" scoped>
td {
  vertical-align: middle;
}

table tr:hover {
  background-color: #d4f0fd;
}

label {
  margin-bottom: 0;
}

table {
  tbody {
    .active {
      border-bottom: #dee2e6;
    }
  }

  th {
    cursor: pointer;
    vertical-align: middle;
    .active {
      color: #1da1f2;
      border-bottom: #dee2e6;
    }
  }
}
@media screen and (max-width: 567px) {
  /*　画面サイズが567px以下の場合読み込む　*/
  .tag {
    display: none;
  }

  .active {
    display: table-cell;
  }
}
</style>