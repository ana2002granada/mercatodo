<template>
    <div
        :class="
            'fixed bg-' +
            type +
            '-100 border-l-4 border-' +
            type +
            '-500 text-' +
            type +
            '-700 p-4 z-50 bottom-16 right-0'
        "
        role="alert"
        v-show="show"
    >
        <p class="font-bold">{{ title }}</p>
        <p>{{ body }}</p>
    </div>
</template>

<script>
const TYPES = {
    error: "red",
    success: "green",
};

export default {
    name: "Alert",
    data() {
        return {
            show: false,
            body: "",
            title: "",
            type: "success",
            message: window.message ?? [],
        };
    },
    created() {
        if (this.message.length) {
            this.message.forEach((data) => {
                this.flash(data.type, data.title, data.message);
            });
        }
    },
    mounted() {
        this.$root.$on("show-alert", (data) => {
            this.flash(data.type, data.title, data.message);
        });
    },
    methods: {
        flash(type, title, message) {
            this.show = true;
            this.type = this.transformType(type);
            this.title = title;
            this.body = message;

            setTimeout(() => {
                this.hide();
            }, 3000);
        },
        transformType(type) {
            return TYPES[type] ?? "green";
        },
        hide() {
            this.show = false;
        },
    },
};
</script>
