$(function () {
    // =====================================
    // Profit
    // =====================================
    async function fetchAndRenderChart() {
        try {
            const response = await fetch("/api/category-sales-restocks");
            const data = await response.json();

            const categories = data.map((item) => item.category);
            const sales = data.map((item) => item.sales || 0);
            const restocks = data.map((item) => item.restocks || 0);

            var chartConfig = {
                series: [
                    { name: "Sales", data: sales },
                    { name: "Restocks", data: restocks },
                ],
                chart: {
                    type: "bar",
                    height: 345,
                    offsetX: -15,
                    toolbar: { show: true },
                    foreColor: "#adb0bb",
                    fontFamily: "inherit",
                    sparkline: { enabled: false },
                },
                colors: ["#5D87FF", "#49BEFF"],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "35%",
                        borderRadius: [6],
                        borderRadiusApplication: "end",
                        borderRadiusWhenStacked: "all",
                    },
                },
                markers: { size: 0 },

                grid: {
                    borderColor: "rgba(0,0,0,0.1)",
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },

                xaxis: {
                    categories: categories,
                    labels: {
                        style: {
                            cssClass: "grey--text lighten-2--text fill-color",
                        },
                    },
                },
                yaxis: {
                    labels: {
                        formatter: (value) => value.toFixed(0),
                    },
                },
                tooltip: {
                    y: {
                        formatter: (value) => `${value} units`,
                    },
                },
                legend: {
                    show: true,
                    position: "bottom",
                    markers: {
                        shape: "circle",
                        width: 12,
                        height: 12,
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 5,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 3,
                    lineCap: "butt",
                    colors: ["transparent"],
                },

                responsive: [
                    {
                        breakpoint: 600,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 3,
                                },
                            },
                        },
                    },
                ],
            };

            var chart = new ApexCharts(
                document.querySelector("#chart"),
                chartConfig
            );
            chart.render();
        } catch (error) {
            console.error("Error fetching data:", error);
        }
    }

    fetchAndRenderChart();

    // Breakup

    // var breakup = {
    //     color: "#adb5bd",
    //     series: [38, 40, 25],
    //     labels: ["2022", "2021", "2020"],
    //     chart: {
    //         width: 180,
    //         type: "donut",
    //         fontFamily: "Plus Jakarta Sans', sans-serif",
    //         foreColor: "#adb0bb",
    //     },
    //     plotOptions: {
    //         pie: {
    //             startAngle: 0,
    //             endAngle: 360,
    //             donut: {
    //                 size: "75%",
    //             },
    //         },
    //     },
    //     stroke: {
    //         show: false,
    //     },

    //     dataLabels: {
    //         enabled: false,
    //     },

    //     legend: {
    //         show: false,
    //     },
    //     colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

    //     responsive: [
    //         {
    //             breakpoint: 991,
    //             options: {
    //                 chart: {
    //                     width: 150,
    //                 },
    //             },
    //         },
    //     ],
    //     tooltip: {
    //         theme: "dark",
    //         fillSeriesColor: false,
    //     },
    // };

    // var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
    // chart.render();

    // Earning

    var earning = {
        chart: {
            id: "sparkline3",
            type: "area",
            height: 60,
            sparkline: {
                enabled: true,
            },
            group: "sparklines",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        series: [
            {
                name: "Earnings",
                color: "#49BEFF",
                data: [25, 66, 20, 40, 12, 58, 20],
            },
        ],
        stroke: {
            curve: "smooth",
            width: 2,
        },
        fill: {
            colors: ["#f3feff"],
            type: "solid",
            opacity: 0.05,
        },

        markers: {
            size: 0,
        },
        tooltip: {
            enabled: false,
        },
    };
    new ApexCharts(document.querySelector("#earning"), earning).render();
});
