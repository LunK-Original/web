<?php

// ============================================================
// 1. FUNGSI UNTUK MENGHITUNG EKSPRESI
// ============================================================

function hitung($ekspresi)
{
    // --------------------------------------------------------
    // Membersihkan spasi
    // --------------------------------------------------------

    $ekspresi = str_replace(" ", "", $ekspresi);


    // --------------------------------------------------------
    // Kalau ekspresi kosong
    // --------------------------------------------------------

    if ($ekspresi == "") {
        return "0";
    }


    // ========================================================
    // 2. MEMECAH EKSPRESI MENJADI ANGKA DAN OPERATOR
    // ========================================================

    $angka = "";
    $angkaList = [];
    $operatorList = [];


    for ($i = 0; $i < strlen($ekspresi); $i++) {

        $karakter = $ekspresi[$i];


        // ----------------------------------------------------
        // Kalau karakter adalah angka atau titik
        // ----------------------------------------------------

        if (
            is_numeric($karakter) ||
            $karakter == "."
        ) {

            $angka .= $karakter;

        }


        // ----------------------------------------------------
        // Kalau karakter adalah operator
        // ----------------------------------------------------

        elseif (
            $karakter == "+" ||
            $karakter == "-" ||
            $karakter == "*" ||
            $karakter == "/"
        ) {

            // Pastikan angka sebelumnya ada
            if ($angka == "") {
                return "Error";
            }

            // Simpan angka
            $angkaList[] = $angka;

            // Simpan operator
            $operatorList[] = $karakter;

            // Kosongkan angka
            $angka = "";
        }


        // ----------------------------------------------------
        // Karakter tidak dikenal
        // ----------------------------------------------------

        else {

            return "Error";
        }
    }


    // ========================================================
    // 3. SIMPAN ANGKA TERAKHIR
    // ========================================================

    if ($angka == "") {
        return "Error";
    }

    $angkaList[] = $angka;


    // ========================================================
    // 4. CEK JUMLAH ANGKA DAN OPERATOR
    // ========================================================

    if (
        count($angkaList)
        !=
        count($operatorList) + 1
    ) {

        return "Error";
    }


    // ========================================================
    // 5. PRIORITAS PERKALIAN DAN PEMBAGIAN
    // ========================================================

    $hasilAngka = [];
    $hasilOperator = [];


    // Angka pertama
    $hasilAngka[] = $angkaList[0];


    for ($i = 0; $i < count($operatorList); $i++) {

        $operator = $operatorList[$i];

        $angkaBerikutnya = $angkaList[$i + 1];


        // ----------------------------------------------------
        // PERKALIAN
        // ----------------------------------------------------

        if ($operator == "*") {

            $indexTerakhir =
                count($hasilAngka) - 1;

            $hasilAngka[$indexTerakhir] =
                $hasilAngka[$indexTerakhir]
                *
                $angkaBerikutnya;
        }


        // ----------------------------------------------------
        // PEMBAGIAN
        // ----------------------------------------------------

        elseif ($operator == "/") {

            // Tidak boleh membagi 0
            if ($angkaBerikutnya == 0) {
                return "Error";
            }

            $indexTerakhir =
                count($hasilAngka) - 1;

            $hasilAngka[$indexTerakhir] =
                $hasilAngka[$indexTerakhir]
                /
                $angkaBerikutnya;
        }


        // ----------------------------------------------------
        // TAMBAH DAN KURANG
        // ----------------------------------------------------

        else {

            $hasilOperator[] = $operator;

            $hasilAngka[] = $angkaBerikutnya;
        }
    }


    // ========================================================
    // 6. HITUNG + DAN -
    // ========================================================

    $hasil = $hasilAngka[0];


    for ($i = 0; $i < count($hasilOperator); $i++) {

        if ($hasilOperator[$i] == "+") {

            $hasil += $hasilAngka[$i + 1];

        }

        elseif ($hasilOperator[$i] == "-") {

            $hasil -= $hasilAngka[$i + 1];
        }
    }


    // ========================================================
    // 7. HASIL AKHIR
    // ========================================================

    return $hasil;
}


