<?php
$nama = "";
$nilai1 = $nilai2 = $nilai3 = 0;
$rata_rata = 0;
$grade = "";
$status = "";
$hasil_ditampilkan = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nama   = trim($_POST["nama"] ?? "");
    $nilai1 = (float)($_POST["nilai1"] ?? 0);
    $nilai2 = (float)($_POST["nilai2"] ?? 0);
    $nilai3 = (float)($_POST["nilai3"] ?? 0);

    // Validasi nilai
    if ($nama === "") {
        $error = "Nama wajib diisi.";
    } elseif ($nilai1 < 0 || $nilai1 > 100 || $nilai2 < 0 || $nilai2 > 100 || $nilai3 < 0 || $nilai3 > 100) {
        $error = "Nilai harus berada di antara 0 sampai 100.";
    } else {
        // Perhitungan
        $total = $nilai1 + $nilai2 + $nilai3;
        $rata_rata = $total / 3;

        // Penentuan grade
        if ($rata_rata >= 85) {
            $grade = "A";
        } elseif ($rata_rata >= 75) {
            $grade = "B";
        } elseif ($rata_rata >= 65) {
            $grade = "C";
        } elseif ($rata_rata >= 50) {
            $grade = "D";
        } else {
            $grade = "E";
        }

        // Status kelulusan
        $status = ($rata_rata >= 65) ? "Lulus" : "Tidak Lulus";

        $hasil_ditampilkan = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Program Perhitungan Nilai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 30px;
        }

        .container {
            width: 450px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #234f7d;
        }

        label {
            display: block;
            margin-top: 12px;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #234f7d;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #163652;
        }

        .hasil {
            margin-top: 25px;
            padding: 20px;
            background-color: #eef5fa;
            border-radius: 8px;
        }

        .error {
            margin-top: 15px;
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Perhitungan Nilai Mahasiswa</h1>

    <form method="POST">
        <label>Nama Mahasiswa</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" required>

        <label>Nilai Tugas</label>
        <input type="number" name="nilai1" min="0" max="100" step="0.01" required>

        <label>Nilai UTS</label>
        <input type="number" name="nilai2" min="0" max="100" step="0.01" required>

        <label>Nilai UAS</label>
        <input type="number" name="nilai3" min="0" max="100" step="0.01" required>

        <button type="submit">Hitung Nilai</button>
    </form>

    <?php if (!empty($error)) { ?>
        <div class="error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php } ?>

    <?php if ($hasil_ditampilkan) { ?>
        <div class="hasil">
            <h2>Hasil Perhitungan</h2>

            <p><strong>Nama:</strong> <?= htmlspecialchars($nama) ?></p>
            <p><strong>Nilai Tugas:</strong> <?= htmlspecialchars($nilai1) ?></p>
            <p><strong>Nilai UTS:</strong> <?= htmlspecialchars($nilai2) ?></p>
            <p><strong>Nilai UAS:</strong> <?= htmlspecialchars($nilai3) ?></p>
            <p><strong>Rata-rata:</strong> <?= number_format($rata_rata, 2) ?></p>
            <p><strong>Grade:</strong> <?= htmlspecialchars($grade) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($status) ?></p>
        </div>
    <?php } ?>
</div>

</body>
</html>