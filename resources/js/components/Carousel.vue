<template>
    <vue-horizontal-list
        :items="items"
        :options="{
    responsive: [
      { end: 576, size: 1 },
      { start: 576, end: 768, size: 2 },
      { start: 313, end: 1100, size: 3 },
      { size: 4 },
    ],
  }"
    >
        <template v-slot:default="{item}">
            <div class="item">
                <slot name="card" v-bind:item="item"/>
            </div>
        </template>
    </vue-horizontal-list>
</template>



<script>
import VueHorizontalList from "vue-horizontal-list";

export default {
    name: "Carousel",
    components: {VueHorizontalList},
    props: {
        items: {
            type: Array,
            default: () => { return [] },
        },
    }
};
</script>
