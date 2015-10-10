<?php

namespace Nathanmac\QRCode\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nathanmac\QRCode\Generator;

class QRController extends Controller
{
    /**
     * Generates a QR Code
     *
     * @param Request     $request
     * @param int         $size
     * @param string      $color
     * @param string|bool $background
     *
     * @return \Endroid\QrCode\QrCode
     */
    public function generate(Request $request, $size = 100, $color = '000000', $background = false)
    {
        return Generator::generate($request->get('text'), $size, $color, $background);
    }
}
