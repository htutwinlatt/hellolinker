let viewChart = new Chart(document.getElementById('viewCountTable'), {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Views by day',
            data: [],
        },],
    }
});

let downloadChart = new Chart(document.getElementById('downloadCountTable'), {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Download by day',
            data: [],
        },],
    }
});
