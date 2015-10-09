<?php

namespace Nathanmac\QRCode;

use Endroid\QrCode\QrCode;
use Illuminate\Routing\Controller;

class QRController extends Controller
{
    /**
     * @var QrCode
     */
    protected $qr;

    /**
     * QRController constructor.
     *
     * @param QRCode $qr
     */
    public function __construct(QrCode $qr)
    {
        $this->qr = $qr;
    }

    /**
     * Generates a QR Code
     *
     * @throws \Endroid\QrCode\Exceptions\ImageFunctionUnknownException
     */
    public function generate()
    {
        return $this->qr
            ->setText("Life is too short to be generating QR codes")
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabel('My label')
            ->setLabelFontSize(16)
            ->render()
        ;
    }
}
