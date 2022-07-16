<?php

$json = json_decode(file_get_contents('https://github.com/dmfilipenko/timezones.json/blob/master/timezones.json'));

echo "<pre>";
print_r($json);
