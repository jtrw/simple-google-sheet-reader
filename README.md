# Simple Google Sheet Reader

```php

$doc = new \Jtrw\SimpleGoogleSheet\Document($credentials);
$value = $doc->setSheet('sheet_name')->getValues('Name!A1:C');

print_r($value);
```
```
array(
    array(
        [0] => "Name",
        [1] => "Email"
    ),
    array(
        [0] => "Joe",
        [1] => "joe@mail.com"
    ),
)
```