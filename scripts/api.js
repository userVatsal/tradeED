const apiKey = 'DCRVFU2ALH2LOHIO';
const symbol = 'AAPL'; // Example: Apple Inc.
const url = `https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=${symbol}&apikey=${apiKey}`;

fetch(url)
    .then(response => response.json())
    .then(data => {
        const timeSeries = data['Time Series (Daily)'];
        const dates = Object.keys(timeSeries);
        const closingPrices = dates.map(date => timeSeries[date]['4. close']);

        const ctx = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Closing Price',
                    data: closingPrices,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Closing Price'
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));

