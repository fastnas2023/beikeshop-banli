<?php
$html = file_get_contents('http://bk.test/');
file_put_contents(__DIR__ . '/home_dump.html', $html);
echo "Dumped";
