<?php
    function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0) {
        $dias = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias');
        $total_boletos = array_combine($dias, $boletos);
        $json = array();

        foreach($total_boletos as $key => $boletos): 
            if((int) $boletos > 0) :
                $json[$key] = (int) $boletos;
            endif;
        endforeach;

        return json_encode($json);
    }