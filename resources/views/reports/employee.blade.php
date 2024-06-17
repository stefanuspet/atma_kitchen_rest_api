<!DOCTYPE html>
<html>

<head>
  <title>Employee Report</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }
  </style>
</head>

<body>
  <h1>Atma Kitchen</h1>
  <p>Jl. Centralpark No. 10 Yogyakarta</p>
  <h2>LAPORAN Presensi Karyawan</h2>
  <p>Bulan : Januari</p>
  <p>Tahun : 2024</p>
  <p>Tanggal cetak: {{ now()->format('d F Y') }}</p>
  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Jumlah Hadir</th>
        <th>Jumlah Bolos</th>
        <th>Honor Harian</th>
        <th>Bonus Rajin</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($reportData as $data)
        <tr>
          <td>{{ $data['nama'] }}</td>
          <td>{{ $data['jumlah_hadir'] }}</td>
          <td>{{ $data['jumlah_bolos'] }}</td>
          <td>{{ number_format($data['honor_harian'], 0, ',', '.') }}</td>
          <td>{{ number_format($data['bonus_rajin'], 0, ',', '.') }}</td>
          <td>{{ number_format($data['total'], 0, ',', '.') }}</td>
        </tr>
      @endforeach
      <tr>
        <th colspan="5" style="text-align: center;">Total</th>
        <th>{{ number_format($reportData->sum('total'), 0, ',', '.') }}</th>
      </tr>
    </tbody>
  </table>
</body>

</html>
