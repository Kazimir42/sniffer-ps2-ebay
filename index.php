<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        <script src="app.js" async defer></script>

    </head>
    <body>
        <h1>
        Snifer Ebay PHP
        </h1>
        <div class="container">
        <form action="index.php" method="post">
            <p class="urlToCompare">Console à comparer : <input type="text" id="inputConsol" class="champCompare" placeholder="ps2" name="theConsole" />

            <input type="radio" id="number25" name="numberSelect" value="25">25

            <input type="radio" id="number50" name="numberSelect" checked value="50">50

            <input type="radio" id="number100" name="numberSelect" value="100">100

            <input type="radio" id="number200" name="numberSelect" value="200">200

            <input id="SubmitButton" type="submit" class="button2" value="OK" name="SubmitButton" ></p>
        </form>
        
        <?php include 'calcPrice.php' ?>

        <?php include 'getPrice.php' ?>





        </div>
    </body>
</html>