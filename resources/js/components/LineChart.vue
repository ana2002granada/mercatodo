<template>
  <canvas id="myChart"></canvas>
</template>

<script>
import { Chart, registerables } from 'chart.js';
import dayjs from 'dayjs';
Chart.register(...registerables)

export default {

    name: "LineChart",

    props: {
        information: {
            type: Object,
            default: () => {
                return {};
            },
        },
    },

    mounted() {
        this.getChart();
    },

    data() {
        return {
            totalsRejected: [],
            totalsPending: [],
            totalsSuccessful: [],
            rejected: [],
            pending: [],
            successful: [],
        };
    },

    computed: {
            labels() {
                return this.getDays();
            }
        },

    methods: {

        formatData() {
            this.successful = this.information.successful;
            this.rejected = this.information.rejected;
            this.pending = this.information.pending;
            _.forEach(this.labels, (label)=> {
                 _.forEach(this.successful, (data) => {

                     this.totalsSuccessful[label] = data.date === label ? data.total : (this.totalsSuccessful[label] ?? 0);
                })
                 _.forEach(this.rejected, (data) => {
                     this.totalsRejected[label] = data.date === label ? data.total : (this.totalsRejected[label] ?? 0);
                })
                 _.forEach(this.pending, (data) => {
                     this.totalsPending[label] = data.date === label ? data.total : (this.totalsPending[label] ?? 0);
                })
            })
            this.totalsSuccessful = _.values(this.totalsSuccessful);
            this.totalsRejected = _.values(this.totalsRejected);
            this.totalsPending = _.values(this.totalsPending);
        },

        getDays() {
            const dates = [];
            let currentDate = this.addDays( 1);
            let days = 5;
            while (days > 0) {
                currentDate = this.addDays(days);
                dates.push(currentDate);
                days= days-1;
            }
            return dates;
        },

        addDays(days) {
            return dayjs().add(-days, 'day').format('YYYY-MM-DD');
        },

        getChart() {
            this.formatData();
            return new Chart(
                document.getElementById('myChart'),
                {
                    type: 'line',
                    data: this.getData(),
                    options: {
                        responsive: true
                        },
                    }
                );
            },
        getData() {
            return {
                labels: this.labels,
                datasets: [
                    {
                        label: 'successful',
                        fill: false,
                        borderColor: 'rgb(44,212,16)',
                        tension: 0.1,
                        data: this.totalsSuccessful,
                    },
                    {
                        label: 'rejected',
                        fill: false,
                        borderColor: 'rgb(186,43,43)',
                        tension: 0.1,
                        data: this.totalsRejected,
                    },
                    {
                        label: 'pending',
                        fill: false,
                        borderColor: 'rgb(214,220,10)',
                        tension: 0.1,
                        data: this.totalsPending,
                    }
                ],
            }
        },

    },
}

</script>

