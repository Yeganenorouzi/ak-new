/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Echarts Init Js File
*/

// get colors array from the string
function getChartColorsArray(chartId) {
    var colors = $(chartId).attr('data-colors');
    var colors = JSON.parse(colors);
    return colors.map(function (value) {
        var newValue = value.replace(' ', '');
        if (newValue.indexOf('--') != -1) {
            var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
            if (color) return color;
        } else {
            return newValue;
        }
    })
}

// line chart
var lineColors = getChartColorsArray("#line-chart");
var lineDom = document.getElementById("line-chart");
var lineChart = echarts.init(lineDom);
var app = {};
option = null;
option = {
    // تنظیم شبکه
    grid: {
        left: '0%',
        right: '0%',
        bottom: '0%',
        top: '4%',
        containLabel: true
    },
    xAxis: {
        type: 'category',
        data: ['دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه', 'یک‌شنبه'],
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
    },
    yAxis: {
        type: 'value',
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
        splitLine: {
            lineStyle: {
                color: "rgba(133, 141, 152, 0.1)"
            }
        }
    },
    series: [{
        data: [820, 932, 901, 934, 1290, 1330, 1320],
        type: 'line'
    }],
    color: lineColors //['#2ab57d'],
};

;
if (option && typeof option === "object") {
    lineChart.setOption(option, true);
}



// mix line & bar
var mixlinebarColors = getChartColorsArray("#mix-line-bar");
var mixLineDom = document.getElementById("mix-line-bar");
var mixLineChart = echarts.init(mixLineDom);
var app = {};
option = null;
app.title = 'Data view';

option = {
    // تنظیم شبکه
    grid: {
        left: '1%',
        right: '0%',
        bottom: '0%',
        top: '4%',
        containLabel: true
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            crossStyle: {
                color: '#999'
            }
        }
    },
    color: mixlinebarColors, //['#2ab57d', '#5156be', '#fd625e'],
    legend: {
        top: '0',
        data: ['تبخیر', 'باران', 'میانگین دما'],
        textStyle: { color: '#858d98' }
    },
    xAxis: [
        {
            type: 'category',
            data: ['بهمن', 'دی', 'آذر', 'آبان', 'مهر', 'شهریور', 'مرداد', 'تیر'],
            axisPointer: {
                type: 'shadow'
            },
            axisLine: {
                lineStyle: {
                    color: '#858d98'
                },
            },
        }
    ],
    yAxis: [
        {
            type: 'value',
            name: 'حجم آب',
            min: 0,
            max: 250,
            interval: 50,
            axisLine: {
                lineStyle: {
                    color: '#858d98'
                },
            },
            splitLine: {
                lineStyle: {
                    color: "rgba(133, 141, 152, 0.1)"
                }
            },
            axisLabel: {
                formatter: '{value} میلی‌لیتر'
            }
        },
        {
            type: 'value',
            name: 'دما',
            min: 0,
            max: 25,
            interval: 5,
            axisLine: {
                lineStyle: {
                    color: '#858d98'
                },
            },
            splitLine: {
                lineStyle: {
                    color: "rgba(133, 141, 152, 0.1)"
                }
            },
            axisLabel: {
                formatter: '{value} درجه سانتی‌گراد'
            }
        }
    ],
    series: [
        {
            name: 'تبخیر',
            type: 'bar',
            data: [2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2]
        },
        {
            name: 'باران',
            type: 'bar',
            data: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2]
        },
        {
            name: 'میانگین دما',
            type: 'line',
            yAxisIndex: 1,
            data: [2.0, 2.2, 3.3, 4.5, 6.3, 10.2, 20.3, 23.4]
        }
    ]
};

;
if (option && typeof option === "object") {
    mixLineChart.setOption(option, true);
}


// Doughnut Chart
var doughnutColors = getChartColorsArray("#doughnut-chart");
var doughnutDom = document.getElementById("doughnut-chart");
var doughnutChart = echarts.init(doughnutDom);
var app = {};
option = null;

option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        x: 'left',
        data: ['لپتاپ', 'تبلت', 'موبایل', 'دیگران', 'رایانه رومیزی'],
        textStyle: { color: '#858d98' }
    },
    color: doughnutColors, //['#5156be', '#ffbf53', '#fd625e', '#4ba6ef', '#2ab57d'],
    series: [
        {
            name: 'کل فروش',
            type: 'pie',
            radius: ['50%', '70%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    show: true,
                    textStyle: {
                        fontSize: '30',
                        fontWeight: 'bold'
                    }
                }
            },
            labelLine: {
                normal: {
                    show: false
                }
            },
            data: [
                { value: 335, name: 'لپتاپ' },
                { value: 310, name: 'تبلت' },
                { value: 234, name: 'موبایل' },
                { value: 135, name: 'دیگران' },
                { value: 1548, name: 'رایانه رومیزی' }
            ]
        }
    ]
};


