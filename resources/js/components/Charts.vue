<template>
    <chart :val="totals" :nameLabel="name" :chartsLabels="labels"/>
</template>

<script>
import Chart from "./Chart";

export default {
    name: 'Charts',

    components: { Chart },

    props: {
        information: {
            type: Array,
            default: () => {
                return [];
            },
        },
        name: {
            type: String,
        }
    },
    data() {
        return {
            totals: [],
            labels: []
        };
    },
    created() {
         _.forEach(this.information, (data) => {
             this.totals.push(data.total);
             this.labels.push(data.label);
         })
    },
}
</script>
