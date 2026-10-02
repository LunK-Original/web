<?php
// ================================
// 1. VARIABEL UNTUK MENYIMPAN HASIL
// ================================

$hasil = "";


// ================================
// 2. CEK APAKAH TOMBOL "HITUNG" DITEKAN
// ================================

if (isset($_POST["hitung"])) {

    // Ambil angka dari input
    $angka1 = $_POST["angka1"];
    $angka2 = $_POST["angka2"];

    // Ambil operator
    $operator = $_POST["operator"];


    // ================================
    // 3. MENENTUKAN OPERASI
    // ================================

    if ($operator == "+") {

        // Penjumlahan
        $hasil = $angka1 + $angka2;

    } elseif ($operator == "-") {

        // Pengurangan
        $hasil = $angka1 - $angka2;

    } elseif ($operator == "*") {

        // Perkalian
        $hasil = $angka1 * $angka2;

    } elseif ($operator == "/") {

        // Pembagian
        if ($angka2 != 0) {
            $hasil = $angka1 / $angka2;
        } else {
            $hasil = "Tidak bisa dibagi 0";
        }

    }
}

?>


<!-- ================================= -->
<!-- 4. TAMPILAN HTML KALKULATOR       -->
<!-- ================================= -->

<!DOCTYPE html>
<html>
<head>
    <title>Kalkulator PHP</title>
</head>

<body>

    <h1>Kalkulator</h1>


    <!-- ================================ -->
    <!-- 5. FORM INPUT                    -->
    <!-- ================================ -->

    <form method="POST">

        <!-- Angka pertama -->
        <input
            type="number"
            name="angka1"
            placeholder="Angka pertama"
            required
        >


        <!-- Operator -->
        <select name="operator">

            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>

        </select>


        <!-- Angka kedua -->
        <input
            type="number"
            name="angka2"
            placeholder="Angka kedua"
            required
        >


        <!-- Tombol hitung -->
        <button type="submit" name="hitung">
            Hitung
        </button>

    </form>


    <!-- ================================ -->
    <!-- 6. MENAMPILKAN HASIL             -->
    <!-- ================================ -->

    <h2>
        Hasil: <?php echo $hasil; ?>
    </h2>

</body>
</html>
