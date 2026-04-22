<?php
$html = file_get_contents('http://bk.test/?design=1');
file_put_contents(__DIR__ . '/home_dump2.html', $html);
echo "Dumped2";
