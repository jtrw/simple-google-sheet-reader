<?php

require __DIR__ . '/../vendor/autoload.php';

$credentials = json_decode(file_get_contents(__DIR__ . '/credentials_u.json'), true);
$doc = new \Jtrw\SimpleGoogleSheet\Document($credentials);
$valueGenerator = $doc->setSheet('1vQ7IGkiBnmgZLNLX75TZEPeGFgGtNITnBBZX41n5a8E')->getGeneratorValue('Form Responses 1!A1:C');

foreach ($valueGenerator as $item) {
    print_r($item);
}
