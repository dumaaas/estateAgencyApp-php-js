<?php
    include 'db.php';
       
    $greska = "";
    if( isset($_GET['greska']) && $_GET['greska'] != "" ){
        $greska = $_GET['greska'];
    }
   
    $sqlTipovi = "SELECT * FROM sifarnik_tipova";
    $resTipovi = mysqli_query($dbconn, $sqlTipovi);
    while($rowT = mysqli_fetch_assoc($resTipovi)) {
        $tipovi[] = $rowT;
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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <!-- End Font Awesome -->
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
        <div class="flex justify-center mb-4">
            <button
                class="p-2 text-white uppercase bg-yellow-500 rounded-lg cursor-pointer modal-open hover:bg-yellow-700 font-galanomedium">
                Dodaj tip
            </button>
        </div>
        <?php
                if($greska != null) {
                    echo "<p class='text-2xl text-center text-red-500 uppercase font-galanomedium'>".$greska."</p>";
                }
                ?>
        <div class="grid grid-cols-4">
            <?php 
            foreach($tipovi as $t) {
            ?>
            <div
                class="relative mb-5 mr-5 overflow-hidden text-sm break-words rounded-lg bg-block text-text2 font-notoserif">
                <div class="p-3">
                    <p class="text-lg text-text1">ID: <?php echo $t['id']?></p>
                    <p class="text-lg text-text1">Tip: <?php echo $t['tip']?></p>
                </div>
                <div class="flex justify-center pb-3">
                    <a class="cursor-pointer" href="izbrisi_tip.php?id=<?php echo $t['id']?>"><i
                            class="text-2xl text-red-500 hover:text-red-900 far fa-trash-alt"></i></a>
                    <a class="cursor-pointer modal-open2"
                        onclick='izmijeniTip(<?php echo $t["id"] ?>)'><i
                            class="ml-2 text-2xl text-blue-500 hover:text-blue-900 far fa-edit"></i></a>
                </div>
            </div>
            <?php
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
                    <p class="text-2xl text-white uppercase font-galanobold">Dodaj tip!</p>
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
                <form action="./dodaj_tip.php" method="post">
                    <div>
                        <div class="mt-2">
                            <div class="w-full mt-1 rounded-md">
                                <input placeholder="Unesite tip nekretnine.." type="text" id="tip" name="tip"
                                    class="w-full h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-4 pb-2">
                        <button
                            class="p-2 text-white uppercase bg-green-500 rounded-lg cursor-pointer font-galanomedium'">Dodaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal-->
    <div
        class="fixed top-0 left-0 z-10 flex items-center justify-center w-full h-full opacity-0 pointer-events-none modal2">
        <div class="absolute w-full h-full bg-gray-900 opacity-50 modal-overlay2"></div>

        <div class="z-50 w-11/12 mx-auto overflow-y-auto rounded shadow-lg modal-container bg-coverImg md:max-w-md">

            <div
                class="absolute top-0 right-0 z-50 flex flex-col items-center mt-4 mr-4 text-sm text-white cursor-pointer modal-close2">
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
                    <p class="text-2xl text-white uppercase font-galanobold">Izmijeni tip!</p>
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
                <form action="./izmijeni_tip.php" method="post">
                    <div>
                        <div class="mt-2">
                            <div class="w-full mt-1 rounded-md">
                                <input placeholder="Izmijenite ime tipa.." type="text" id="tip"
                                    name="tip" value=""
                                    class="w-full h-8 text-gray-500 bg-white border-transparent rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <input type="hidden" id="tip_id_izmjena" name="tip_id" value="">
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-4 pb-2">
                        <button
                            class="p-2 text-white uppercase bg-green-500 rounded-lg cursor-pointer font-galanomedium'">Izmijeni</button>
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