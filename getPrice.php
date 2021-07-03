<?php


if(isset($_POST['SubmitButton'])){ //check if form was submitted


    $input = $_POST['theConsole']; //get input text

    if($input == NULL){
        $input = "PS2";
    }

    $input = str_replace(" ", "+", $input);
    
    $inputNumber = $_POST['numberSelect']; //get input number

    $adresse = "https://www.ebay.fr/sch/Consoles/139971/i.html?_fosrp=1&_from=R40&_nkw=%22". $input ."%22&_in_kw=1&_ex_kw=&_sacat=139971&LH_Sold=1&_udlo=&_udhi=&_samilow=&_samihi=&_sadis=15&_stpos=57500&_sargn=-1%26saslc%3D1&_salic=71&_sop=13&_dmd=1&_ipg=". $inputNumber ."&LH_Complete=1";
    $page = file_get_contents ($adresse);

}else{
    if(!isset($input2)){
        $input = 'PS2';
        $inputNumber = '50';
        $adresse = "https://www.ebay.fr/sch/Consoles/139971/i.html?_fosrp=1&_from=R40&_nkw=%22". $input ."%22&_in_kw=1&_ex_kw=&_sacat=139971&LH_Sold=1&_udlo=&_udhi=&_samilow=&_samihi=&_sadis=15&_stpos=57500&_sargn=-1%26saslc%3D1&_salic=71&_sop=13&_dmd=1&_ipg=". $inputNumber ."&LH_Complete=1";
        $page = file_get_contents ($adresse);
    }else{
        $input = $input2;
        $inputNumber = $inputNumber2;
        $adresse = "https://www.ebay.fr/sch/Consoles/139971/i.html?_fosrp=1&_from=R40&_nkw=%22". $input ."%22&_in_kw=1&_ex_kw=&_sacat=139971&LH_Sold=1&_udlo=&_udhi=&_samilow=&_samihi=&_sadis=15&_stpos=57500&_sargn=-1%26saslc%3D1&_salic=71&_sop=13&_dmd=1&_ipg=". $inputNumber ."&LH_Complete=1";
        $page = file_get_contents ($adresse);
    }

}
    

$pattern = '#sold">([\s\S]+?)<b#';

$patternTitle = '#lvtitle">(.*?)</#';

$patternFDP = '#hip">([\s\S]+?)</sp#';

$patternLinkImg =  '#https://i.ebayimg.com([-A-Z-a-z0-9_\/:.~]+\.(jpg|jpeg|png))#';


preg_match_all ($pattern, $page, $prix);    //prix avec esapce

preg_match_all ($patternTitle, $page, $titre);   //titre produit

preg_match_all ($patternFDP, $page, $FDP);   //FDP produit

preg_match_all ($patternLinkImg, $page, $linkImg);   //IMG LINK produit



echo '<form action="index.php" method="post">

        <table>
            <tbody>
                <tr>
                    <td class="titleTD">CHECK</td>
                    <td class="titleTD">IMAGE</td>
                    <td class="titleTD">TOTAL</td>
                    <td class="titleTD">NOM</td>
                    <td class="titleTD">PRIX</td>
                    <td class="titleTD">LIVRAISON</td>
                </tr>
                <tr>';


for($i = 0; $i < count($prix[1]); $i++) // On parcourt le tableau $prix[1]
{

    $thePrice = $prix[1][$i];
    $theTitre = $titre[1][$i];
    $theImgLink = $linkImg[0][$i];

    if(preg_match_all('!\d+!', $FDP[1][$i], $numFDP)){
        $thePricFDP = $numFDP[0][0] . ',' . $numFDP[0][1];
        
    }else{
        $thePricFDP = 0;
    }

    $thePricePoint = str_replace(',' , '.' , $thePrice);
    $thePriceFDPPoint = str_replace(',' , '.' , $thePricFDP);

    if(floatval($thePricePoint) == 0){
        $thePricePoint = substr($thePricePoint, 28, 50);
    }

    $theTotal = floatval($thePricePoint) + floatval($thePriceFDPPoint);
    $theTotal = str_replace('.' , ',' , $theTotal);




    echo '<td><input class="check" type="checkbox" name="checkPrice[]" value="'.$theTotal.'" checked></td>';

    echo '<td class="info"><img src ="' . $theImgLink . '" /></td>';

    echo '<td>' . $theTotal . '€</td>';

    echo '<td>' . $theTitre . '</a></td>'; //adresse

    echo '<td>' . $thePrice . '</td>'; // On affiche le prix

    echo '<td>' . $thePricFDP . '</td>'; // On affiche les FDP


    echo '</tr>';



}

    
echo '      </tbody>
        </table>

        <br />
            

        <input type="hidden" value="'.$input.'" name="inputParamUserConsole" />
        <input type="hidden" value="'.$inputNumber.'" name="inputParamUserNumber" />

        <input type="submit" class="button" value="CALCULER LE PRIX MOYEN" name="SubmitButtonForCalc">
    </form>';




?>

