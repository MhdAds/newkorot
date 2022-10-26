<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class DoctorsReportExport implements FromArray
{

    private $report = [];

    public function __construct($report)
    {
        $this->report = $report; 
    }

    public function array(): array
    {
        return $this->report;
    }
}