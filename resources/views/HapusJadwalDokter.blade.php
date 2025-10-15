<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hapus Jadwal Dokter</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f5f7fa;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 240px;
      height: 100%;
      background-color: #d9e6ea;
      padding: 20px;
    }

    .sidebar h3 {
      color: #003366;
      margin-bottom: 40px;
      text-align: center;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px 15px;
      color: #003366;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 12px;
      font-weight: 500;
    }

    .sidebar a.active {
      background-color: #b9e3ff;
      font-weight: bold;
    }

    .sidebar a:hover {
      background-color: #cce9ff;
    }

    /* Main Content */
    .main {
      margin-left: 240px;
      padding: 25px;
    }

    /* Header */
    .header {
      background-color: #d8ecff;
      color: #003366;
      padding: 15px 25px;
      border-radius: 8px;
      font-weight: bold;
      font-size: 18px;
      width: fit-content;
      margin-bottom: 25px;
    }

    .logout-btn {
      margin-bottom: 25px;
      background-color: #f0f0f0;
      border: 1px solid #ccc;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
    }

    .logout-btn:hover {
      background-color: #e6e6e6;
    }

    /* Table */
    table {
      width: 80%;
      border-collapse: collapse;
      background-color: #e8f5ff;
      margin-bottom: 25px;
    }

    th, td {
      border: 1px solid #333;
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #ffffff;
      font-weight: bold;
    }

    /* Buttons */
    .btn-hapus {
      background-color: red;
      color: white;
      border: none;
      padding: 6px 15px;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-hapus:hover { background-color: #cc0000; }

    .btn-simpan {
      background-color: #4CAF50;
      color: white;
      padding: 8px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-reset {
      background-color: white;
      color: black;
      padding: 8px 20px;
      border: 1px solid #888;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 10px;
    }

    .btn-simpan:hover { background-color: #45a049; }
    .btn-reset:hover { background-color: #ddd; }

    .button-container {
      margin-top: 30px;
      margin-left: 10%;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3>Unit Pelayanan<br>Kesehatan</h3>
    <a href="#"><span>🏠</span> Dashboard</a>
    <a href="#"><span>🩺</span> Pendaftaran Pasien</a>
    <a href="#" class="active"><span>📅</span> Jadwal Dokter</a>
    <a href="#"><span>📋</span> Rekam Medis Pasien</a>
    <a href="#"><span>📑</span> Laporan</a>
  </div>

  <!-- Main -->
  <div class="main">
    <div class="header">Hapus Jadwal Dokter</div>
    <button class="logout-btn">Logout</button>

    <form action="#" method="POST">
      <table>
        <thead>
          <tr>
            <th>No.</th>
            <th>Dokter</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>dr. Anastasya</td>
            <td>Senin</td>
            <td>10:00</td>
            <td><button type="button" class="btn-hapus">HAPUS</button></td>
          </tr>
          <tr>
            <td>2</td>
            <td>dr. Budi</td>
            <td>Rabu</td>
            <td>08:00</td>
            <td><button type="button" class="btn-hapus">HAPUS</button></td>
          </tr>
          <tr>
            <td>3</td>
            <td>dr. Edo Gunawan</td>
            <td>Jumat</td>
            <td>14:00</td>
            <td><button type="button" class="btn-hapus">HAPUS</button></td>
          </tr>
        </tbody>
      </table>

      <div class="button-container">
        <button type="submit" class="btn-simpan">Simpan</button>
        <button type="reset" class="btn-reset">Reset</button>
      </div>
    </form>
  </div>

</body>
</html>