// ============================================================
// 8. VARIABEL DISPLAY
// ============================================================

$display = "0";


// ============================================================
// 9. CEK APAKAH ADA TOMBOL YANG DITEKAN
// ============================================================

if (isset($_POST["tombol"])) {

    $tombol = $_POST["tombol"];


    // ========================================================
    // 10. TOMBOL ANGKA
    // ========================================================

    if (is_numeric($tombol)) {

        // Kalau display masih 0
        if ($display == "0") {

            $display = $tombol;

        }

        // Kalau sudah ada angka
        else {

            $display .= $tombol;
        }
    }


    // ========================================================
    // 11. TOMBOL TITIK
    // ========================================================

    elseif ($tombol == ".") {

        $display .= ".";
    }


    // ========================================================
    // 12. TOMBOL OPERATOR
    // ========================================================

    elseif (
        $tombol == "+" ||
        $tombol == "-" ||
        $tombol == "*" ||
        $tombol == "/"
    ) {

        // Jangan izinkan operator
        // kalau display masih 0

        if ($display == "0") {

            $display = "0" . $tombol;

        }

        else {

            $display .= $tombol;
        }
    }


    // ========================================================
    // 13. TOMBOL CLEAR
    // ========================================================

    elseif ($tombol == "C") {

        $display = "0";
    }


    // ========================================================
    // 14. TOMBOL BACKSPACE
    // ========================================================

    elseif ($tombol == "BACK") {

        $display =
            substr(
                $display,
                0,
                -1
            );


        // Kalau kosong
        if ($display == "") {

            $display = "0";
        }
    }


    // ========================================================
    // 15. TOMBOL SAMA DENGAN
    // ========================================================

    elseif ($tombol == "=") {

        $display = hitung($display);
    }


    // ========================================================
    // 16. TOMBOL PERSEN
    // ========================================================

    elseif ($tombol == "%") {

        // Ubah angka terakhir menjadi persen

        $angkaTerakhir = "";

        $posisi = strlen($display) - 1;


        while (
            $posisi >= 0 &&
            (
                is_numeric($display[$posisi])
                ||
                $display[$posisi] == "."
            )
        ) {

            $angkaTerakhir =
                $display[$posisi]
                . $angkaTerakhir;

            $posisi--;
        }


        if ($angkaTerakhir != "") {

            $persen =
                $angkaTerakhir / 100;


            $display =
                substr(
                    $display,
                    0,
                    $posisi + 1
                )
                .
                $persen;
        }
    }
}

?>


<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Kalkulator PHP</title>


    <!-- =====================================================
         CSS
         ===================================================== -->

    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            background: #202020;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* ===================================================
           CONTAINER KALKULATOR
           =================================================== */

        .calculator {

            width: 360px;

            padding: 20px;

            background: #1f1f1f;

            border-radius: 15px;

            box-shadow:
                0 10px 30px
                rgba(0, 0, 0, 0.4);
        }


        /* ===================================================
           DISPLAY
           =================================================== */

        .display {

            width: 100%;

            min-height: 100px;

            padding: 20px;

            margin-bottom: 15px;

            display: flex;

            align-items: end;

            justify-content: end;

            overflow: hidden;

            border-radius: 10px;

            background: #292929;

            color: white;

            font-size: 42px;

            font-weight: bold;

            word-break: break-all;
        }


        /* ===================================================
           GRID TOMBOL
           =================================================== */

        .buttons {

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 8px;
        }


        /* ===================================================
           SEMUA BUTTON
           =================================================== */

        button {

            height: 65px;

            border: none;

            border-radius: 8px;

            background: #333333;

            color: white;

            font-size: 20px;

            cursor: pointer;

            transition:
                background 0.1s,
                transform 0.05s;
        }


        button:hover {

            background: #444444;
        }


        button:active {

            transform: scale(0.96);
        }


        /* ===================================================
           OPERATOR
           =================================================== */

        .operator {

            background: #444444;
        }


        .operator:hover {

            background: #555555;
        }


        /* ===================================================
           CLEAR
           =================================================== */

        .clear {

            background: #555555;
        }


        /* ===================================================
           SAMA DENGAN
           =================================================== */

        .equals {

            background: #0067c0;

            grid-row: span 2;
        }


        .equals:hover {

            background: #0078d4;
        }


        /* ===================================================
           ANGKA 0
           =================================================== */

        .zero {

            grid-column: span 2;
        }

    </style>

