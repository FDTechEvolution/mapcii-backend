import {lineCharts} from './components/lineCharts.js'

new Vue ({
    el: '#dashboard',
    components: {
        'line-chart' : lineCharts
    },
    data () {
        return {
          datacollection: null
        }
    },
    mounted () {
        this.fillData()
    },
    methods: {
        fillData () {
            this.datacollection = {
            labels: [this.getRandomInt(), this.getRandomInt()],
            datasets: [
                    {
                        label: 'Data One',
                        backgroundColor: '#f87979',
                        data: [this.getRandomInt(), this.getRandomInt()]
                    }, {
                        label: 'Data One',
                        backgroundColor: '#f87979',
                        data: [this.getRandomInt(), this.getRandomInt()]
                    }
                ]  
            }
        },
        getRandomInt () {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        }
    }
})