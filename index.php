<?php
    include 'db.php';
        $nekretine = [];
        $where_arr = [];
        $where_arr[] = " 1=1 ";
        $greska = "";
        if( isset($_GET['greska']) && $_GET['greska'] != "" ){
            $greska = $_GET['greska'];
        }
        if( isset($_POST['gradovi']) && $_POST['gradovi'] != "" ){
            $grad = strtolower($_POST['gradovi']);
            $where_arr[] = " lower(grad_id) LIKE '%$grad%' ";
        }
        if( isset($_POST['tipovi']) && $_POST['tipovi'] != "" ){
            $tip = strtolower($_POST['tipovi']);
            $where_arr[] = " lower(tip_id) LIKE '%$tip%' ";
        }
        if( isset($_POST['oglasi']) && $_POST['oglasi'] != "" ){
            $oglas = strtolower($_POST['oglasi']);
            $where_arr[] = " lower(oglas_id) LIKE '%$oglas%' ";
        }
        if( isset($_POST['godina']) && $_POST['godina'] != "" ){
            $godina = strtolower($_POST['godina']);
            $where_arr[] = " lower(godina_izgradnje) LIKE '%$godina%' ";
        }
    
        if( isset($_POST['povrsinaOd']) && isset($_POST['povrsinaOd']) ){
            $povrsinaDo = strtolower($_POST['povrsinaDo']);
            $povrsinaOd = strtolower($_POST['povrsinaOd']);
            if($_POST['povrsinaDo'] == "" && $_POST['povrsinaOd'] != "") {
                $where_arr[] = " lower(povrsina) >=$povrsinaOd ";

            } else if($_POST['povrsinaOd'] == "" && $_POST['povrsinaDo'] != "") {
                $where_arr[] = " lower(povrsina) <= $povrsinaDo ";
            } else if($_POST['povrsinaOd'] != "" && $_POST['povrsinaDo'] != "") {
                $where_arr[] = " lower(povrsina) >= $povrsinaOd AND lower(povrsina) <= $povrsinaDo ";
            } 
        }
        if( isset($_POST['cijenaOd']) && isset($_POST['cijenaDo']) ){
            $cijenaDo = strtolower($_POST['cijenaDo']);
            $cijenaOd = strtolower($_POST['cijenaOd']);
            if($_POST['cijenaDo'] == "" && $_POST['cijenaOd'] != "") {
                $where_arr[] = " lower(cijena) >= $cijenaOd ";
            } else if($_POST['cijenaOd'] == "" && $_POST['cijenaDo'] != "") {
                $where_arr[] = " lower(cijena) <= $cijenaDo ";
            } else if($_POST['cijenaOd'] != "" && $_POST['cijenaDo'] != "") {
                $where_arr[] = " lower(cijena) >= $cijenaOd AND lower(cijena) <= $cijenaDo ";
            } 
        }
        $where_str = implode("AND", $where_arr );
        $sqlNekretnine = "SELECT nekretnina.id, nekretnina.povrsina, nekretnina.datum_prodaje, nekretnina.godina_izgradnje, nekretnina.status, nekretnina.datum_objavljivanja, nekretnina.cijena, nekretnina.adresa, nekretnina.slika, sifarnik_gradova.ime_grada, sifarnik_oglasa.oglas, sifarnik_tipova.tip FROM nekretnina INNER JOIN sifarnik_gradova ON nekretnina.grad_id = sifarnik_gradova.id LEFT JOIN sifarnik_oglasa ON nekretnina.oglas_id = sifarnik_oglasa.id LEFT JOIN sifarnik_tipova ON nekretnina.tip_id = sifarnik_tipova.id WHERE $where_str";

        $resNekretnine = mysqli_query($dbconn, $sqlNekretnine);
    while($row=mysqli_fetch_assoc($resNekretnine)) {
        $nekretine[] = $row;
    }
    $sqlGradovi = "SELECT * FROM sifarnik_gradova";
    $resGradovi = mysqli_query($dbconn, $sqlGradovi);
    while($rowG = mysqli_fetch_assoc($resGradovi)) {
        $gradovi[] = $rowG;
    }
    $sqlTip = "SELECT * FROM sifarnik_tipova";
    $resTipovi = mysqli_query($dbconn, $sqlTip);
    while($rowT = mysqli_fetch_assoc($resTipovi)) {
        $tipovi[] = $rowT;
    }
    $sqlOglas = "SELECT * FROM sifarnik_oglasa";
    $resOglas = mysqli_query($dbconn, $sqlOglas);
    while($rowO = mysqli_fetch_assoc($resOglas)) {
        $oglasi[] = $rowO;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Agency</title>

    <!-- Preloading styles -->
    <link rel="preload" href="style/style.css" as="style">
    <link rel="preload" href="style/owl.carousel.min.css" as="style">
    <link rel="preload" href="style/owl.theme.default.min.css" as="style">
    <!-- End preloading styles -->

    <!-- Preloading scripts -->
    <link rel="preload" href="js/owl.carousel.min.js" as="script">
    <link rel="preload" href="js/app.js" as="script">
    <!-- End preloading scripts -->

    <!-- Styles -->
    <link rel="stylesheet" href="style/style.css" async>
    <link rel="stylesheet" href="style/owl.carousel.min.css" async>
    <link rel="stylesheet" href="style/owl.theme.default.min.css" async>
    <!-- End Styles -->
</head>

<body class="relative bg-cover bg-coverImg">
    <header class="w-full h-16 bg-header">
        <div class="w-1/2 pt-5 mx-auto">
            <div class="ml-40 text-base text-white uppercase font-galanobold">
                <a class="cursor-pointer hover:text-yellow-500" href="index.php">
                    Nekretnine
                </a>
                <a class="ml-40 cursor-pointer hover:text-yellow-500" href="gradovi.php">
                    Gradovi
                </a>
                <a class="ml-40 cursor-pointer hover:text-yellow-500" href="tipovi_nekretnina.php">
                    Tipovi nekretnina
                </a>
            </div>
        </div>
    </header>
    <div class="absolute moving-shape top-40 left-32">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="absolute moving-shape top-80 left-60">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="absolute moving-shape top-40 right-32">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="absolute moving-shape top-80 right-60">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="w-1/2 mx-auto mt-14">
        <form action="./index.php" method="POST">
            <div class="grid grid-cols-3 pb-6 pl-1">
                <div>
                    <label for="price"
                        class="block text-base text-center text-white uppercase font-galanomedium">Grad</label>
                    <div class="w-full mt-1 rounded-md">
                        <select id="gradovi" name="gradovi"
                            class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                            <option selected="true" disabled="disabled">Izaberi grad</option>
                            <?php 
                                foreach($gradovi as $g) {
                                    echo "<option value=".$g['id'].">".$g['ime_grada']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="price" class="block text-base text-center text-white uppercase font-galanomedium">Tip
                        nekretnine</label>
                    <div class="w-full mt-1 rounded-md">
                        <select id="tipovi" name="tipovi"
                            class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                            <option selected="true" disabled="disabled">Izaberi tip</option>
                            <?php 
                                foreach($tipovi as $t) {
                                    echo "<option value=".$t['id'].">".$t['tip']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="price" class="block text-base text-center text-white uppercase font-galanomedium">Tip
                        oglasa</label>
                    <div class="w-full mt-1 rounded-md ">

                        <select id="oglasi" name="oglasi"
                            class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                            <option selected="true" disabled="disabled">Izaberi oglas</option>
                            <?php 
                                foreach($oglasi as $o) {
                                    echo "<option value=".$o['id'].">".$o['oglas']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="pt-3">
                    <label for="price" class="block text-base text-center text-white uppercase font-galanomedium">Godina
                        izgradnje</label>
                    <div class="w-full mt-1 rounded-md">
                        <input type="text" id="godina" name="godina"
                            class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                    </div>
                </div>
                <div class="pt-3">
                    <label for="price"
                        class="block text-base text-center text-white uppercase font-galanomedium">Povrsina</label>
                    <div class="flex w-full mt-1 rounded-md">
                        <input type="text" id="povrsinaOd" name="povrsinaOd"
                            class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-132px sm:text-sm">
                        <p class="ml-2 text-lg text-white font-galanomedium">-</p>
                        <input type="text" id="povrsinaDo" name="povrsinaDo"
                            class="h-8 ml-2 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-132px sm:text-sm">
                    </div>
                </div>
                <div class="pt-3">
                    <label for="price"
                        class="block text-base text-center text-white uppercase font-galanomedium">Cijena</label>
                    <div class="flex w-full mt-1 rounded-md">
                        <input type="text" id="cijenaOd" name="cijenaOd"
                            class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-132px sm:text-sm">
                        <p class="ml-2 text-lg text-white font-galanomedium">-</p>
                        <input type="text" id="cijenaDo" name="cijenaDo"
                            class="h-8 ml-2 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-132px sm:text-sm">
                    </div>
                </div>
            </div>
            <div class="flex w-full pb-16">
                <div class="mx-auto">
                    <button
                        class='p-2 text-white uppercase bg-green-500 rounded-lg cursor-pointer font-galanomedium'>Pretraga</button>
                    <a class='p-2 ml-6 text-white uppercase bg-red-500 rounded-lg cursor-pointer font-galanomedium'>Ocisti
                        pretragu</a>
                </div>
            </div>
        </form>
        <div class="">
            <?php
                if($greska != null) {
                    echo "<p class='text-2xl text-center text-red-500 uppercase font-galanomedium'>".$greska."</p>";
                }
                if($nekretine != null) {
                    echo "<p class='text-lg text-yellow-500 uppercase font-galanomedium'>".count($nekretine)." rezultata</p>";
                } else {
                    echo "<p class='text-2xl text-center text-red-500 uppercase font-galanomedium'>Nema rezultata. Pokusajte ponovo!</p>";
                }
            ?>
        </div>
        <div class="mb-2">
            <button
                class="p-2 text-white uppercase bg-yellow-500 rounded-lg cursor-pointer modal-open font-galanomedium">Dodaj
                nektretninu
            </button>
        </div>
        <?php
             if(count($nekretine)==2) {
                echo "<div class='grid grid-cols-2'>";
            } else if(count($nekretine)==1) {
                echo "<div class='grid grid-cols-1'>";
            } else {
                echo "<div class='grid grid-cols-3'>";
            }
            foreach($nekretine as $n) {
                $slike = explode(',', $n['slika']);
                echo "<div class='relative mb-5 mr-5 overflow-hidden text-sm break-words rounded-lg bg-block text-text2 font-notoserif'>";
        ?>
        <div class="w-full owl-carousel owl-theme">
            <?php foreach($slike as $s) {
                echo "<div class='item'>";
                echo "<div>";
                echo "<img loading='lazy' class='h-179px' src='img/".$s."' alt='slider'>"; 
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
        <?php
            echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-yellow-500 top-4 font-galanomedium'>".$n['oglas']."</div>";
            if($n['status'] == 'Dostupno') {
                echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-green-500 top-12 font-galanomedium'>".$n['status']."</div>";
            } else {
                echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-red-500 top-12 font-galanomedium'>".$n['status']."</div>";
            }
            echo "<div class='pt-2 pl-5'>";
            echo "<p class='text-xl text-text1'>".$n['tip'].", ".$n['povrsina']."m&#xb2;</p>";
            echo "<div class='flex pt-2 -ml-1 italic text-text'>";
            echo "<svg class='block w-5 h-5' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'>";
            echo "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z' />";
            echo "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 11a3 3 0 11-6 0 3 3 0 016 0z' />";
            echo "</svg>";
            echo "<p class='block'>".$n['ime_grada'].", ".$n['adresa']."</p>";
            echo "</div>";
            echo "<p class='pt-2 text-lg text-text1'>".$n['cijena']."&euro;</p>";
            echo "<div class='flex-col pt-2'>";
            echo "<p>Godina izgradnje: ".$n['godina_izgradnje']."</p>";
            echo "<p class='pt-2'>Kvadratura: ".$n['povrsina']."m&#xb2;</p>";
            echo "<p class='pt-2'>Objavljeno: ".$n['datum_objavljivanja']."</p>";
            if($n['status'] == 'Nedostupno') {
                if($n['oglas'] == 'Prodaja') {
                    echo "<p class='pt-2'>Datum prodaje: ".$n['datum_prodaje']."</p>";
                } else if($n['oglas'] == 'Iznajmljivanje') {
                    echo "<p class='pt-2'>Datum iznajmljivanja: ".$n['datum_prodaje']."</p>";
                } else {
                    echo "<p class='pt-2'>Datum kompenzacije: ".$n['datum_prodaje']."</p>";
                }
            }
            echo "</div>";
            echo "</div>";
            echo "<div class='mt-5 mb-2 ml-24'>";
            
        ?>
            <a class="bottom-0 p-2 mx-auto text-center text-white uppercase bg-yellow-500 rounded-lg cursor-pointer hover:bg-yellow-900 font-galanomedium" href="nekretnina.php?id=<?php echo $n['id']?>">Detaljnije</a>
                <?php 
                    echo "</div>";
                    echo "</div>";
                }
            ?>
    </div>
    </div>



    <!--Modal-->
    <div
        class="fixed top-0 left-0 z-10 flex items-center justify-center w-full h-full opacity-0 pointer-events-none modal">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 modal-overlay"></div>

        <div class="z-50 w-11/12 mx-auto overflow-y-auto rounded shadow-lg modal-container bg-coverImg md:max-w-md">

            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center mt-4 mr-4 text-sm text-white cursor-pointer modal-close">
                <svg class="text-white fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="px-6 py-4 text-left modal-content">
                <!--Title-->
                <div class="flex items-center justify-between pb-3">
                    <p class="text-2xl text-white uppercase font-galanobold">Dodaj nekretninu!</p>
                    <div class="z-50 cursor-pointer modal-close">
                        <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <form action="./sacuvaj_nekretninu.php" method="post" enctype="multipart/form-data">
                    <div>
                        <div class="mt-2">
                            <label for="price"
                                class="block text-base text-left text-white uppercase font-galanomedium">Grad</label>
                            <div class="w-full mt-1 rounded-md">
                                <select id="gradovi" name="gradovi"
                                    class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                                    <option selected="true" disabled="disabled">Izaberi grad</option>
                                    <?php 
                                foreach($gradovi as $g) {
                                    echo "<option value=".$g['id'].">".$g['ime_grada']."</option>";
                                }
                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="price"
                                class="block text-base text-left text-white uppercase font-galanomedium">Tip
                                nekretnine</label>
                            <div class="w-full mt-1 rounded-md">
                                <select id="tipovi" name="tipovi"
                                    class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                                    <option selected="true" disabled="disabled">Izaberi tip</option>
                                    <?php 
                                foreach($tipovi as $t) {
                                    echo "<option value=".$t['id'].">".$t['tip']."</option>";
                                }
                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="price"
                                class="block text-base text-left text-white uppercase font-galanomedium">Tip
                                oglasa</label>
                            <div class="w-full mt-1 rounded-md ">
                                <select id="oglasi" name="oglasi"
                                    class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                                    <option selected="true" disabled="disabled">Izaberi oglas</option>
                                    <?php 
                                foreach($oglasi as $o) {
                                    echo "<option value=".$o['id'].">".$o['oglas']."</option>";
                                }
                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="pt-3">
                            <label for="price"
                                class="block text-base text-left text-white uppercase font-galanomedium">Adresa
                            </label>
                            <div class="w-full mt-1 rounded-md">
                                <input type="text" id="adresa" name="adresa"
                                    class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                            </div>
                        </div>
                        <div class="pt-3">
                            <label for="price"
                                class="block text-base text-left text-white uppercase font-galanomedium">Godina
                                izgradnje</label>
                            <div class="w-full mt-1 rounded-md">
                                <input type="text" id="godina" name="godina"
                                    class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                            </div>
                        </div>
                        <div class="pt-3">
                            <label for="price"
                                class="inline-block text-base text-left text-white uppercase font-galanomedium">Povrsina</label>
                            <label for="price"
                                class="inline-block ml-16 text-base text-left text-white uppercase font-galanomedium">Cijena</label>
                            <div class="flex w-full mt-1 rounded-md">
                                <input type="text" id="povrsina" name="povrsina"
                                    class="h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-132px sm:text-sm">
                                <input type="text" id="cijena" name="cijena"
                                    class="h-8 ml-5 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-132px sm:text-sm">
                            </div>
                        </div>
                        <div class="pt-3">
                            <label for="price"
                                class="block text-base text-left text-white uppercase font-galanomedium">Opis
                            </label>
                            <div class="w-full mt-1 rounded-md">
                                <textarea id="opis" name="opis" rows="5"
                                    class="text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 w-72 sm:text-sm">
                                    </textarea>
                            </div>
                        </div>
                        <div class="pt-3">
                            <label for="price"
                                class="block text-base text-left text-white uppercase font-galanomedium">Slike</label>
                            <div
                                class="relative flex items-center justify-center h-40 bg-white border-2 border-gray-200 border-dashed rounded-lg hover:cursor-pointer">
                                <div class="absolute">
                                    <div class="flex flex-col items-center "> <i
                                            class="text-gray-200 fa fa-cloud-upload fa-3x"></i> <span
                                            class="block font-normal text-gray-400">Attach you files here</span>
                                        <span class="block font-normal text-gray-400">or</span> <span
                                            class="block font-normal text-blue-400">Browse files</span>
                                    </div>
                                </div> <input type="file" name="slike[]" class="w-full h-full opacity-0" multiple>
                            </div>

                        </div>


                    </div>
            </div>
            <!--Footer-->
            <div class="flex justify-center pt-2 pb-2">
                <button
                    class="p-2 text-white uppercase bg-green-500 rounded-lg cursor-pointer font-galanomedium'">Dodaj</button>
            </div>
            </form>
        </div>
    </div>
    </div>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/owl.carousel.min.js" defer></script>
    <script type="text/javascript" src="js/app.js" defer></script>
    <!-- End Scripts -->
</body>

</html>