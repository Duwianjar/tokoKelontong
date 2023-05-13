<?php

$a = "aris";

echo $a;
echo "  ----------------- ";
$p = hash('sha256', $a);
echo $p;
echo " --------------- ";
$b = "ridwan";

echo $b;
echo " ---------- ";
$pp = hash('sha256', $b);
echo $pp;

?>