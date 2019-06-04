window.moment = require('moment')
window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
};

$(document).ready(function() {
    var ctx = document.getElementById("chart-count-view-lesson");
    var chartCountViewLession = new Chart(ctx, {
        type: 'line',

        data: {
            labels: [],
            datasets: [{
                label: NUM_BOOKING,
                data: [],
                fill: false,
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
            },
            {
                label: NUM_PAID,
                data: [],
                fill: false,
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                mode: 'point',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Time'
                    },
                    ticks: {
                        callback: function(value, index, values) {
                            return value;
                        },
                    },
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Value'
                    },
                    ticks: {
                        suggestedMin: 0,
                        callback: function(value, index, values) {
                            if (Math.floor(value) === value) {
                                return value;
                            }
                        },
                    },
                }]

            },
            title: {
                display: false,
            },
        }
    });

    function showChart(typeRange) {
        let dateEnd = moment();
        let dateStart = moment().subtract(30, 'days');
        $.ajax({
            url: route('admin.dashboard.getChartCountViewLesson'),
            method: 'GET',
            data: {type_range: typeRange},
        }).done(function(response) {
                console.log(response, 'check d1')

            if (response.success) {
                let data = response.data
                let timeValues = []
                console.log(response.success, 'check data view')
                switch (typeRange) {
                    case 'day':
                        while(dateStart.add(1, 'days').diff(dateEnd) < 0) {
                            timeValues.push(dateStart.clone().format('YYYY-MM-DD'));
                            console.log(response, 'check data view')
                        }
                        break;

                    case 'week':
                        let dateStartWeek = dateStart.endOf('isoWeek');
                        while(dateStartWeek.add(1, 'week').diff(dateEnd) < 0) {
                            timeValues.push(dateStartWeek.clone().format('YYYY-MM-DD'));
                        }
                        break;

                    case 'month':
                        let monthStart = moment().subtract(1, 'years')
                        while(monthStart.add(1, 'month').diff(dateEnd) < 0) {
                            timeValues.push(monthStart.clone().format('YYYY-MM'));
                        }
                        break;

                    default:
                        break;
                }

                Array.prototype.diff = function (a) {
                    return this.filter(function (i) {
                        return a.indexOf(i) === -1;
                    });
                };

                let timeArr = data.map((item) => {
                        return item.time
                    }
                )
                let emptyData = timeValues.diff(timeArr);
                let temp = emptyData.forEach(function (e) {
                    let addData = {
                        num_booking: 0,
                        num_paid: 0,
                        time: e}
                    data.push(addData)
                })
                data.sort((a,b) => (a.time > b.time) ? 1 : ((b.time > a.time) ? -1 : 0));
                let dataView = data.map((item) => {
                    return item.num_booking
                })
                let dataClient = data.map((item) => {
                    return item.num_paid
                })
                let labels = data.map((item) => {
                    let labelTime = new Date(item.time)

                    if (typeRange == 'month') {
                        return labelTime.toLocaleString('vi', {month: 'long', year: 'numeric' });
                    }

                    return labelTime.toLocaleString('vi', {day: 'numeric' ,month: 'long', year: 'numeric' });
                })

                chartCountViewLession.data.datasets[0].data = dataView
                chartCountViewLession.data.datasets[1].data = dataClient
                chartCountViewLession.data.labels = labels
                chartCountViewLession.update()
            }
        });
    }

    $('body').on('click', '.btn-chart-select', function(){
        $('.btn-chart-select').removeClass('active');
        $(this).addClass('active');
        let type = $(this).data('type');
        showChart(type)
    });

    $('.default-chart').addClass('active');
    let type = 'day'
    showChart(type)
})
