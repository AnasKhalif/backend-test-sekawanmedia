<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const mobileSidebar = document.getElementById('mobileSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const timePeriodSelect = document.getElementById('timePeriod');
        const vehicleUsageCtx = document.getElementById('vehicleUsageChart').getContext('2d');

        menuButton.addEventListener('click', function() {
            mobileSidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', function() {
            mobileSidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay.addEventListener('click', function() {
            mobileSidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        let chartData = {
            week: [5, 8, 10, 7, 12, 6, 9],
            month: [15, 18, 20, 22, 25, 16, 14, 13, 18, 19, 17,
                21
            ],
            quarter: [50, 60, 55, 45],
            year: [500, 520, 530, 540, 560, 600, 580, 590, 600, 610, 615,
                620
            ]
        };

        let vehicleUsageChart = new Chart(vehicleUsageCtx, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat',
                    'Sun'
                ],
                datasets: [{
                    label: 'Vehicle Orders',
                    data: chartData.week,
                    backgroundColor: '#b45309',
                    barPercentage: 0.6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        timePeriodSelect.addEventListener('change', function() {
            const period = this.value;
            let newLabels;
            let newData;

            if (period === 'week') {
                newLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                newData = chartData.week;
            } else if (period === 'month') {
                newLabels = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11',
                    '12'
                ];
                newData = chartData.month;
            } else if (period === 'quarter') {
                newLabels = ['Q1', 'Q2', 'Q3', 'Q4'];
                newData = chartData.quarter;
            } else if (period === 'year') {
                newLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                    'Nov', 'Dec'
                ];
                newData = chartData.year;
            }

            vehicleUsageChart.data.labels = newLabels;
            vehicleUsageChart.data.datasets[0].data = newData;
            vehicleUsageChart.update();
        });
    });
</script>
