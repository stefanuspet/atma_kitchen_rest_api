<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monthly Report</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <h1>Atma Kitchen</h1>
  <h2>Monthly Report for {{ $month }} {{ $year }}</h2>
  <table>
    <tr>
      <th>Type</th>
      <th>Amount</th>
    </tr>
    @foreach ($transactions as $transaction)
      <tr>
        <td>{{ $transaction->metode_pembayaran }}</td>
        <td>{{ number_format($transaction->harga_total, 2) }}</td>
      </tr>
    @endforeach
    <tr>
      <td>Employee Salaries</td>
      <td>{{ number_format($salaries->sum('honor_harian'), 2) }}</td>
    </tr>
  </table>
</body>

</html>
