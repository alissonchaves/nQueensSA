<?php
    error_reporting(0);
    require_once("functions.php");
    
    $nQueens = $argv[1];

    $threat = 0;
    
    //abre exibição tabuleiro
    
    echo "Estado inicial:\n";
        for($i=0; $i<$nQueens; $i++){
            //sorteia rainhas
            $initState[] = rand(0,$nQueens-1);
            
            //constroi tabuleiro
            echo "\n|";
            for($j=0; $j<$nQueens; $j++){
                if($j == $initState[$i]){
                    echo $j.'|';
                }
                else{
                    echo '#|';
                }
            }
        }
        echo "\n\n";
    
    //simulated annealing
    $solution = sa();
    
    echo "\n\n";
// se quantidade de ataques for grande, não exibir o tabuleiro na tela
    if($nQueens < 25){

        //abre exibição tabuleiro sem ataques
        for($i=0; $i<$nQueens; $i++){
        
        //constroi tabuleiro
        echo "\n|";
        for($j=0; $j<$nQueens; $j++){
            if($j == $solution[$i]){
                echo $j.'|';
            }
            else{
                echo '#|';
            }
        }
    }
}
    
    echo "\n\n";
    ?>
