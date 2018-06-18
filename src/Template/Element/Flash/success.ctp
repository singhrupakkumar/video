<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-success flash-msg" onclick="this.classList.add('hidden')" style="display: block; width:100%; top:-30px;    z-index: 1;"><?= $message ?></div>   
