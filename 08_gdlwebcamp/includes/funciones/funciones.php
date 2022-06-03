<?php
    function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0) {
        $dias = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias');

        unset($boletos['un_dia']['precio']);
        unset($boletos['completo']['precio']);
        unset($boletos['2dias']['precio']);
        
        $total_boletos = array_combine($dias, $boletos);
        
        $camisas = (int) $camisas;
        if($camisas > 0) :
            $total_boletos['camisas'] = $camisas;        
        endif;
        
        $etiquetas = (int) $etiquetas;
        if($etiquetas > 0) :
            $total_boletos['etiquetas'] = $etiquetas;        
        endif;

        return json_encode($total_boletos);
    }

    function eventos_json(&$eventos) {
        $eventos_json = array();
        foreach($eventos as $evento) :
            $eventos_json['eventos'][] = $evento;
        endforeach;
        return json_encode($eventos_json);
    }