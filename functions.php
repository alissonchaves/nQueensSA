<?php
error_reporting(0);
//calcula ataques
function calcTreats($state){
    global $nQueens;
    for($i=0; $i<$nQueens; $i++) {
        for($j=$i; $j<$nQueens; $j++) {
            //ataques coluna
            if($state[$i] == $state[$j+1] && $i != $j+1 && $state[$j+1] != ""){
                $threat = $threat+1;
            }
        }
        
        //ataques diagonal baixo esq
        $z=1;
        for($j=$i+1; $j<$nQueens; $j++) {
            if($state[$i] == $state[$j]+$z && $i != $j){
                $threat = $threat+1;
            }
            $z++;
        }
        //ataques diagonal baixo dir
        $z=1;
        for($k=$i+1; $k<$nQueens; $k++) {
            if($state[$i] == $state[$k]-$z && $i != $k){
                $threat = $threat+1;
            }
            $z++;
        }
    }
    return $threat;
}
function sa(){
    global $nQueens, $initState, $initStateTreats;
    
    $time_start = microtime(true);
    $temp = 5000;
    $reduc = 0.99;
    $execs = 10000000;
    
    
    for($i=0; $i<$execs; $i++) {
        unset($initStateTreats);
        
        //calcula estado inicial
        $initStateTreats = calcTreats($initState);
        
        //reduz temperatura
        $temp = $temp * $reduc;
        
        //escolhe novo vizinho local
        $randR=rand(0,$nQueens-1);
        $randL=rand(0,$nQueens-1);
        $newState = $initState;
        $newState[$randR] = $randL;
        
        //verifica se novo estado tem menos ataques
        $newStateTreats = calcTreats($newState);
        if($newStateTreats < $initStateTreats){
            $initState = array_replace($initState,$newState);
            unset($initStateTreats);
            //calcula estado inicial
            $initStateTreats = calcTreats($initState);
        }
        //se tem mais ataques
        else{
            //calcula delta
            $delta = $newStateTreats-$initStateTreats;
            
            //exponencial do SA
            $exp = exp((-$delta)/($temp));
            
            //toma decisão
            //se numero aleatório for menor que expressão
            $randomFloat = mt_rand(0, 10) / 10;
            
            if ($randomFloat < $exp){
                $initState = array_replace($initState,$newState);
                unset($initStateTreats);
                //calcula estado inicial
                $initStateTreats = calcTreats($initState);
            }
        }
        //verifica se existe ataques entre as rainhas
        if($initStateTreats == 0){
            $time_end = microtime(true);
            echo "Solução encontrada:\n";
            echo "Tempo de execução: ".$time_end-$time_start." segundos";
            return $initState;
        }
    }
    $time_end = microtime(true);
    echo "Solução Não encontrada:\n";
    echo "Tempo de execução: ".$time_end-$time_start." segundos>";
}
?>