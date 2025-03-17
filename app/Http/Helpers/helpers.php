<?php

 // convert 1000 to K
 function thousand_format($number) {
    $number = (int) preg_replace('/[^0-9]/', '', $number);
    if ($number >= 1000) {
        $rn = round($number);
        $format_number = number_format($rn);
        $ar_nbr = explode(',', $format_number);
        $x_parts = array('K', 'M', 'B', 'T', 'Q');
        $x_count_parts = count($ar_nbr) - 1;
        $dn = $ar_nbr[0] . ((int) $ar_nbr[1][0] !== 0 ? '.' . $ar_nbr[1][0] : '');
        $dn .= $x_parts[$x_count_parts - 1];

        return $dn;
    }
    return $number;
}

function get_percentage($total, $number){
    if ( $total > 0 ) {
        return round(($number * 100) / $total, 2);
    } else {
        return 0;
    }
}

// Growth Calculation Function
function growth_calculation($currentMonth, $lastMonth){
    if($lastMonth == 0){
        return number_format(0, 2);  
    }else{
        $growth = ($currentMonth - $lastMonth) / $lastMonth * 100;
        return number_format($growth, 2);
    } 
}

// Lead conversion rate calculation
function conversion_rate($convertedLead, $totalLead){
  if($totalLead == 0){
    return number_format(0, 2);
  }else{
    $lcr = ($convertedLead / $totalLead) * 100;
    return number_format($lcr, 2);
  }  
}

// AuthorizeNet payment Function
function processAuthorizeNetPayment($data){
    return $data;
}


?>