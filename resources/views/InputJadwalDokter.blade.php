<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Jadwal Dokter</title>
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
      background-color: #e8f0fe;
      padding: 20px;
      box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);
    }

    .sidebar h3 {
      color: #003366;
      margin-bottom: 30px;
      text-align: center;
    }

    .sidebar a {
      display: block;
      padding: 10px 15px;
      color: #003366;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 10px;
      font-weight: 500;
    }

    .sidebar a.active {
      background-color: #a7d8ff;
      color: #003366;
      font-weight: bold;
    }

    .sidebar a:hover {
      background-color: #bce0ff;
    }

    /* Main content */
    .main {
      margin-left: 240px;
      padding: 20px;
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

    /* Form */
    .form-container {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 30px 40px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      width: 600px;
    }

    label {
      display: inline-block;
      width: 150px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    input[type="text"], select {
      width: 60%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .waktu input {
      width: 70px;
      margin-right: 5px;
    }

    .button-container {
      margin-top: 25px;
      text-align: center;
    }

    .btn-simpan {
      background-color: #4CAF50;
      color: white;
      padding: 8px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-batal {
      background-color: red;
      color: white;
      padding: 8px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-left: 10px;
    }

    .btn-simpan:hover { background-color: #45a049; }
    .btn-batal:hover { background-color: #cc0000; }

  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h3>Unit Pelayanan<br>Kesehatan</h3>
    <a href="#">Dashboard</a>
    <a href="#">Pendaftaran Pasien</a>
    <a href="#" class="active">Jadwal Dokter</a>
    <a href="#">Rekam Medis Pasien</a>
    <a href="#">Laporan</a>
  </div>

  <!-- Main content -->
  <div class="main">
    <div class="header">Input Jadwal Dokter</div>

    <div class="form-container">
      <form>
        <div class="form-group">
          <label for="nama_dokter">Nama Dokter :</label>
          <input type="text" id="nama_dokter" name="nama_dokter" placeholder="Masukkan nama dokter">
        </div>
        <div class="form-group">
          <label for="spesialis">Spesialis :</label>
          <input type="text" id="spesialis" name="spesialis" placeholder="Masukkan bidang spesialis">
        </div>
        <div class="form-group">
          <label for="hari_praktek">Hari Praktek :</label>
          <select id="hari_praktek" name="hari_praktek">
            <option value="">-- Pilih Hari --</option>
            <option>Senin</option>
            <option>Selasa</option>
            <option>Rabu</option>
            <option>Kamis</option>
            <option>Jumat</option>
            <option>Sabtu</option>
          </select>
        </div>
        <div class="form-group waktu">
          <label>Jam Praktek :</label>
          <input type="text" id="jam_mulai" name="jam_mulai" placeholder="08:00"> -
          <input type="text" id="jam_selesai" name="jam_selesai" placeholder="12:00">
        </div>
        <div class="button-container">
          <button type="submit" class="btn-simpan">Simpan</button>
          <button type="reset" class="btn-batal">Batal</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
