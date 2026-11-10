<?php 
  $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240,18, 72]; 
  array.push($ping_grezzi, 55, 190, 12);

  $ping_validi = [];
  $pacchetti_persi = 0;

  foreach($ping_grezzi : $ping){
    if($ping >= 0){
        $ping_validi[] = $ping;
    }
    elseif($ping == -1){
        $pacchetti_persi++;
    }
  }

  $somma_ping = 0;
  $max_ping = $ping_validi[0];
  $min_ping = $ping_validi[0];
  $ping_critici = [];

  foreach($ping_validi : $ping){
    $somma_ping += $ping;

    if($ping > $max_ping){
        $max_ping = $ping;
    }
    if($ping < $min_ping){
        $min_ping = $ping;
    }

    if($ping > 150){
        $ping_critici[] = $ping;
    }
  }

  $media_ping = round($somma_ping / count($ping_validi), 2);
?>