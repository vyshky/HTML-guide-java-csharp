<?php
// var_dump($_POST);
$index = file_get_contents("index.txt");
if (!$index) {
    $index = 0;
    saveIndexToTxt($index);
}

$page = fopen("pages.txt", 'r');
$i = 0;
while (!feof($page)) //eof - end of file
{
    $pages[$i] = fgets($page);
    $i++;
}
$size = count($pages);


if (isset($_POST['plus'])) {
    pluseOne();
    printWeb();
} elseif (isset($_POST['minus'])) {
    minusOne();
    printWeb();
} elseif (isset($_POST['index'])) {
    global $index, $size;
    $index = $_POST['index'];

    if ($index < 0) {
        $index = 0;
    } else if ($index > $size - 1) {
        $index = $size - 1;
    }
    saveIndexToTxt($index);
    printWeb();
} else {
    printWeb();
}


function printWeb()
{
    global $index, $pages;
    echo '<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../../index.html">Главная</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <span class="navbar-text">
                    Сайт для изучения языков программирования
                </span>
        </div>
    </div>
</nav>';

    echo '<div class="center">
            <iframe width="1280" height="720" 
                  src=' . $pages[$index] . '
                       title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; 
                       encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>';
}

function minusOne()
{
    global $index;
    // $writer = fopen("index.txt", 'w+');

    if ($index - 1 > 0) {
        // fwrite($writer, $index - 1);
        $index = $index - 1;
    } else {
        // fwrite($writer, 0);
        $index = 0;
    }
    saveIndexToTxt($index);
    // $index = file_get_contents("index.txt");
    // fclose($writer);
}

function pluseOne()
{
    global $index, $size;

    if ($index < $size - 1) {
        $index = $index + 1;
    } else {
        $index = 0;
    }
    saveIndexToTxt($index);
}

function saveIndexToTxt($index)
{
    $writer = fopen("index.txt", 'w+');
    fwrite($writer, $index);
    fclose($writer);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="..\..\..\css\style.css" rel="stylesheet">
</head>

<body>
    <div class="center">
        <form action="asp.net.php" method="POST">
            <input type="hidden" value="minus" name="minus">
            <input type="submit" value="back">
        </form>

        <form action="asp.net.php" method="POST">
            <input type="hidden" value="plus" name="plus">
            <input type="submit" value="next">
        </form>
    </div>

    <div class="center">
        <form action="asp.net.php" method="POST">
            <input type="number" name="index">
            <input type="submit" value="Открыть по индексу">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn2373KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>