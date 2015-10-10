<?php

use Mockery as m;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        m::close();
    }

    /** @test */
    public function it_should_use_the_defaults()
    {
        $generator = new \Nathanmac\QRCode\Generator('QR Code Content');

        $this->assertEquals(100, $generator->getSize());
        $this->assertEquals(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0), $generator->getColor());
        $this->assertEquals(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 255), $generator->getBackgroundColor());
    }

    /** @test */
    public function it_should_get_the_content()
    {
        $generator = new \Nathanmac\QRCode\Generator('QR+Code+Content');

        $this->assertEquals('QR Code Content', $generator->getContent());
    }

    /**
     * DataProvider for size test
     *
     * @return array
     */
    public function sizeProvider()
    {
        return array(
            array(-1, 100),
            array('string value', 100),
            array(200, 200)
        );
    }

    /**
     * @dataProvider sizeProvider
     *
     * @param string $size
     * @param array  $expected
     *
     * @test
     */
    public function it_should_process_the_size($size, $expected)
    {
        $generator = new \Nathanmac\QRCode\Generator('QR Code Content');

        $generator->setSize($size);
        $this->assertEquals($expected, $generator->getSize());
    }

    /**
     * DataProvider for color test
     *
     * @return array
     */
    public function colorProvider()
    {
        return array(
            array('4CAAFF', array('r' => 76, 'g' => 170, 'b' => 255, 'a' => 0)),
            array('999', array('r' => 153, 'g' => 153, 'b' => 153, 'a' => 0)),
            array('999999', array('r' => 153, 'g' => 153, 'b' => 153, 'a' => 0)),
            array(false, array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 255)),
            array('invalid', array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        );
    }

    /**
     * @dataProvider colorProvider
     *
     * @param string $color
     * @param array  $expected
     *
     * @test
     */
    public function it_should_process_the_color($color, $expected)
    {
        $generator = new \Nathanmac\QRCode\Generator('QR Code Content');

        $generator->setColor($color);
        $this->assertEquals($expected, $generator->getColor());

        $generator->setBackgroundColor($color);
        $this->assertEquals($expected, $generator->getBackgroundColor());
    }



    /** @test */
    public function it_should_create_a_qr_code()
    {
        $qrcode = m::mock('\Endroid\QrCode\QrCode')
            ->makePartial();

        $qrcode->shouldReceive('setText')->once()->andReturn($qrcode);
        $qrcode->shouldReceive('setSize')->once()->andReturn($qrcode);
        $qrcode->shouldReceive('setPadding')->once()->andReturn($qrcode);
        $qrcode->shouldReceive('setErrorCorrection')->once()->andReturn($qrcode);
        $qrcode->shouldReceive('setForegroundColor')->once()->andReturn($qrcode);
        $qrcode->shouldReceive('setBackgroundColor')->once()->andReturn($qrcode);
        $qrcode->shouldReceive('render')->once();

        $generator = m::mock('\Nathanmac\QRCode\Generator')
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $generator->shouldReceive('getGenerator')
            ->once()
            ->andReturn($qrcode);

        $generator->create();
    }
}
