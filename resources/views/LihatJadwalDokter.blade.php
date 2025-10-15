<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lihat Jadwal Dokter</title>
  <style>
    * {
      font-family: Arial, Helvetica, sans-serif;
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background-color: #f9f9f9;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 190px;
      height: 100%;
      background-color: #d9e6eb;
      padding: 20px 10px;
    }

    .sidebar h3 {
      color: #003366;
      font-size: 15px;
      text-align: center;
      margin-bottom: 25px;
    }

    .menu a {
      display: flex;
      align-items: center;
      text-decoration: none;
      color: #003366;
      padding: 8px 12px;
      border-radius: 5px;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .menu a.active {
      background-color: #bcdfff;
      font-weight: bold;
    }

    .menu a:hover {
      background-color: #cfeaff;
    }

    /* Main content */
    .main {
      margin-left: 210px;
      padding: 20px 40px;
    }

    /* Header */
    .header {
      background-color: #d8ecff;
      color: #003366;
      padding: 12px 25px;
      border-radius: 8px;
      font-weight: bold;
      font-size: 18px;
      width: fit-content;
      margin-bottom: 25px;
    }

    /* Search area */
    .search-section {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 400px;
      margin-bottom: 10px;
    }

    .search-box {
      display: flex;
      align-items: center;
      background-color: #d8ecff;
      border-radius: 6px;
      padding: 6px 10px;
      width: 270px;
    }

    .search-box input {
      border: none;
      outline: none;
      background: transparent;
      width: 100%;
      font-size: 14px;
      margin-left: 5px;
    }

    .reset {
      color: #666;
      font-size: 13px;
      cursor: pointer;
    }

    .reset:hover {
      text-decoration: underline;
    }

    /* Table */
    .table-container {
      background-color: #d8ecff;
      border-radius: 8px;
      width: 450px;
      padding: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px 8px;
      text-align: left;
      border-bottom: 1px solid #666;
    }

    th {
      color: #003366;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3>Unit Pelayanan<br>Kesehatan</h3>
    <div class="menu">
      <a href="#">🏠 Dashboard</a>
      <a href="#">👤 Pendaftaran Pasien</a>
      <a href="#" class="active">📅 Jadwal Dokter</a>
      <a href="#">📋 Rekam Medis Pasien</a>
      <a href="#">📊 Laporan</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="header">Jadwal Dokter</div>

    <div class="search-section">
      <div class="search-box">
        🔍 <input type="text" placeholder="Search">
      </div>
      <div class="reset">Reset</div>
    </div>

    <div class="table-container">
      <table>
        <tr>
          <th>Nama Dokter</th>
          <th>Specialist</th>
        </tr>
        <tr>
          <td>dr. Anastasya</td>
          <td>Sp.OG</td>
        </tr>
        <tr>
          <td>dr. Budi</td>
          <td>Sp.M</td>
        </tr>
        <tr>
          <td>dr. Edo Gunawan</td>
          <td>Sp.PD</td>
        </tr>
      </table>
    </div>
  </div>

</body>
</html>