if (option && typeof option === "object") {
    doughnutChart.setOption(option, true);
}

// pie chart
var pieColors = getChartColorsArray("#pie-chart");
var pieDom = document.getElementById("pie-chart");
var pieChart = echarts.init(pieDom);
var app = {};
option = null;
option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['لپتاپ', 'تبلت', 'موبایل', 'دیگران', 'رایانه رومیزی'],
        textStyle: { color: '#858d98' }
    },
    color: pieColors, //['#fd625e', '#2ab57d', '#4ba6ef', '#ffbf53', '#5156be'],
    series: [
        {
            name: 'کل فروش',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: [
                { value: 335, name: 'لپتاپ' },
                { value: 310, name: 'تبلت' },
                { value: 234, name: 'موبایل' },
                { value: 135, name: 'دیگران' },
                { value: 1548, name: 'رایانه رومیزی' }
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};

;
if (option && typeof option === "object") {
    pieChart.setOption(option, true);
}


// scatter chart
var scatterColors = getChartColorsArray("#scatter-chart");
var scatterDom = document.getElementById("scatter-chart");
var scatterChart = echarts.init(scatterDom);
var app = {};
option = null;
option = {
    // تنظیمات شبکه
    grid: {
        left: '0%',
        right: '0%',
        bottom: '0%',
        top: '4%',
        containLabel: true
    },
    xAxis: {
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
        splitLine: {
            lineStyle: {
                color: "rgba(133, 141, 152, 0.1)"
            }
        }
    },
    yAxis: {
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
        splitLine: {
            lineStyle: {
                color: "rgba(133, 141, 152, 0.1)"
            }
        }
    },
    series: [{
        symbolSize: 10,
        data: [
            [10.0, 8.04],
            [8.0, 6.95],
            [13.0, 7.58],
            [9.0, 8.81],
            [11.0, 8.33],
            [14.0, 9.96],
            [6.0, 7.24],
            [4.0, 4.26],
            [12.0, 10.84],
            [7.0, 4.82],
            [5.0, 5.68]
        ],
        type: 'scatter'
    }],
    color: scatterColors //['#2ab57d']
};

;
if (option && typeof option === "object") {
    scatterChart.setOption(option, true);
}


// bubble chart
var bubbleColors = getChartColorsArray("#bubble-chart");
var bubbleDom = document.getElementById("bubble-chart");
var bubbleChart = echarts.init(bubbleDom);
var app = {};
option = null;

var data = [
    [[28604, 77, 17096869, 'استرالیا', 1402], [31163, 77.4, 27662440, 'کانادا', 1402], [1516, 68, 1154605773, 'چین', 1402], [13670, 74.7, 10582082, 'کوبا', 1402], [28599, 75, 4986705, 'فنلاند', 1402], [29476, 77.1, 56943299, 'فرانسه', 1402], [31476, 75.4, 78958237, 'آلمان', 1402], [28666, 78.1, 254830, 'ایسلند', 1402], [1777, 57.7, 870601776, 'هند', 1402], [29550, 79.1, 122249285, 'ژاپن', 1402], [2076, 67.9, 20194354, 'کره شمالی', 1402], [12087, 72, 42972254, 'کره جنوبی', 1402], [24021, 75.4, 3397534, 'نیوزیلند', 1402], [43296, 76.8, 4240375, 'نروژ', 1402], [10088, 70.8, 38195258, 'لهستان', 1402], [19349, 69.6, 147568552, 'روسیه', 1402], [10670, 67.3, 53994605, 'ترکیه', 1402], [26424, 75.7, 57110117, 'بریتانیا', 1402], [37062, 75.4, 252847810, 'ایالات متحده', 1402]],
    [[44056, 81.8, 23968973, 'استرالیا', 1403], [43294, 81.7, 35939927, 'کانادا', 1403], [13334, 76.9, 1376048943, 'چین', 1403], [21291, 78.5, 11389562, 'کوبا', 1403], [38923, 80.8, 5503457, 'فنلاند', 1403], [37599, 81.9, 64395345, 'فرانسه', 1403], [44053, 81.1, 80688545, 'آلمان', 1403], [42182, 82.8, 329425, 'ایسلند', 1403], [5903, 66.8, 1311050527, 'هند', 1403], [36162, 83.5, 126573481, 'ژاپن', 1403], [1390, 71.4, 25155317, 'کره شمالی', 1403], [34644, 80.7, 50293439, 'کره جنوبی', 1403], [34186, 80.6, 4528526, 'نیوزیلند', 1403], [64304, 81.6, 5210967, 'نروژ', 1403], [24787, 77.3, 38611794, 'لهستان', 1403], [23038, 73.13, 143456918, 'روسیه', 1403], [19360, 76.5, 78665830, 'ترکیه', 1403], [38225, 81.4, 64715810, 'بریتانیا', 1403], [53354, 79.1, 321773631, 'ایالات متحده', 1403]]
];

option = {
    grid: {
        left: '0%',
        right: '0%',
        bottom: '0%',
        top: '4%',
        containLabel: true
    },
    legend: {
        left: "30",
        data: ['1402', '1403']
    },
    xAxis: {
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
        splitLine: {
            lineStyle: {
                type: 'dashed',
                color: "rgba(133, 141, 152, 0.1)"
            }
        },
    },
    yAxis: {
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
        splitLine: {
            lineStyle: {
                type: 'dashed',
                color: "rgba(133, 141, 152, 0.1)"
            }
        },
        scale: true
    },
    series: [{
        name: '2018',
        data: data[0],
        type: 'scatter',
        symbolSize: function (data) {
            return Math.sqrt(data[2]) / 5e2;
        },
        label: {
            emphasis: {
                show: true,
                formatter: function (param) {
                    return param.data[3];
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: bubbleColors[2],
                shadowOffsetY: 5,
                color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                    offset: 0,
                    color: bubbleColors[1],
                }, {
                    offset: 1,
                    color: bubbleColors[0]
                }])
            }
        }
    }, {
        name: '2019',
        data: data[1],
        type: 'scatter',
        symbolSize: function (data) {
            return Math.sqrt(data[2]) / 5e2;
        },
        label: {
            emphasis: {
                show: true,
                formatter: function (param) {
                    return param.data[3];
                },
                position: 'top'
            }
        },
        itemStyle: {
            normal: {
                shadowBlur: 10,
                shadowColor: bubbleColors[5],
                shadowOffsetY: 5,
                color: new echarts.graphic.RadialGradient(0.4, 0.3, 1, [{
                    offset: 0,
                    color: bubbleColors[4],
                }, {
                    offset: 1,
                    color: bubbleColors[3]
                }])
            }
        }
    }]
};

