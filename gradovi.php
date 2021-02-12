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
        <form action="./index.php" method="POST">
           
        </form>
       
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
