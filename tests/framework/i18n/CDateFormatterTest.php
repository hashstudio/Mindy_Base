<?php
use Mindy\Base\Mindy;

/**
 * CDateFormatterTest
 */
class CDateFormatterTest extends CTestCase
{
    public function testWeekInMonth()
    {
        for ($year = 1970; $year <= date('Y'); $year++) {
            for ($month = 1; $month <= 12; $month++) {
                $day = date('t', mktime(0, 0, 0, $month, 1, $year));
                $weekNum = Mindy::app()->dateFormatter->format("W", mktime(0, 0, 0, $month, $day, $year));
                //echo sprintf("%d/%d/%d\t%d\n",$year,$month,$day,$weekNum);
            }
        }

        //echo "Week number for 2011/01/01 is ".Mindy::app()->dateFormatter->format("W",mktime(0,0,0,1,1,2011));
        //echo "Week number for 2011/01/07 is ".Mindy::app()->dateFormatter->format("W",mktime(0,0,0,1,7,2011));
    }

    public function testStringIntegerDate()
    {
        date_default_timezone_set('UTC');
        $this->assertEquals('2012 09 03 07:54:09', Mindy::app()->dateFormatter->format("yyyy MM dd hh:mm:ss", 1346702049));
        $this->assertEquals('2012 09 03 07:54:09', Mindy::app()->dateFormatter->format("yyyy MM dd hh:mm:ss", '1346702049'));
        $this->assertEquals('1927 04 30 04:05:51', Mindy::app()->dateFormatter->format("yyyy MM dd hh:mm:ss", -1346702049));
        $this->assertEquals('1927 04 30 04:05:51', Mindy::app()->dateFormatter->format("yyyy MM dd hh:mm:ss", '-1346702049'));
    }

    public function testStrToTimeDate()
    {
        date_default_timezone_set('UTC');
        $this->assertEquals('2012 09 03 09:54:09', Mindy::app()->dateFormatter->format("yyyy MM dd hh:mm:ss", '2012-09-03 09:54:09 UTC'));
        $this->assertEquals('1927 04 30 05:05:51', Mindy::app()->dateFormatter->format("yyyy MM dd hh:mm:ss", '1927-04-30 05:05:51 UTC'));
    }

    public function providerFormatWeekInMonth()
    {
        return array(
            array('2012.06.01', 1),
            array('2012.06.02', 1),
            array('2012.06.03', 1),
            array('2012.06.09', 2),
            array('2012.06.10', 2),
            array('2012.06.16', 3),
            array('2012.06.17', 3),
            array('2012.06.23', 4),
            array('2012.06.24', 4),
            array('2012.06.30', 5),

            array('2011.10.01', 1),
            array('2011.10.03', 2),
            array('2011.10.08', 2),
            array('2011.10.10', 3),
            array('2011.10.15', 3),
            array('2011.10.17', 4),
            array('2011.10.22', 4),
            array('2011.10.24', 5),
            array('2011.10.29', 5),
            array('2011.10.31', 6),

            array('2012.12.23', 4),
            array('2012.12.30', 5),
            array('2012.12.31', 6),
            array('2013.01.01', 1),
            array('2013.01.02', 1),
            array('2013.01.07', 2),

            array('2010.12.17', 3),
            array('2010.12.24', 4),
            array('2010.12.31', 5),
            array('2011.01.01', 1),
            array('2011.01.08', 2),
            array('2011.01.15', 3),
        );
    }

    /**
     * @dataProvider providerFormatWeekInMonth
     */
    public function testFormatWeekInMonth($date, $expected)
    {
        list($year, $month, $day) = explode('.', $date);
        $this->assertEquals($expected, Mindy::app()->dateFormatter->format('W', mktime(12, 0, 0, (int)$month, (int)$day, (int)$year)));
    }
}
