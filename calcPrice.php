<?php
$theTotal = 0;
if(isset($_POST['SubmitButtonForCalc'])){ //check if form was submitted


    $inputConsole = $_POST['inputParamUserConsole'];

    $inputNumber = $_POST['inputParamUserNumber'];

    
    $input2 = $inputConsole;
    $inputNumber2 = $inputNumber;


    $input = $_POST['checkPrice']; //get input text

    if(empty($input)){
        echo "Rien trouvé";
    }else{
        $N = count($input);
            
        for($i=0; $i < $N; $i++){
            
            $currentPrice = $input[$i];
            $newCurrentPrice = str_replace(',' , '.' , $currentPrice);
            $newCurrentPrice = floatval($newCurrentPrice);
            
            $theTotal = $theTotal + $newCurrentPrice;


        }            
        
        $theMoyenne = $theTotal / $N;

        $theMoyenne = round($theMoyenne,2);

        $theMoyenneString = str_replace('.' , ',' , $theMoyenne);


        echo '<p class="result">Voici le prix moyen des '.$N.' produit(s) : <span class="valueResult">'.$theMoyenneString.'€</span></p>';

    }

} 




?>