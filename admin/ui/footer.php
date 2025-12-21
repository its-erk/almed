<?php
$version = 'v1.0.0';
$commit  = '';

if (is_dir(__DIR__ . '/../.git')) {
    $commit = trim(shell_exec('git rev-parse --short HEAD'));
}
?>


<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted d-block text-center text-sm-start">
      Made in Kenya for
      <a href="#" class="text-decoration-none fw-semibold">Afyako</a>
      by
      <a href="https://its-erk.github.io/windedgesoft"
         target="_blank"
         rel="noopener"
         class="fw-semibold text-decoration-none">
        Windedgesoft
      </a>
      <small class="ms-2 opacity-75">
        <?= $version ?><?= $commit ? ' · ' . $commit : '' ?>
      </small>
    </span>

    <span class="text-muted d-block text-center text-sm-end mt-1 mt-sm-0">
      © 2025 Afyako. All rights reserved
    </span>
  </div>
</footer>