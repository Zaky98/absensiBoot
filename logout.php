<?php
session_start();
session_destroy();
session_unset();

setcookie('id', '', time()-3600);
setcookie('key', '', time()-3600);

echo "<center>Anda telah sukses keluar sistem <b>[LOGOUT]<b>";
echo "<meta http-equiv='refresh' content='1;url=index.php'>";
?>
