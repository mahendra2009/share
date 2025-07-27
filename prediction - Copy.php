<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Stock Prediction Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    .clickable{ cursor: pointer;}
    </style>

</head>
<body>
  <div class="container my-4">
    <h2 class="mb-4">📊 Stock Predictions</h2>

    <div class="row mb-3">
      <div class="col-md-3">
        <label>From Date:</label>
        <input type="date" id="dateFrom" class="form-control" />
      </div>
      <div class="col-md-3">
        <label>To Date:</label>
        <input type="date" id="dateTo" class="form-control" />
      </div>
      <div class="col-md-2">
        <label>Show:</label>
        <select id="limitSelect" class="form-control">
           <option value="30">Top 30</option>
           <option value="20">Top 20</option>
          <option value="10">Top 10</option>
         
        </select>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100" onclick="loadPredictions()">Search</button>
      </div>
    </div>

    <div class="mb-2">
      <button class="btn btn-success me-2" onclick="loadTop('gain')">Top Gainers</button>
      <button class="btn btn-danger" onclick="loadTop('loss')">Top Losers</button>
    </div>

    <div id="chart"></div>

    <div class="table-responsive mt-4">
      <table class="table table-bordered" id="dataTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Current Rate</th>
            <th>Prev Rate</th>
            <th>% Change</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="stockModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">📈 Stock Trend: <span id="modalStockName"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div id="modalChart"></div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    let chart;
    let modalChart;

    function setDefaultDates() {
      const to = new Date();
      const from = new Date();
      from.setDate(to.getDate() - 15);
      document.getElementById('dateFrom').value = from.toISOString().split('T')[0];
      document.getElementById('dateTo').value = to.toISOString().split('T')[0];
    }

    function loadPredictions() {
      const fromDate = document.getElementById('dateFrom').value;
      const toDate = document.getElementById('dateTo').value;
      const limit = parseInt(document.getElementById('limitSelect').value);

      fetch(`api.php?c=prediction&q=date_from:${fromDate}/date_to:${toDate}&type=gain&limit=${limit}`)
        .then(res => res.json())
        .then(data => {
          const all = data.data;
          const filtered = all.filter(i => Math.abs(i.percent) >= 5);
          const grouped = {};

          filtered.forEach(i => {
            if (!grouped[i.names]) grouped[i.names] = 0;
            grouped[i.names] += i.percent;
          });

          const sorted = Object.entries(grouped)
            .sort((a, b) => Math.abs(b[1]) - Math.abs(a[1]))
            .slice(0, limit);

          const labels = sorted.map(i => i[0]);
          const values = sorted.map(i => i[1].toFixed(2));

          if (chart) chart.destroy();
          chart = new ApexCharts(document.querySelector("#chart"), {
            chart: {
              type: 'bar',
              height: 400,
              events: {
                dataPointSelection: function (event, chartContext, config) {
                  const stockName = chartContext.w.globals.labels[config.dataPointIndex];
                  showStockChart(stockName, fromDate, toDate);
                }
              }
            },
            series: [{ name: "% Change", data: values }],
            xaxis: { categories: labels },
            colors: values.map(v => v >= 0 ? "#28a745" : "#dc3545"),
            title: { text: 'Top ±5% Movers', align: 'center' },
            plotOptions: { bar: { distributed: true, borderRadius: 5 } }
          });
          chart.render();

        loadTable(filtered,limit);
        });
    }

    function loadTable(filtered,limit) {
        const tbody = document.querySelector("#dataTable tbody");
          tbody.innerHTML = "";
          filtered.slice(0, limit).forEach(row => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
               <td class="clickable">${row.names}</td>
              <td>${row.dates}</td>
              <td>${row.c_rate}</td>
              <td>${row.p_rate}</td>
              <td class="${row.percent >= 0 ? 'text-success' : 'text-danger'}">${row.percent.toFixed(2)}%</td>`;
            tbody.appendChild(tr);
          });


    }
    function loadTop(type) {
      const fromDate = document.getElementById('dateFrom').value;
      const toDate = document.getElementById('dateTo').value;
      const limit = parseInt(document.getElementById('limitSelect').value);

      fetch(`api.php?c=prediction&q=date_from:${fromDate}/date_to:${toDate}&type=${type}&limit=${limit}`)
        .then(res => res.json())
        .then(data => {
          const all = data.data;
          let filtered  =[]
          
            if (type === 'gain') {
 // filtered = data.filter(d => d.percent > 5).sort((a, b) => b.percent - a.percent); // High to low

  filtered = all.
            filter(d => d.percent > 0).sort((a, b) => b.percent - a.percent)  // High to low
            .sort((a, b) => Math.abs(b.percent) - Math.abs(a.percent))
            .slice(0, limit);

} else if (type === 'loss') {
    filtered = all.
           filter(d => d.percent < 0).sort((a, b) => a.percent - b.percent)  // Low to high (more negative is top)
            .sort((a, b) => Math.abs(b.percent) - Math.abs(a.percent))
            .slice(0, limit);  
}

console.log(filtered)

          const labels = filtered.map(i => i.names);
          const values = filtered.map(i => i.percent.toFixed(2));

          if (chart) chart.destroy();
          chart = new ApexCharts(document.querySelector("#chart"), {
            chart: {
              type: 'bar',
              height: 400,
              events: {
                dataPointSelection: function (event, chartContext, config) {
                  const stockName = chartContext.w.globals.labels[config.dataPointIndex];
                  showStockChart(stockName, fromDate, toDate);
                }
              }
            },
            series: [{ name: "% Change", data: values }],
            xaxis: { categories: labels },
            colors: values.map(v => v >= 0 ? "#28a745" : "#dc3545"),
            title: { text: type === 'gain' ? 'Top Gainers' : 'Top Losers', align: 'center' },
            plotOptions: { bar: { distributed: true, borderRadius: 5 } }
          });
          chart.render();
          loadTable(filtered,limit) 
        });
    }

    function showStockChart(stockName, from, to) {
      fetch(`api.php?c=prediction&q=date_from:${from}/date_to:${to}`)
        .then(res => res.json())
        .then(data => {
          const filtered = data.data.filter(i => i.names === stockName);
          if (!filtered.length) return alert("No data found");

          const dates = filtered.map(i => i.dates);
          const values = filtered.map(i => i.percent.toFixed(2));

          if (modalChart) modalChart.destroy();

          modalChart = new ApexCharts(document.querySelector("#modalChart"), {
            chart: { type: 'line', height: 350 },
            series: [{ name: "% Change", data: values }],
            xaxis: { categories: dates },
            colors: ["#007bff"],
            title: { text: `Performance of ${stockName}`, align: "center" }
          });

          document.getElementById('modalStockName').textContent = stockName;
          modalChart.render();
          new bootstrap.Modal(document.getElementById('stockModal')).show();
        });
    }

    setDefaultDates();
    loadPredictions();
 
 /*       $('#fetchBtn').click(() => fetchPredictionData());
    $('#showGainers').click(() => fetchPredictionData('gainers'));
    $('#showLosers').click(() => fetchPredictionData('losers')); */

   
    $(document).on('click', 'td.clickable', function () {
      const name = $(this).text();
      $('#popupChart').empty();
   const from = $('#dateFrom').val();
      const to = $('#dateTo').val();
      showStockChart(name,from,to)
    });

  </script>
</body>
</html>
