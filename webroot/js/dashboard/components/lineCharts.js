// import { Line, mixins } from '../vueCharts.js'
const Line = window.vueChartjs
const mixins = window.vueChartjs
const { reactiveProp } = mixins

export const lineCharts = {
    extends: Line,
    mixins: [reactiveProp],
    props: ['options'],
    mounted () {
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, this.options)
    }
}