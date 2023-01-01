<?php

if (isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type']) && !empty($_GET['type'])) {
  echo '<div class="message">'.htmlspecialchars($_GET['message']).'</div>';
} ?>
