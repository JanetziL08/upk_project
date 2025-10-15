<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Jadwal Dokter</title>
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

    /* Main content */
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

    /* Form Container */
    .form-container {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 30px 40px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      width: 650px;
      position: relative;
    }

    /* Tombol hapus di kanan */
    .btn-hapus {
      position: absolute;
      right: 40px;
      top: 30px;
      background-color: red;
      color: white;
      border: none;
      padding: 6px 15px;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-hapus:hover { background-color: #cc0000; }

    label {
      display: inline-block;
      width: 120px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    input[type="text"], select {
      width: 60%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    /* Input waktu (tgl, bln, thn, jam) */
    .waktu-inputs input {
      width: 70px;
      margin-right: 10px;
      text-align: center;
    }

    .button-container {
      margin-top: 30px;
    }

    .btn-update {
      background-color: #4CAF50;
      color: white;
      padding: 8px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-reset {
      background-color: red;
      color: white;
      padding: 8px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 10px;
    }

    .btn-update:hover { background-color: #45a049; }
    .btn-reset:hover { background-color: #cc0000; }

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
    <div class="header">Edit Jadwal Dokter</div>

    <button class="logout-btn">Logout</button>

    <div class="form-container">
      <button class="btn-hapus">HAPUS</button>

      <form>
        <div class="form-group">
          <label for="nama_dokter">Nama Dokter :</label>
          <input type="text" id="nama_dokter" name="nama_dokter" placeholder="Masukkan nama dokter">
        </div>

        <div class="form-group">
          <label for="hari">Hari :</label>
          <select id="hari" name="hari">
            <option value="">-- Pilih Hari --</option>
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
          </select>
        </div>

        <div class="form-group">
          <label for="waktu">Waktu :</label>
          <div class="waktu-inputs">
            <input type="text" name="tgl" placeholder="Tgl">
            <input type="text" name="bln" placeholder="Bln">
            <input type="text" name="thn" placeholder="Thn">
            <input type="text" name="jam" placeholder="Jam">
          </div>
        </div>

        <div class="button-container">
          <button type="submit" class="btn-update">UPDATE</button>
          <button type="reset" class="btn-reset">Reset</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
