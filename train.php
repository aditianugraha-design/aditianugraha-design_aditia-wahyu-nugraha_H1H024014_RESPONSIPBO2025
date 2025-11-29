<?php
require_once _DIR_ . '/classes/Weepinbell.php';

$dataFile = __DIR__ . '/data/data.json';
$data = json_decode(file_get_contents($dataFile), true);
$poke = new Weepinbell($data['pokemon']['level'], $data['pokemon']['hp']);

$message = null;
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kind = $_POST['kind'] ?? 'generic';
    $intensity = (int) ($_POST['intensity'] ?? 10);

    $result = $poke->train($kind, $intensity);

    $entry = [
        'type' => $kind,
        'intensity' => $intensity,
        'before' => $result['before'],
        'after' => $result['after'],
        'gain' => $result['gain'],
        'special' => $result['specialMove'],
        'time' => date('Y-m-d H:i:s')
    ];

    $data['pokemon']['level'] = $result['after']['level'];
    $data['pokemon']['hp'] = $result['after']['hp'];
    array_unshift($data['history'], $entry);

    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

    $message = 'Latihan berhasil diselesaikan!';
}

?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Latihan - PRTC</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h1>Latihan untuk <?php echo htmlspecialchars($poke->getName()); ?></h1>

    <?php if ($message): ?>
      <div class="alert"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <label>Jenis latihan</label>
      <select name="kind">
        <option value="Attack">Attack</option>
        <option value="Defense">Defense</option>
        <option value="Speed">Speed</option>
        <option value="Generic">Generic</option>
      </select>

      <label>Intensitas latihan (angka, misal 10 - 100)</label>
      <input type="number" name="intensity" value="20" min="1" max="500">

      <button type="submit" class="btn">Mulai Latihan</button>
    </form>

    <?php if ($result): ?>
      <div class="card">
        <h3>Hasil Latihan</h3>
        <p><strong>Level sebelum:</strong> <?php echo $result['before']['level']; ?> -> <strong>sesudah:</strong> <?php echo $result['after']['level']; ?></p>
        <p><strong>HP sebelum:</strong> <?php echo $result['before']['hp']; ?> -> <strong>sesudah:</strong> <?php echo $result['after']['hp']; ?></p>
        <p><strong>Gain:</strong> +<?php echo $result['gain']['level']; ?> level, +<?php echo $result['gain']['hp']; ?> HP</p>
        <p><strong>Jurus spesial:</strong> <?php echo htmlspecialchars($result['specialMove']); ?></p>
      </div>
    <?php endif; ?>

    <div class="buttons">
      <a class="btn" href="index.php">Kembali ke Beranda</a>
      <a class="btn" href="history.php">Riwayat Latihan</a>
    </div>
  </div>
</body>
</html>