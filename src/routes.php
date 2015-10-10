<?php

$router->get('/qrcode/{size?}/{color?}/{background?}', 'QRController@generate');
