<template>
    <div class="w-full">
        <custom-select
            class="w-full"
            v-model="selected"
            label="name"
            :options="options"
        />
        <input
            type="hidden"
            :name="$attrs.name"
            :value="selected ? selected.id : null"
        />
    </div>
</template>

<script>
import CustomSelect from "vue-select";

export default {
    name: "VSelect",
    components: { CustomSelect },
    props: {
        initial: null,
        options: Array,
    },
    data() {
        return {
            selected: this.initial,
        };
    },
};
</script>
