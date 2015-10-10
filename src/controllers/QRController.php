<?php

namespace Nathanmac\QRCode\Controllers;

use Illuminate\Routing\Controller;
use Nathanmac\QRCode\Generator;

class QRController extends Controller
{
    /**
     * Generates a QR Code
     *
     * @param int         $size
     * @param string      $color
     * @param string|bool $background
     *
     * @return \Endroid\QrCode\QrCode
     */
    public function generate($size = 100, $color = '000000', $background = false)
    {
        return Generator::generate('', $size, $color, $background);
    }
}
