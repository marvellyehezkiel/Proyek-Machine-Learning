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
        "FIB" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.3,
            "Matematika" => 0.1,
            "Bahasa Inggris" => 0.2,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.2,
            "Seni dan Budaya" => 0.2,
        ],
        "FMIPA" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.1,
            "Matematika" => 0.4,
            "Bahasa Inggris" => 0.2,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.1,
            "Sejarah" => 0.0,
            "Seni dan Budaya" => 0.1,
        ],
        "FKM" => [
            "Pendidikan Pancasila" => 0.1,
            "Bahasa Indonesia" => 0.1,
            "Matematika" => 0.2,
            "Bahasa Inggris" => 0.3,
            "Pendidikan Jasmani Olahraga dan Kesehatan" => 0.2,
            "Sejarah" => 0.1,
            "Seni dan Budaya" => 0.0,
        ],
    ];

    $prodi_per_jurusan = [
        "Kedokteran dan Ilmu Kesehatan" => [
            "Profesi Dokter",
            "Profesi Dokter Gigi",
            "Profesi Ners",
            "Pendidikan Dokter Gigi",
            "Ilmu Keperawatan",
            "Ilmu Penyakit Mata",
            "Ilmu Kesehatan Anak",
            "Ilmu Bedah",
            "Ilmu Penyakit Dalam",
            "Ilmu Kebidanan Dan Penyakit Kandungan",
            "Ilmu Penyakit Kulit Dan Kelamin",
            "Ilmu Kedokteran Fisik Dan Rehabilitasi",
            "Ilmu Penyakit Jantung Dan Pembuluh Darah",
            "Neurologi"
        ],
        "Teknik" => [
            "Teknik Sipil",
            "Arsitektur",
            "Teknik Elektro",
            "Teknik Mesin",
            "Perencanaan Wilayah Dan Kota",
            "Teknik Informatika",
            "Teknik Lingkungan"
        ],
        "Pertanian" => [
            "Agronomi",
            "Ilmu Tanah",
            "Agribisnis",
            "Teknologi Pangan",
            "Teknik Pertanian",
            "Ilmu Kehutanan",
            "Agroteknologi",
            "Proteksi Tanaman"
        ],
        "Peternakan" => [
            "Produksi Ternak",
            "Nutrisi Dan Makanan Ternak",
            "Sosial Ekonomi Peternakan",
            "Peternakan"
        ],
        "FPIK" => [
            "Manajemen Sumberdaya Perairan",
            "Budidaya Perairan",
            "Ilmu Kelautan",
            "Teknologi Hasil Perikanan",
            "Pemanfaatan Sumberdaya Perikanan",
            "Agrobisnis Perikanan"
        ],
        "Ekonomi dan Bisnis" => [
            "Profesi Akuntan",
            "Ekonomi Pembangunan",
            "Manajemen",
            "Akuntansi"
        ],
        "Hukum" => [
            "Ilmu Hukum"
        ],
        "FISIP" => [
            "Perpustakaan",
            "Ilmu Administrasi Negara",
            "Ilmu Administrasi Bisnis",
            "Ilmu Pemerintahan",
            "Ilmu Politik",
            "Ilmu Komunikasi",
            "Sosiologi",
            "Antropologi Sosial",
            "Ilmu Perpustakaan"
        ],
        "FIB" => [
            "Bahasa Jepang",
            "Sastra Indonesia",
            "Sastra Inggris",
            "Sastra Jerman",
            "Ilmu Sejarah"
        ],
        "FMIPA" => [
            "Kimia",
            "Biologi",
            "Matematika",
            "Fisika",
            "Farmasi",
            "Sistem Informasi"
        ],
        "FKM" => [
            "Ilmu Kesehatan Masyarakat"
        ]
    ];

    // Bobot tambahan berdasarkan minat
    $bobot_minat = [
        "Seni" => ["FISIP", "Ekonomi dan Bisnis", "FIB"],
        "Olahraga" => ["Peternakan", "Pertanian"],
        "Sains dan Teknologi" => ["Teknik", "FPIK", "FMIPA"],
        "Ekonomi" => ["Ekonomi dan Bisnis", "Hukum"],
        "Kesehatan" => ["Kedokteran dan Ilmu Kesehatan", "FKM"],
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

    // Pilih 3 program studi acak dari jurusan yang direkomendasikan
    if (!empty($prodi_per_jurusan[$jurusan_rekomendasi])) {
        $prodi_rekomendasi = array_slice(
            $prodi_per_jurusan[$jurusan_rekomendasi],
            0,
            3
        );
    }
    // Panggil script Python untuk prediksi
    $command = escapeshellcmd("python3 predict.py " . implode(' ', $nilai));
    $output = shell_exec($command);

    // Tampilkan hasil
    echo "Jurusan yang direkomendasikan berdasarkan skor: " . $jurusan_rekomendasi . "<br>";
    echo "Program studi yang direkomendasikan: <br>";
    foreach ($prodi_rekomendasi as $prodi) {
        echo "- " . $prodi . "<br>";
    }

    // Tampilkan hasil dari Python prediction
    echo "Hasil prediksi dari Python: " . $output;
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
            <h1>Machine Learning: Rekomendasi Jurusan Kuliah
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
            <p>&copy; 2024 Machine Learning. All Rights Reserved.</p>
            <p>Created by Marvell Yehezkiel Palenewen, Alessandro dan Sisilia</p>
        </div>
    </footer>

    <!-- Hasil rekomendasi -->
    <?php 
    if (isset($_POST['submit'])) {
        // Ambil input dari form
        $nilai_pp = $_POST['nilai_pp'];
        $nilai_bi = $_POST['nilai_bi'];
        $nilai_mtk = $_POST['nilai_mtk'];
        $nilai_inggris = $_POST['nilai_inggris'];
        $nilai_penjas = $_POST['nilai_penjas'];
        $nilai_sejarah = $_POST['nilai_sejarah'];
        $nilai_seni = $_POST['nilai_seni'];
        $minat = $_POST['minat'];

        // Panggil script Python untuk prediksi
        $command = escapeshellcmd("python3 predict.py $nilai_mtk $nilai_bi $nilai_inggris $nilai_penjas $nilai_sejarah $nilai_seni");
        $output = shell_exec($command);

        // Tampilkan hasil rekomendasi
        echo "<h2>Rekomendasi Jurusan: " . $output . "</h2>";

        // Sorting Program Studi berdasarkan abjad (ascending)
        $prodi_rekomendasi = ["Teknik Informatika", "Kedokteran", "Desain Grafis"]; // Contoh daftar prodi
        sort($prodi_rekomendasi);

        // Filtering: Misalnya hanya menampilkan program studi yang mengandung kata "Teknologi" jika minatnya "Sains dan Teknologi"
        if ($minat == "Sains dan Teknologi") {
            $prodi_rekomendasi = array_filter($prodi_rekomendasi, function($prodi) {
                return strpos($prodi, "Teknologi") !== false; // Filter program studi yang mengandung "Teknologi"
            });
        }

        // Menampilkan 3 program studi pertama yang sudah disortir dan difilter
        $prodi_rekomendasi = array_slice($prodi_rekomendasi, 0, 3);

        // Menampilkan daftar program studi
        echo "<h3>Program Studi Rekomendasi:</h3><ul>";
        foreach ($prodi_rekomendasi as $prodi) {
            echo "<li>" . $prodi . "</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
