<?php
    include "db.php";

    if(isset($_GET['id']) && $_GET['id'] != "") {
        $id = $_GET['id'];
    }
    $sql_nekretnina= "SELECT * FROM nekretnina WHERE id=$id";
    $res_nekretnina = mysqli_query($dbconn, $sql_nekretnina);
    $n=mysqli_fetch_assoc($res_nekretnina);
    $slike = explode(',', $n['slika']);

    $sql_grad= "SELECT * FROM sifarnik_gradova WHERE id=$n[grad_id]";
    $res_grad = mysqli_query($dbconn, $sql_grad);
    $g=mysqli_fetch_assoc($res_grad);

    $sql_oglas= "SELECT * FROM sifarnik_oglasa WHERE id=$n[oglas_id]";
    $res_oglas = mysqli_query($dbconn, $sql_oglas);
    $o=mysqli_fetch_assoc($res_oglas);

    $sql_tip= "SELECT * FROM sifarnik_tipova WHERE id=$n[tip_id]";
    $res_tip = mysqli_query($dbconn, $sql_tip);
    $t=mysqli_fetch_assoc($res_tip);

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
        <div class="flex w-full pb-4">
            <div class="mx-auto">
                <?php if($n['status'] == 'Dostupno') {
                ?>
                    <a class="p-2 mr-1 text-center text-white uppercase bg-green-500 rounded-lg cursor-pointer hover:bg-green-900 font-galanomedium" href="prodaj.php?id=<?php echo $n['id']?>">
                    <?php if($o['oglas'] == "Prodaja") {
                        echo "Prodaj";
                        } else if($o['oglas'] == "Iznajmljivanje") {
                        echo "Iznajmi";
                        } else {
                        echo "Kompenzuj";
                        }
                    ?>
                    </a>
                <?php 
                }
                ?>
                <button
                    class="p-2 text-white uppercase bg-yellow-500 rounded-lg cursor-pointer modal-open font-galanomedium" onclick='izmijeniNekretninu(<?php echo $n["id"] ?>)'>Izmijeni
                </button>                    
                <a class="p-2 text-center text-white uppercase bg-red-500 rounded-lg cursor-pointer hover:bg-red-900 font-galanomedium" href="izbrisi_nekretninu.php?id=<?php echo $n['id']?>">Izbrisi</a>
            </div>
        </div>
        <div class="relative mb-5 overflow-hidden text-sm break-words rounded-lg bg-block text-text2 font-notoserif">
        
            <div class="w-full owl-carousel owl-theme">
                <?php foreach($slike as $s) {
                    echo "<div class='item'>";
                    echo "<div>";
                    echo "<img loading='lazy' class='h-502px' src='img/".$s."' alt='slider'>"; 
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            <?php
            echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-yellow-500 top-4 font-galanomedium'>".$o['oglas']."</div>";
            if($n['status'] == 'Dostupno') {
                echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-green-500 top-12 font-galanomedium'>".$n['status']."</div>";
            } else {
                echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-red-500 top-12 font-galanomedium'>".$n['status']."</div>";
            }
            echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-blue-500 top-20 font-galanomedium'>".$t['tip'].", ".$n['povrsina']."m&#xb2;</div>";
            echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-pink-500 top-28 font-galanomedium'>".$g['ime_grada'].", ".$n['adresa']."</div>";
            echo "<div class='absolute right-0 z-10 p-1 text-white uppercase bg-purple-500 top-36 font-galanomedium'>".$n['cijena']."&euro;</div>";

            if($o['oglas'] == 'Iznajmljivanje') {
                $tip = "Iznajmljuje se ";
            } else if($o['oglas'] == 'Prodaja') {
                $tip = "Prodaje se ";
            } else {
                $tip = "Kompenzuje se ";
            }
            echo "<div class='pt-2 pl-5'>";
            echo "<p class='text-xl text'>".$tip."<span class='text-text1'>".strtolower($t['tip']).", ".$n['povrsina']."m&#xb2;</span>";
            echo " na lokaciji " .$g['ime_grada'].", ".$n['adresa']." po cijeni od <span class='text-text1'>".$n['cijena']."&euro;. </span>";
            echo $t['tip']." je izgradjen/a ".$n['godina_izgradnje']." godine. ".$n['opis'].".</p>";
            echo "<p class='pt-10'>Objavljeno: ".$n['datum_objavljivanja']."</p>";
            if($n['status'] == 'Nedostupno') {
                if($o['oglas'] == 'Prodaja') {
                    echo "<p class='pt-2 pb-2'>Datum prodaje: ".$n['datum_prodaje']."</p>";
                } else if($o['oglas'] == 'Iznajmljivanje') {
                    echo "<p class='pt-2 pb-2'>Datum iznajmljivanja: ".$n['datum_prodaje']."</p>";
                } else {
                    echo "<p class='pt-2 pb-2'>Datum kompenzacije: ".$n['datum_prodaje']."</p>";
                }
            }
            echo "</div>";
            echo "</div>";
            
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
                    <p class="text-2xl text-white uppercase font-galanobold">Izmijeni nekretninu!</p>
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
                <form action="./izmijeni_nekretninu.php" method="post" enctype="multipart/form-data">
                    <div>
                        <input type="hidden" id="nekretnina_id_izmjena" name="nekretnina_id" value="">
                        <input type="hidden" name="slike_izmjena" value="<?php echo $n['slika']?>">
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