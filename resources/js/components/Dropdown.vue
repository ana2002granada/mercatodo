<template>
    <div v-click-outside="() => {open = false}" @close.stop="open = false" v-cloak>
        <div @click="open = !open">
            <slot name="trigger"></slot>
        </div>

        <div  :class="'absolute z-50 mt-2 '+ width + ' rounded-md shadow-lg '+ alignmentClasses" v-show="open">
            <transition
                enter-class="transition ease-out duration-200"
                enter-active-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-class="transition ease-in duration-75"
                leave-active-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
                style="display: none;"
            >
                <div :class="'rounded-md ring-1 ring-black ring-opacity-5 '+ contentClasses">
                    <slot></slot>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'

export default {
    name: "Dropdown",
    props:{
        contentClasses: '',
        alignmentClasses: '',
        width: '',
    },
    data() {
        return {
            open: false,
        }
    },
    directives: {
        ClickOutside
    }
}
</script>
