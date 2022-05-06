<script>
export default {
    name: "Modal",
    props: {
        nameModal: '',
    },
    data() {
        return {
            showModal: false,
            data: {},
        };
    },
    mounted() {
        this.$root.$on("open-modal-" + this.nameModal, (data) => {
            this.showModal = true;
            this.data = data;
        });
    },
};
</script>
