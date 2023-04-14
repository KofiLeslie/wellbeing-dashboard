async function logJSONData() {
    const response = await fetch("/feed");
    const jsonData = await response.json();

    var options = {
        chart: {
            height: 300,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                //startAngle: -135,
                //endAngle: 135,
                hollow: {
                    margin: 0,
                    size: "45%",
                    background: "transparent",
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: "front",
                    dropShadow: {
                        enabled: false,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24,
                    },
                },
                track: {
                    background: "#eeedfb",
                    strokeWidth: "50%",
                    margin: 12, // margin is in pixels
                    dropShadow: {
                        enabled: false,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35,
                    },
                },
                dataLabels: {
                    name: {
                        color: "#000",
                        fontSize: "14px",
                        offsetY: -5,
                    },
                    value: {
                        color: "#000",
                        fontSize: "25px",
                        offsetY: 5,
                    },
                    total: {
                        show: true,
                        label: "Total",
                        color: "#000",
                        formatter: function (w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return jsonData.total_task;
                        },
                    },
                },
            },
        },
        stroke: {
            lineCap: "butt",
        },
        colors: ["#940109", "#ff6632"],
        series: [jsonData.total_completed, jsonData.total_pending],
        labels: ["Complete", "Pending"],
        responsive: [
            {
                breakpoint: 1280,
                options: {
                    chart: {
                        height: 350,
                    },
                },
            },
        ],
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);

    chart.render();
}

$(function () {
    "use strict";
    logJSONData();
});
