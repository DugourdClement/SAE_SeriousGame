<?php

use PHPUnit\Framework\TestCase;

require_once 'service/YearChecking.php';
require_once 'service/OutputData.php';
require_once 'data/YearSqlAccess.php';

class YearCheckingTest extends TestCase
{
    public function testGetYearsData()
    {
        $outputData = $this->createMock(OutputData::class);
        $outputData->expects($this->once())
            ->method('setOutputData')
            ->with($this->equalTo(array_fill(0, 7, 'Test year data')));

        $yearChecking = new YearChecking($outputData);

        $data = $this->createMock(YearSqlAccess::class);
        $data->method('getYearData')->willReturn('Test year data');

        $yearChecking->getYearsData($data);
    }

    public function testModifyChoice()
    {
        $outputData = $this->createMock(OutputData::class);
        $yearChecking = new YearChecking($outputData);

        $data = $this->createMock(YearSqlAccess::class);
        $data->expects($this->once())
            ->method('modifyChoice')
            ->with($this->equalTo(1), $this->equalTo('Test choice text'));

        $yearChecking->modifyChoice($data, 1, 'Test choice text');
    }

    public function testModifyOpt()
    {
        $outputData = $this->createMock(OutputData::class);
        $yearChecking = new YearChecking($outputData);

        $data = $this->createMock(YearSqlAccess::class);
        $data->expects($this->once())
            ->method('modifyOpt')
            ->with($this->equalTo(1), $this->equalTo(2), $this->equalTo('Test opt text'));

        $yearChecking->modifyOpt($data, 1, 2, 'Test opt text');
    }

    public function testModifyTextSup()
    {
        $outputData = $this->createMock(OutputData::class);
        $yearChecking = new YearChecking($outputData);

        $data = $this->createMock(YearSqlAccess::class);
        $data->expects($this->once())
            ->method('modifyTextSup')
            ->with($this->equalTo(3), $this->equalTo('Test text sup'));

        $yearChecking->modifyTextSup($data, 3, 'Test text sup');
    }
}
