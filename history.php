<?php
require_once _DIR_ . '/classes/Weepinbell.php'; 
   
   <th>HP (sebelum -> sesudah)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($history as $h): ?>
            <tr>
              <td><?php echo htmlspecialchars($h['time']); ?></td>
              <td><?php echo htmlspecialchars($h['type']); ?></td>
              <td><?php echo htmlspecialchars($h['intensity']); ?></td>
              <td><?php echo $h['before']['level']; ?> -> <?php echo $h['after']['level']; ?></td>
              <td><?php echo $h['before']['hp']; ?> -> <?php echo $h['after']['hp']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <div class="buttons">
      <a class="btn" href="index.php">Kembali ke Beranda</a>
      <a class="btn" href="train.php">Mulai Latihan</a>
    </div>
  </div>
</body>
</html>