</head>


<body>


    <!-- =====================================================
         KALKULATOR
         ===================================================== -->

    <div class="calculator">


        <!-- =================================================
             DISPLAY
             ================================================= -->

        <div class="display">

            <?php

            echo htmlspecialchars($display);

            ?>

        </div>


        <!-- =================================================
             FORM
             ================================================= -->

        <form method="POST">


            <div class="buttons">


                <!-- =========================================
                     BARIS 1
                     ========================================= -->


                <!-- CLEAR -->

                <button
                    type="submit"
                    name="tombol"
                    value="C"
                    class="clear"
                >
                    C
                </button>


                <!-- BACKSPACE -->

                <button
                    type="submit"
                    name="tombol"
                    value="BACK"
                >
                    ⌫
                </button>


                <!-- PERSEN -->

                <button
                    type="submit"
                    name="tombol"
                    value="%"
                >
                    %
                </button>


                <!-- BAGI -->

                <button
                    type="submit"
                    name="tombol"
                    value="/"
                    class="operator"
                >
                    ÷
                </button>



                <!-- =========================================
                     BARIS 2
                     ========================================= -->


                <!-- 7 -->

                <button
                    type="submit"
                    name="tombol"
                    value="7"
                >
                    7
                </button>


                <!-- 8 -->

                <button
                    type="submit"
                    name="tombol"
                    value="8"
                >
                    8
                </button>


                <!-- 9 -->

                <button
                    type="submit"
                    name="tombol"
                    value="9"
                >
                    9
                </button>


                <!-- KALI -->

                <button
                    type="submit"
                    name="tombol"
                    value="*"
                    class="operator"
                >
                    ×
                </button>



                <!-- =========================================
                     BARIS 3
                     ========================================= -->


                <!-- 4 -->

                <button
                    type="submit"
                    name="tombol"
                    value="4"
                >
                    4
                </button>


                <!-- 5 -->

                <button
                    type="submit"
                    name="tombol"
                    value="5"
                >
                    5
                </button>


                <!-- 6 -->

                <button
                    type="submit"
                    name="tombol"
                    value="6"
                >
                    6
                </button>


                <!-- KURANG -->

                <button
                    type="submit"
                    name="tombol"
                    value="-"
                    class="operator"
                >
                    −
                </button>



                <!-- =========================================
                     BARIS 4
                     ========================================= -->


                <!-- 1 -->

                <button
                    type="submit"
                    name="tombol"
                    value="1"
                >
                    1
                </button>


                <!-- 2 -->

                <button
                    type="submit"
                    name="tombol"
                    value="2"
                >
                    2
                </button>


                <!-- 3 -->

                <button
                    type="submit"
                    name="tombol"
                    value="3"
                >
                    3
                </button>


                <!-- TAMBAH -->

                <button
                    type="submit"
                    name="tombol"
                    value="+"
                    class="operator"
                >
                    +
                </button>



                <!-- =========================================
                     BARIS 5
                     ========================================= -->


                <!-- 0 -->

                <button
                    type="submit"
                    name="tombol"
                    value="0"
                    class="zero"
                >
                    0
                </button>


                <!-- TITIK -->

                <button
                    type="submit"
                    name="tombol"
                    value="."
                >
                    .
                </button>


                <!-- SAMA DENGAN -->

                <button
                    type="submit"
                    name="tombol"
                    value="="
                    class="equals"
                >
                    =
                </button>


            </div>

        </form>

    </div>


</body>

</html>
