function saveProgress(index) {
    let radioValues = [];
    let radioNames = [];
    let radioButton = document.getElementsByClassName("sol" + index);
    let allChecked = true;

    for (let i = 0; i < radioButton.length; i += 10) {
        if (radioButton[i].type === "radio") {
            radioNames.push(radioButton[i].name);
        }
    }

    // next is to now check if they have been checked or not
    for (let i = 0; i < radioNames.length; i++) {
        if ($("input[name=" + radioNames[i] + "]:checked").length == 0) {
            allChecked = false;
            break;
        } else {
            radioValues.push(
                $("input[name=" + radioNames[i] + "]:checked").val()
            );
        }
    }

    if (allChecked) {
        $("#datax").val(JSON.stringify(radioValues));

        $("#myform").submit();
    } else {
        $("#myform").submit();
    }
}

async function logJSONData() {
    const response = await fetch("/emotional/score");
    const jsonData = await response.json();
    let myCate = [];
    let myeva = [];

    if (jsonData["data"].length == 0) {
        return;
    }

    jsonData["data"].forEach(function (item) {
        myCate.push(item.question_group);
        myeva.push(item.total_score);
        console.log(item.question_group, item.total_score);
    });

    var options = {
        series: [
            {
                name: "Series 1",
                data: myeva,
            },
        ],
        chart: {
            foreColor: "#9ba7b2",
            height: 350,
            type: "radar",
        },
        dataLabels: {
            enabled: true,
        },
        plotOptions: {
            radar: {
                size: 140,
                polygons: {
                    strokeColors: "#e9e9e9",
                    fill: {
                        colors: ["#f8f8f8", "#fff"],
                    },
                },
            },
        },
        title: {
            text: "My Performance",
        },
        colors: ["#0d6efd"],
        markers: {
            size: 4,
            colors: ["#fff"],
            strokeColor: "#FF4560",
            strokeWidth: 2,
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val;
                },
            },
        },
        xaxis: {
            categories: myCate,
        },
        yaxis: {
            tickAmount: 7,
            labels: {
                formatter: function (val, i) {
                    if (i % 2 === 0) {
                        return val;
                    } else {
                        return "";
                    }
                },
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart10"), options);
    chart.render();
}

$(function () {
    "use strict";
    logJSONData();
});
