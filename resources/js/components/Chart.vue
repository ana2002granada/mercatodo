<template v-cloak>
    <canvas class="m-auto" :id="nameLabel"/>
</template>

<script>
    import { Chart, registerables } from 'chart.js';

    Chart.register(...registerables)

    export default {
        name: 'Chart',
        components: { Chart },

        props: {
            val: Array,
            nameLabel: String,
            chartsLabels: Array
        },


        mounted() {
            this.getChart(this.val);
        },

        methods: {
            getChart(newData) {
                return new Chart(
                    document.getElementById(this.nameLabel),
                    {
                    type: 'doughnut',
                    data: this.getData(newData),
                    options: {
                        responsive: true
                    },
                    }
                );
            },
            getData(data) {
                return {
                    labels: this.chartsLabels,
                    datasets: [{
                        label: this.nameLabel,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(99,193,255)',
                            'rgb(220,226,18)',
                            'rgb(229,100,9)',
                            'rgb(69,229,72)',
                        ],
                        borderColor: 'rgb(0,0,0)',
                        data: data,
                    }],
                }
            },
        },
    }
</script>
