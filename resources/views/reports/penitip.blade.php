<!DOCTYPE html>
<html>

<head>
  <title>Transaction Report</title>
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
  </style>
</head>

<body>
  <h1>Atma Kitchen</h1>
  <h2>LAPORAN TRANSAKSI PENITIP</h2>
  <p>Bulan: {{ $month }}</p>
  <p>Tahun: {{ $year }}</p>
  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Qty</th>
        <th>Harga Jual</th>
        <th>Total</th>
        <th>20% Komisi</th>
        <th>Yang Diterima</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($transactions as $trans)
        <tr>
          <td>{{ $trans->nama_penitip }}</td>
          <td>{{ $trans->qty }}</td>
          <td>{{ $trans->harga_jual }}</td>
          <td>{{ $trans->total }}</td>
          <td>{{ $trans->komisi }}</td>
          <td>{{ $trans->diterima }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
