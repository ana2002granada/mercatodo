<script>
export default {
    name: 'Modal',
    data() {
        return {
            showModal: false,
            data: {},
        }
    },
    mounted() {
        this.$root.$on('open-modal', (data) => {
            this.showModal = true
            this.data = data
        })
    }
};
</script>
