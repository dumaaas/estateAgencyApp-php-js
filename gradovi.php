<?php
    include 'db.php';
       
    $sqlGradovi = "SELECT * FROM sifarnik_gradova";
    $resGradovi = mysqli_query($dbconn, $sqlGradovi);
    while($rowG = mysqli_fetch_assoc($resGradovi)) {
        $gradovi[] = $rowG;
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

<body class="relative bg-coverImg bg-cover">
    <header class="h-16 bg-header w-full">
        <div class="pt-5 w-1/2 mx-auto">
            <div class="ml-24 text-base text-white font-galanobold uppercase">
                <a class="cursor-pointer hover:text-yellow-500" href="index.php">
                    Nekretnine
                </a>
                <a class="cursor-pointer hover:text-yellow-500 ml-24" href="gradovi.php">
                    Gradovi
                </a>
                <a class="cursor-pointer hover:text-yellow-500 ml-24">
                    Tipovi nekretnina
                </a>
                <a class="cursor-pointer hover:text-yellow-500 ml-24">
                    Tipovi oglasa
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
        <div class="mb-4 flex justify-center">
            <button
                class="modal-open cursor-pointer bg-yellow-500 hover:bg-yellow-700 rounded-lg p-2 text-white font-galanomedium uppercase">
                Dodaj grad
            </button>
        </div>
        <div class="grid grid-cols-4">
            <?php 
            foreach($gradovi as $g) {
            ?>
            <div
                class="relative overflow-hidden bg-block mb-5  mr-5 rounded-lg break-words text-sm text-text2 font-notoserif">
                <div class="p-3">
                    <p class="text-lg text-text1">ID: <?php echo $g['id']?></p>
                    <p class="text-lg text-text1">Grad: <?php echo $g['ime_grada']?></p>
                </div>
                <div class="pb-3 flex justify-center">
                    <a class="cursor-pointer" href="izbrisi_grad.php?id=<?php echo $g['id']?>"><i
                            class="text-red-500 hover:text-red-900 text-2xl far fa-trash-alt"></i></a>
                    <a class="modal-open2 cursor-pointer"
                        onclick='izmijeniGrad(<?php echo $g["id"] ?>)'><i
                            class="text-blue-500 hover:text-blue-900 ml-2 text-2xl far fa-edit"></i></a>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <!--Modal-->
    <div
        class="modal z-10 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-coverImg w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl uppercase text-white font-galanobold">Dodaj grad!</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <form action="./dodaj_grad.php" method="post">
                    <div>
                        <div class="mt-2">
                            <div class="mt-1 w-full rounded-md">
                                <input placeholder="Unesite ime grada.." type="text" id="grad" name="grad"
                                    class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-full border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-4 pb-2">
                        <button
                            class="cursor-pointer bg-green-500 rounded-lg p-2 text-white font-galanomedium uppercase'">Dodaj</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal-->
    <div
        class="modal2 z-10 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay2 absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-coverImg w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div
                class="modal-close2 absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl uppercase text-white font-galanobold">Izmijeni grad!</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <form action="./izmjeni_grad.php" method="post">
                    <div>
                        <div class="mt-2">
                            <div class="mt-1 w-full rounded-md">
                                <input placeholder="Izmijenite ime grada.." type="text" id="grad_ime_izmjena"
                                    name="grad_ime" value=""
                                    class="focus:ring-indigo-500 focus:border-indigo-500 h-8 w-full border-transparent bg-white text-gray-500 sm:text-sm rounded-md">
                                <input type="hidden" id="grad_id_izmjena" name="grad_id" value="">
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="flex justify-center pt-4 pb-2">
                        <button
                            class="cursor-pointer bg-green-500 rounded-lg p-2 text-white font-galanomedium uppercase'">Izmijeni</button>
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