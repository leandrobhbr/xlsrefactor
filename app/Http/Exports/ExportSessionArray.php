<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;

class ExportSessionArray implements FromArray
{
    private $dataArray;

    public function __construct($dataArray) {
        $this->dataArray = $dataArray;
    }
    public function array(): array
    {
        return $this->dataArray;
    }
}