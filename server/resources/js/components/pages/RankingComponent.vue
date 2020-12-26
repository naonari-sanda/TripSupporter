<template>
  <div>
    <section class="jumbotron text-center d-flex align-items-center visual">
      <div class="bg">
        <img
          class="card-img-top country_img"
          :src="'/storage/ranking.jpg'"
          alt="Card image cap"
        />
        <div class="container text">
          <div class="mb-0">
            <h1 class="jumbotron-heading text-light mb-0">ランキング</h1>
          </div>
          <p class="lead text-light">check your favorite countris ranking</p>

          <a href="#" type="button" class="btn btn-primary"
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
        <h2 v-else-if="isActive == 4">幸福度</h2>

        <table class="table table-hover">
          <thead class="">
            <tr>
              <th scope="col">順位</th>
              <th scope="col">国名</th>
              <th
                scope="col"
                @click="tabChange(1)"
                :class="{ active: isActive === 1 }"
              >
                面積
              </th>
              <th
                scope="col"
                @click="tabChange(2)"
                :class="{ active: isActive === 2 }"
              >
                人口
              </th>
              <th
                scope="col"
                @click="tabChange(3)"
                :class="{ active: isActive === 3 }"
              >
                GDP
              </th>
              <th
                scope="col"
                @click="tabChange(4)"
                :class="{ active: isActive === 4 }"
              >
                幸福度数
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
                    :src="'/storage/' + country.imgpath"
                    :alt="country.name + 'の画像'"
                  />
                  {{ country.name }}</a
                >
              </th>
              <td :class="{ active: isActive === 1 }">
                約{{ country.area.toLocaleString() }}万km2
              </td>

              <td :class="{ active: isActive === 2 }">
                約{{ country.population.toLocaleString() }}万人
              </td>
              <td :class="{ active: isActive === 3 }">
                約{{ country.gdp.toLocaleString() }}万ドル
              </td>
              <td :class="{ active: isActive === 4 }">
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
</style>