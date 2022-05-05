<template>
    <div class="w-full top-20 z-10 fixed">
        <header class="bg-white py-2 shadow-md">
            <div class="relative mx-16">
                <div class="flex py-2">
                    <a
                        :class="
                            'cursor-pointer hover:text-green-800' +
                            (isOpen ? ' text-green-800' : '')
                        "
                        @click="isOpen = !isOpen"
                    >
                        <em class="mr-2 fas fa-search"></em> {{ searchText }}
                    </a>
                </div>
                <collapse-transition>
                    <slot v-if="isOpen" />
                </collapse-transition>
            </div>
        </header>
    </div>
</template>

<script>
import { CollapseTransition } from "@ivanv/vue-collapse-transition";

export default {
    name: "SearchBar",
    components: {
        CollapseTransition,
    },
    props: {
        searchText: "",
    },
    data() {
        return {
            isOpen: false,
        };
    },
};
</script>
