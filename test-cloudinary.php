<?php

require __DIR__ . '/vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance('cloudinary://147275737461547:_6Iq7E6KhrALa_Hu_C6VMWhBdNA@dlkky5xuo');

$result = (new UploadApi())->upload(realpath('C:/Users/duvan/Downloads/aplausos.png'));

echo "Imagen subida exitosamente. URL segura: " . $result['secure_url'] . PHP_EOL;