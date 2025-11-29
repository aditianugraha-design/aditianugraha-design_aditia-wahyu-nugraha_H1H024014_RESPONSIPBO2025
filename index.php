<?php
require_once "classes/weepinbell.php";
require_once "Weepinbell.php";
require_once "../classes/Weepinbell.php";

$dataFile = __DIR__ . '/data/data.json';
$data = json_decode(file_get_contents($dataFile), true);
$poke = new Weepinbell($data['pokemon']['level'], $data['pokemon']['hp']);

?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>PRTC - Dashboard</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h1>PRTC Trainer Dashboard</h1>
    <div class="card">
      <img src="assets/weepinbell.png" alt="Weepinbell" class="poke-img">
      <h2><?php echo htmlspecialchars($poke->getName()); ?></h2>
      <p><strong>Tipe:</strong> <?php echo htmlspecialchars($data['pokemon']['type']); ?></p>
      <p><strong>Level awal:</strong> <?php echo $poke->getLevel(); ?></p>
      <p><strong>HP awal:</strong> <?php echo $poke->getHP(); ?></p>
      <p><strong>Jurus spesial:</strong> <?php echo htmlspecialchars($poke->specialMove()); ?></p>

      <div class="buttons">
        <a class="btn" href="train.php">Mulai Latihan</a>
        <a class="btn" href="history.php">Riwayat Latihan</a>
      </div>
    </div>

    <footer>
      <small>Responsi PBO25 — Isi README.md sebelum submit.</small>
    </footer>
  </div>
</body>
</html>