if (option && typeof option === "object") {
    bubbleChart.setOption(option, true);
}

// candlestick chart
var candlestickColors = getChartColorsArray("#candlestick-chart");
var candlestickDom = document.getElementById("candlestick-chart");
var candlestickChart = echarts.init(candlestickDom);
var app = {};
option = null;
option = {
    grid: {
        left: '0%',
        right: '0%',
        bottom: '0%',
        top: '4%',
        containLabel: true
    },
    xAxis: {
        data: ['1403-10-24', '1403-10-25', '1403-10-26', '1403-10-27'],
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
        splitLine: {
            lineStyle: {
                color: "rgba(133, 141, 152, 0.1)"
            }
        },
    },
    yAxis: {
        axisLine: {
            lineStyle: {
                color: '#858d98'
            },
        },
        splitLine: {
            lineStyle: {
                color: "rgba(133, 141, 152, 0.1)"
            }
        },
    },
    series: [{
        type: 'k',
        data: [
            [20, 30, 10, 35],
            [40, 35, 30, 55],
            [33, 38, 33, 40],
            [40, 40, 32, 42]
        ],

        itemStyle: {
            normal: {
                color: candlestickColors[0],
                color0: candlestickColors[1],
                borderColor: candlestickColors[0],
                borderColor0: candlestickColors[1]
            }
        }
    }]
};
;
if (option && typeof option === "object") {
    candlestickChart.setOption(option, true);
}


// gauge chart
var gaugeColors = getChartColorsArray("#gauge-chart");
var gaugeDom = document.getElementById("gauge-chart");
var guageChart = echarts.init(gaugeDom);
var app = {};
option = null;
option = {
    tooltip: {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        left: "auto",
        feature: {
            restore: { title: "بازنشانی" },
            saveAsImage: { title: "دانلود تصویر" }
        }
    },
    series: [
        {
            name: 'Business indicator',
            type: 'gauge',
            detail: { formatter: '{value}%' },
            axisLine: {
                lineStyle: {
                    color: [[0.2, gaugeColors[0]], [0.8, gaugeColors[1]], [1, gaugeColors[2]]],
                    width: 20
                }
            },
            data: [{ value: 50, name: 'نرخ تکمیل' }],
            axisLabel: {
                distance: 30,
            },
            detail: {
                fontSize: 20
            }
        }
    ]
};


setInterval(function () {
    option.series[0].data[0].value = (Math.random() * 100).toFixed(2) - 0;
    guageChart.setOption(option, true);
}, 2000);

if (option && typeof option === "object") {
    guageChart.setOption(option, true);
}


window.addEventListener('resize', function () {
    lineChart.resize();
    mixLineChart.resize();
    doughnutChart.resize();
    pieChart.resize();
    scatterChart.resize();
    bubbleChart.resize();
    candlestickChart.resize();
    guageChart.resize();
});