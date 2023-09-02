<div class="m-2">
    <div class="flex flex-col lg:flex-wrap lg:flex-row place-content-center">
        <div class="lg:w-1/2 p-2 my-1">
            <canvas class="bg-white rounded-xl w-full shadow-lg" id='popularBooksChart'></canvas>
        </div>
        <div class="lg:w-1/2 p-2 my-1">
            <canvas class="bg-white rounded-xl w-full shadow-lg" id='popularAuthorsChart'></canvas>
        </div>
        <div class="lg:w-1/2 p-2 my-1">
            <canvas class="bg-white rounded-xl w-full shadow-lg" id='popularTagsDoughnut'></canvas>
        </div>
    </div>


    @push('layout-script-stack')
    <!-- Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const popularBooks = document.getElementById('popularBooksChart')

        new Chart(popularBooks, {
                type: 'bar',
                data: {
                    labels: {!!  $mostDownloadedBooks[0]  !!},
                    datasets: [{
                        label: 'Top 5 Most Popular Books',
                        data: {{ $mostDownloadedBooks[1] }},
                        backgroundColor:[
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(255, 205, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },  
                },
            }
        )

        const popularAuthors = document.getElementById('popularAuthorsChart')

        new Chart(popularAuthors, {
                type: 'bar',
                data: {
                    labels: {!!  $mostPopularAuthors[0]  !!},
                    datasets: [{
                        label: 'Top 5 Most Popular Authors',
                        data: {{ $mostPopularAuthors[1] }},
                        backgroundColor:[
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(255, 205, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },  
                },
            }
        )

        const popularTags = document.getElementById('popularTagsDoughnut')

        new Chart(popularTags, {
            type: 'doughnut',
            data: {
                labels: {!! $mostCommonTags[0] !!},
                datasets: [{
                    label: 'Top 5 Most Commonly Tagged Tags',
                    data: {{ $mostCommonTags[1] }},
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                scales: {
                x: {
                    display: true,
                    title: {
                    display: true,
                    text: 'Top 5 Commonly Tagged Tags',
                    color: '#736D6D',
                    font: {
                        size: 17,
                        weight: 'bold',
                        lineHeight: 1.2,
                    },
                    padding: {top: 20, left: 0, right: 0, bottom: 0}
                    }
                },
                }
            },
        })

    </script>
    @endpush
</div>