<?php
$jurusan_rekomendasi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari form
    $nilai = [
        "Pendidikan Pancasila" => $_POST['nilai_pp'],
        "Bahasa Indonesia" => $_POST['nilai_bi'],
        "Matematika" => $_POST['nilai_mtk'],
        "Bahasa Inggris" => $_POST['nilai_inggris'],
        "Pendidikan Jasmani Olahraga dan Kesehatan" => $_POST['nilai_penjas'],
        "Sejarah" => $_POST['nilai_sejarah'],
        "Seni dan Budaya" => $_POST['nilai_seni'],
    ];

    $minat = $_POST['minat'];

    // Bobot untuk setiap jurusan
    $bobot_jurusan = [
        "Kedokteran dan Ilmu Kesehatan" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.1,
            "Matematika" => 0.2,
            "Bahasa Inggris" => 0.2,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.1,
        ],
        "Teknik" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.1,
            "Matematika" => 0.4,
            "Bahasa Inggris" => 0.1,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.0,
        ],
        "Pertanian" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.1,
            "Matematika" => 0.2,
            "Bahasa Inggris" => 0.1,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.2,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.2,
        ],
        "Peternakan" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.1,
            "Matematika" => 0.2,
            "Bahasa Inggris" => 0.1,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.3,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.1,
        ],
        "FPIK" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.1,
            "Matematika" => 0.2,
            "Bahasa Inggris" => 0.3,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.1,
        ],
        "Ekonomi dan Bisnis" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.2,
            "Matematika" => 0.3,
            "Bahasa Inggris" => 0.2,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.1,
        ],
        "Hukum" => [
            "Pendidikan Pancasila" => 0.2,
            "Bahasa Indonesia" => 0.3,
            "Matematika" => 0.1,
            "Bahasa Inggris" => 0.2,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.1,
        ],
        "FISIP" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.2,
            "Matematika" => 0.1,
            "Bahasa Inggris" => 0.3,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.2,
            "Seni dan Budaya" => 0.1,
        ],
    ];

    // Bobot tambahan berdasarkan minat
    $bobot_minat = [
        "Seni" => ["FISIP", "Ekonomi dan Bisnis"],
        "Olahraga" => ["Peternakan", "Pertanian"],
        "Sains dan Teknologi" => ["Teknik", "FPIK"],
        "Ekonomi" => ["Ekonomi dan Bisnis", "Hukum"],
        "Kesehatan" => ["Kedokteran dan Ilmu Kesehatan"],
    ];

    // Hitung skor untuk setiap jurusan
    $skor_jurusan = [];
    foreach ($bobot_jurusan as $jurusan => $bobot) {
        $skor = 0;
        foreach ($bobot as $mata_pelajaran => $nilai_bobot) {
            $skor += $nilai[$mata_pelajaran] * $nilai_bobot;
        }
        // Tambahkan bobot tambahan jika minat sesuai
        if (in_array($jurusan, $bobot_minat[$minat])) {
            $skor += 10; // Tambahan bobot minat
        }
        $skor_jurusan[$jurusan] = $skor;
    }

    // Cari jurusan dengan skor tertinggi
    $jurusan_rekomendasi = array_keys($skor_jurusan, max($skor_jurusan))[0];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Jurusan Kuliah</title>
    <link rel="stylesheet" href="style.css">
    <!-- link untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>Sistem Pakar: Rekomendasi Jurusan Kuliah
                <i class="fa-solid fa-gears"></i>
            </h1>
        </div>
    </header>

    <form method="POST">
        <div class="input-section">
            <h3>Masukkan Nilai Anda:</h3>
            <label>Pendidikan Pancasila:</label><input type="number" name="nilai_pp" min="0" max="100" required><br>
            <label>Bahasa Indonesia:</label><input type="number" name="nilai_bi" min="0" max="100" required><br>
            <label>Matematika:</label><input type="number" name="nilai_mtk" min="0" max="100" required><br>
            <label>Bahasa Inggris:</label><input type="number" name="nilai_inggris" min="0" max="100" required><br>
            <label>Pendidikan Jasmani:</label><input type="number" name="nilai_penjas" min="0" max="100" required><br>
            <label>Sejarah:</label><input type="number" name="nilai_sejarah" min="0" max="100" required><br>
            <label>Seni dan Budaya:</label><input type="number" name="nilai_seni" min="0" max="100" required><br>
        </div>
        
        <div class="input-section">
            <h3>Pilih Minat Anda:</h3>
            <select name="minat" required>
                <option value="Seni">Seni</option>
                <option value="Olahraga">Olahraga</option>
                <option value="Sains dan Teknologi">Sains dan Teknologi</option>
                <option value="Ekonomi">Ekonomi</option>
                <option value="Kesehatan">Kesehatan</option>
            </select><br><br>
        </div>

        <button type="submit">Dapatkan Rekomendasi</button>
    </form>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Sistem Pakar. All Rights Reserved.</p>
            <p>Created by Marvell Yehezkiel Palenewen and Catherine Maria Assa</p>
        </div>
    </footer>

    <?php if (!empty($jurusan_rekomendasi)): ?>
        <h2>Rekomendasi Jurusan: <?php echo $jurusan_rekomendasi; ?></h2>
    <?php endif; ?>
</body>
</html>
