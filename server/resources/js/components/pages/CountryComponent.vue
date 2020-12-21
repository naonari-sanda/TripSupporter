<template>
  <!-- <div class="col d-flex justify-content-center">
    <div class="card" style="width: 18rem; margin-bottom: 5rem">
      <img
        class="card-img-top"
        src="https://placehold.it/400x230"
        alt="Card image cap"
      />
      <div class="card-body">
        <h5 class="card-title font-weight-bolder">{{ countryDetail.name }}</h5>
        <div class="d-flex">
          <star-rating
            v-bind:increment="0.5"
            v-bind:rating="{{ $country->reviews->avg('recommend') ?? '0' }}"
            text-class="custom-text"
            v-bind:read-only="true"
            v-bind:show-rating="false"
            v-bind:star-size="25"
            active-color="#ff4742"
          ></star-rating>
          <p class="custom-text d-flex align-items-center mb-0 ml-1">
            {{ $country->reviews->avg('recommend') ?? '' }}
          </p>
        </div>
        <p class="card-text mt-2">Some quick example text to build on</p>
        <div class="d-flex">
          <a href="" class="btn btn-primary">詳細はこちら</a>
        </div>
      </div>
    </div>
  </div> -->
  <div>
    成功
    <p>{{ countryDetail.name }}</p>
    <p>{{ reviewAvg }}</p>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  data() {
    return {};
  },
  components: {
    StarRating,
  },
  props: {
    countryDetail: {
      type: Object,
    },
    reviewAvg: {
      type: Number,
    },
  },
};
</script>

<style lang="stylus"></style>