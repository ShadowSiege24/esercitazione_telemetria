<?php 
  $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240,18, 72]; 
  array_push($ping_grezzi, 55, 190, 12);

  $ping_validi = [];
  $pacchetti_persi = 0;

  foreach($ping_grezzi as $ping){
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

  foreach($ping_validi as $ping){
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

  $ping_unici = array_unique($ping_validi);
  $ping_ordinati = $ping_validi;
  sort($ping_ordinati);

  $top_3_veloci = array_slice($ping_ordinati, 0, 3);
  $controllo_100ms = in_array(100, $ping_validi) ? "Si" : "No";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercitazione Telemetria</title>
</head>
<body>
    <div>
        <h2>Riepilogo Generale:</h2>
        <ul>
            <li><strong>Totale rilevazioni iniziali: </strong> <?php echo(count($ping_grezzi)) ?></li>
            <li><strong>Pacchetti Validi: </strong> <?php echo(count($ping_validi)) ?></li>
            <li><strong>Pacchetti Persi: </strong><?php echo($pacchetti_persi) ?></li>
            <li><strong>Tempo Medio di Risposta: </strong> <?php echo($media_ping) ?> </li>
            <li><strong>Ping Minimo: </strong><?php echo($min_ping) ?></li>
            <li><strong>Ping Maximo: </strong><?php echo($max_ping) ?></li>
            <li><strong>Presenza latenza 100 ms: </strong><?php echo($controllo_100ms) ?></li>
        </ul>
    </div>

    <div>
        <h2>Elenco Rilevazioni Valide:</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ping</th>
                    <th>Stato</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ping_validi as $indice => $ping): ?>
                    <tr>
                        <td><?php echo($indice + 1) ?></td>
                        <td><?php echo($ping) ?> ms</td>
                        <td>
                            <?php if($ping > 150): ?>
                                CRITICO
                            <?php else: ?>
                                NORMALE
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>