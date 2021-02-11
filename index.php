<?php
    include 'db.php';
        $nekretine = [];
        $where_arr = [];
        $where_arr[] = " 1=1 ";
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
            if($_POST['povrsinaDo'] == "") {
                $where_arr[] = " lower(povrsina) >= '$povrsinaOd' ";

            } else if($_POST['povrsinaOd'] == "") {
                $where_arr[] = " lower(povrsina) <= '$povrsinaDo' ";
            } else if($_POST['povrsinaOd'] != "" && $_POST['povrsinaDo'] != "") {
                $where_arr[] = " lower(povrsina) >= $povrsinaOd AND lower(povrsina) <= $povrsinaDo ";
            } 
        }
        if( isset($_POST['cijenaOd']) && isset($_POST['cijenaDo']) ){
            $cijenaDo = strtolower($_POST['cijenaDo']);
            $cijenaOd = strtolower($_POST['cijenaOd']);
            if($_POST['cijenaDo'] == "") {
                $where_arr[] = " lower(cijena) >= '$cijenaOd' ";
            } else if($_POST['cijenaOd'] == "") {
                $where_arr[] = " lower(cijena) <= '$cijenaDo' ";
            } else if($_POST['cijenaOd'] != "" && $_POST['cijenaDo'] != "") {
                $where_arr[] = " lower(cijena) >= '$cijenaOd' AND lower(cijena) <= '$cijenaDo' ";
            } 
        }
        $where_str = implode("AND", $where_arr );
        $sqlNekretnine = "SELECT * FROM nekretnina LEFT JOIN sifarnik_gradova ON nekretnina.grad_id = sifarnik_gradova.id LEFT JOIN sifarnik_oglasa ON nekretnina.oglas_id = sifarnik_oglasa.id LEFT JOIN sifarnik_tipova ON nekretnina.tip_id = sifarnik_tipova.id WHERE $where_str";

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
<body class="relative bg-coverImg bg-cover">
    <header class="h-16 bg-header w-full">
        <div class="pt-5 w-1/2 mx-auto">
            <div class="ml-32 text-base text-white font-galanobold uppercase">
                <a class="">
                    Dodaj grad
                </a>
                <a class="ml-32">
                    Dodaj nekretninu
                </a>
                <a class="ml-32">
                    Dodaj tip
                </a>
            </div>
        </div>
    </header>
    <div class="moving-shape absolute top-40 left-32">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="moving-shape absolute top-80 left-60">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="moving-shape absolute top-40 right-32">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="moving-shape absolute top-80 right-60">
        <img width="50px" height="50px" src="img/shape1.png">
    </div>
    <div class="w-1/2 mx-auto mt-14">
        <form action="./index.php" method="POST">
            <div class="pl-1 pb-6 grid grid-cols-3">
                <div>
                    <label for="price" class="block text-base font-galanomedium text-center text-white uppercase">Grad</label>
                    <div class="mt-1 w-full rounded-md">
                        <select id="gradovi" name="gradovi" class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-72 border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
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
                    <label for="price" class="block text-base font-galanomedium text-center text-white uppercase">Tip nekretnine</label>
                    <div class="mt-1 w-full rounded-md">
                        <select id="tipovi" name="tipovi" class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-72 border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
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
                    <label for="price" class="block text-base font-galanomedium text-center text-white uppercase">Tip oglasa</label>
                    <div class="mt-1 w-full rounded-md ">
        
                        <select id="oglasi" name="oglasi" class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-72 border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
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
                    <label for="price" class="block text-base font-galanomedium text-center text-white uppercase">Godina izgradnje</label>
                    <div class="mt-1 w-full rounded-md">
                        <input type="text" id="godina" name="godina" class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-72 border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
                    </div>
                </div>
                <div class="pt-3">
                <label for="price" class="block text-base font-galanomedium  text-center text-white uppercase">Povrsina</label>
                    <div class="mt-1 w-full rounded-md flex">
                        <input type="text" id="povrsinaOd" name="povrsinaOd" class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-132px border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
                        <p class="font-galanomedium text-lg ml-2 text-white">-</p>
                        <input type="text" id="povrsinaDo" name="povrsinaDo" class="focus:ring-indigo-500 focus:border-indigo-500 ml-2 h-8 w-132px border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
                    </div>
                </div>
                <div class="pt-3">
                <label for="price" class="block text-base font-galanomedium text-center text-white uppercase">Cijena</label>
                    <div class="mt-1 w-full rounded-md flex">
                        <input type="text" id="cijenaOd" name="cijenaOd" class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-132px border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
                        <p class="font-galanomedium text-lg ml-2 text-white">-</p>
                        <input type="text" id="cijenaDo" name="cijenaDo" class="focus:ring-indigo-500 focus:border-indigo-500 ml-2 h-8 w-132px border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
                    </div>
                </div>
            </div>
            <div class="w-full flex pb-16">
                <div class="mx-auto">
                    <button class='cursor-pointer bg-green-500 rounded-lg p-2 text-white font-galanomedium uppercase'>Pretraga</button>
                    <a class='cursor-pointer bg-red-500 rounded-lg p-2 ml-6 text-white font-galanomedium uppercase'>Ocisti pretragu</a>
                </div>
            </div>
        </form>
        <div class="">
            <?php
                if($nekretine != null) {
                    echo "<p class='font-galanomedium text-lg text-yellow-500 uppercase'>".count($nekretine)." rezultata</p>";
                } else {
                    echo "<p class='font-galanomedium text-center text-2xl text-red-500 uppercase'>Nema rezultata. Pokusajte ponovo!</p>";
                }
            ?>
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
                    echo "<div class='relative overflow-hidden bg-block mb-5  mr-5 rounded-lg break-words text-sm text-text2 font-notoserif'>";
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
                    echo "<div class='absolute right-0 top-4 p-1 bg-yellow-500 text-white uppercase font-galanomedium z-10'>".$n['oglas']."</div>";
                    if($n['status'] == 'Dostupno') {
                        echo "<div class='absolute right-0 top-12 p-1 bg-green-500 text-white uppercase font-galanomedium z-10'>".$n['status']."</div>";
                    } else {
                        echo "<div class='absolute right-0 top-12 p-1 bg-red-500 text-white uppercase font-galanomedium z-10'>".$n['status']."</div>";
                    }
                    echo "<div class='pl-5 pt-2'>";
                    echo "<p class='text-xl text-text1'>".$n['tip'].", ".$n['povrsina']."m&#xb2;</p>";
                    echo "<div class='-ml-1 pt-2 flex italic text-text'>";
                    echo "<svg class='w-5 h-5 block' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'>";
                    echo "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z' />";
                    echo "<path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 11a3 3 0 11-6 0 3 3 0 016 0z' />";
                    echo "</svg>";
                    echo "<p class='block'>".$n['ime_grada'].", ".$n['adresa']."</p>";
                    echo "</div>";
                    echo "<p class='pt-2 text-lg text-text1'>".$n['cijena']."&euro;</p>";
                    echo "<div class='pt-2 flex-col'>";
                    echo "<p>Godina izgradnje: ".$n['godina_izgradnje']."</p>";
                    echo "<p class='pt-2'>Kvadratura: ".$n['povrsina']."m&#xb2;</p>";
                    echo "<p class='pt-2'>Objavljeno: ".$n['datum_objavljivanja']."</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='ml-24 mt-5 mb-2'>";
                    echo "<button class='mx-auto text-center bottom-0 bg-yellow-500 rounded-lg p-2 text-white font-galanomedium uppercase'>Detaljnije</button>";
                    echo "</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    <!-- Scripts -->
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <script src="js/owl.carousel.min.js" defer></script>
    <script type="text/javascript" src="js/app.js" defer></script>
    <!-- End Scripts -->
</body>
</html>
