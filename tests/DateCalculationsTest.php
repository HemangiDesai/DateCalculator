<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/api.php';

class DateCalculationsTest extends TestCase

{
    public function testCalculateDateDifferenceDays()
    {
        $this->assertEquals(9, calculateDateDifference('2024-01-01', '2024-01-10', 'days', 'GMT'));
    }

    public function testCalculateDateDifferenceWeekdays()
    {
        $this->assertEquals(7, calculateDateDifference('2024-01-01', '2024-01-10', 'weekdays', 'GMT'));
    }

    public function testCalculateDateDifferenceWeeks()
    {
        $this->assertEquals(1, calculateDateDifference('2024-01-01', '2024-01-10', 'weeks', 'GMT'));
    }

    public function testConvertUnitDaysToSeconds()
    {
        $this->assertEquals(864000, convertUnit(10, 'seconds', 'days'));
    }

    public function testConvertUnitDaysToMinutes()
    {
        $this->assertEquals(14400, convertUnit(10, 'minutes', 'days'));
    }

    public function testConvertUnitDaysToHours()
    {
        $this->assertEquals(240, convertUnit(10, 'hours', 'days'));
    }

    public function testConvertUnitDaysToYears()
    {
        $this->assertEquals(10 / 365.25, convertUnit(10, 'years', 'days'), '', 0.000001);
    }

   

    public function testConvertUnitWeeksToSeconds()
    {
        $this->assertEquals(604800, convertUnit(1, 'seconds', 'weeks'));
    }

    public function testCalculateWeekdaysFunction()
    {
        $startDate = new DateTime('2024-01-01');
        $endDate = new DateTime('2024-01-10');
        $this->assertEquals(7, calculateWeekdays($startDate, $endDate));
    }
}
