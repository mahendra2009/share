<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Buyable Stocks - Daily Report</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f5f5f5; padding: 30px; }
    .gain { background-color: #d4edda; }
    .loss { background-color: #f8d7da; }
    .stock-table th, .stock-table td { text-align: center; }
  </style>
</head>
<body>

  <div class="container">
    <h2 class="text-center mb-4">📊 Daily Stock Prediction</h2>

    <form id="dateForm" class="mb-4 row">
      <div class="col-md-4">
        <input type="date" id="reportDate" class="form-control" required>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary">Get Report</button>
      </div>
    </form>

    <div id="loading" class="text-center d-none mb-3">
      <div class="spinner-border text-primary"></div>
    </div>

    <div id="noData" class="alert alert-warning d-none text-center">No records found for the selected date.</div>

    <table class="table table-bordered stock-table d-none">
      <thead class="table-dark">
        <tr>
          <th>Date</th>
          <th>Stock</th>
          <th>Close</th>
          <th>Prev Close</th>
          <th>% Change</th>
        </tr>
      </thead>
      <tbody id="stockRows"></tbody>
    </table>
  </div>

  <script>
    // Default to today’s date
    document.getElementById('reportDate').valueAsDate = new Date();

    document.getElementById('dateForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const date = document.getElementById('reportDate').value;
      const api = `api.php?c=report&q=date_from:${date}/date_to:${date}`;

      document.getElementById('loading').classList.remove('d-none');
      document.getElementById('noData').classList.add('d-none');
      document.querySelector('.stock-table').classList.add('d-none');
      document.getElementById('stockRows').innerHTML = '';

      fetch(api)
        .then(res => res.json())
        .then(data => {
          document.getElementById('loading').classList.add('d-none');

          if (data.data && data.data.length > 0) {
            const sorted = data.data.sort((a, b) => b.percent - a.percent);
            const rows = sorted.map(item => {
              const cls = item.percent > 0 ? 'gain' : 'loss';
              return `<tr class="${cls}">
                        <td>${item.dates}</td>
                        <td>${item.names}</td>
                        <td>${item.c_rate}</td>
                        <td>${item.p_rate}</td>
                        <td>${parseFloat(item.percent).toFixed(2)}%</td>
                      </tr>`;
            }).join('');
            document.getElementById('stockRows').innerHTML = rows;
            document.querySelector('.stock-table').classList.remove('d-none');
          } else {
            document.getElementById('noData').classList.remove('d-none');
          }
        })
        .catch(error => {
          document.getElementById('loading').classList.add('d-none');
          alert("Error fetching stock data.");
          console.error(error);
        });
    });
  </script>
</body>
</html>
