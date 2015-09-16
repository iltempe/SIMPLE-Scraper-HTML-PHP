<?php


/**
 * SIMPLE-Scraper-HTML-PHP
 *
 * PHP version 5.3
 *
 *  @category HTML_Tools
 *  @package  HTML
 *  @author   https://github.com/botero
 *  @license  https://github.com/botero/SIMPLE-Scraper-HTML-PHP/blob/master/licence.txt GPL V3 License
 *  @link     https://github.com/botero/SIMPLE-Scraper-HTML-PHP
 *
 */

/**
 * this class is a simple and fast, with no dependency, scraping tool for XML
 * and HTML files, require PHP 5.3 or later and it's PSR1 standard compliant
 *
 *  @category HTML_Tools
 *  @package  HTML
 *  @author   https://github.com/botero
 *  @license  https://github.com/botero/SIMPLE-Scraper-HTML-PHP/blob/master/licence.txt GPL V3 License
 *  @link     https://github.com/botero/SIMPLE-Scraper-HTML-PHP
 *
 */

require_once __DIR__.'/../src/ScraperInterface.php';
require_once __DIR__.'/../src/Scraper.php';

class ScraperTest extends PHPUnit_Framework_TestCase {

    protected $object;

    protected function setUp() {

        $this->object = new Scraper();
    }

    public function testScraperCASE_1() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_1.html');

        $result = $this->object->execute('#YourID', $html);
        $spectation = array('Text');

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_1_2() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_1.html');

        $result = $this->object->execute('#YourID div', $html);

        $this->assertNull($result);

    }

    public function testScraperCASE_2() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_2.html');

        $result = $this->object->execute('#YourID div',$html);
        $spectation = array('Text');
        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_2_1() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_2.html');

        $result = $this->object->execute('#YourID',$html);

        $spectation = array('Text');
        $this->assertEquals(serialize($spectation),  serialize($result));

    }

    public function testScraperCASE_3() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_3.html');

        $result = $this->object->execute('#YourID div div', $html);

        $spectation = array('Text');
        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_3_1() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_3.html');

        $result = $this->object->execute('#YourID div ul div', $html);

        $this->assertNull($result);
    }

    public function testScraperCASE_4() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_4.html');

        $result = $this->object->execute('#YourID table tr td',$html);

        $spectation = array( array('Jill','Smith','50'), array('Eve','Jackson','94') );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_5() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_5.html');

        $result = $this->object->execute('#YourID table tr td',$html);

        $spectation = array( array('Jill','Smith','50'), array('Eve','Jackson') );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_5_1() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_5.html');

        $result = $this->object->execute('#YourID table td tr',$html);

        $this->assertNull($result);
    }

    public function testScraperInvalidDocument() {

        $html = 'MEDELLIN' ;
        $result = $this->object->execute('#YourID table tr td',$html);

        $this->assertNull($result);
    }

    public function testScraperInvalidTags() {

        $html = '<div id="YourID"></div>';
        $result = $this->object->execute('#YourID table', $html);

        $this->assertNull($result);
    }

    public function testScraperCASE_6(){

        $html = file_get_contents(__DIR__.'/fixtures/CASE_6.html');

        $result = $this->object->execute('#YourID div div', $html);

        $spectation = array( 'MEDELLIN' );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_ELTIEMPO(){

        $html = file_get_contents(__DIR__.'/fixtures/ELTIEMPO.COM.html');

        $result = $this->object->execute('#0 ul li div div p', $html);

        $spectation = array('No Aplica');

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_7(){

        $html = file_get_contents(__DIR__.'/fixtures/CASE_7.html');

        $result = $this->object->execute('#YourID div img:src',$html);

        $spectation =  array( array('image_1.jpg') , array('image_2.jpg', 'image_3.jpg')  );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_8() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_8.html');

        $result = $this->object->execute('#YourID table tr td', $html);

        $spectation = array( array('Jill Smith','Smith','50'), array('Eve','Jackson') );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_7_1() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_7.html');

        $result = $this->object->execute('#YourID div img:src', $html);

        $spectation =  array( array('image_1.jpg') , array('image_2.jpg', 'image_3.jpg')  );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_9() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_9.html');

        $result = $this->object->execute('#YourID div div img:src*', $html);

        $spectation =  array( null, array( array('image.jpg')), array( null )  );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }

    public function testScraperCASE_10() {

        $html = file_get_contents(__DIR__.'/fixtures/CASE_10.html');

        $result = $this->object->execute('#YourID div div img:alt*', $html);

        $spectation =  array( null, array( array('image')), array( null )  );

        $this->assertEquals(serialize($spectation),  serialize($result));
    }
}