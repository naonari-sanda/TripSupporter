<template>
  <main>
    <section class="jumbotron text-center d-flex align-items-center">
      <div class="container">
        <h1 class="jumbotron-heading text-light mb-0">
          {{ detail.name }}
        </h1>
      </div>
    </section>
    <h1>詳細ページ</h1>
    <p></p>
  </main>
</template>

<script>
export default {
  data: function () {
    return {
      detail: {},
    };
  },
  props: {
    id: Number,
  },
  methods: {
    getDetail() {
      axios.get("/api/detail/" + this.id).then((response) => {
        this.detail = response.data;
      });
    },
  },
  mounted() {
    this.getDetail();
  },
};
</script>

<style scoped>
.jumbotron {
  height: 250px;
}
</style>