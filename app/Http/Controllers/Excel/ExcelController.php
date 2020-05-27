<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InAlunosAtivosGraPos;
use App\Exports\ExportSessionArray;

class ExcelController extends Controller
{
    public function alunosAtivosGraPos(){
        $alunosAtivosGraPos = new InAlunosAtivosGraPos();
        Excel::import($alunosAtivosGraPos, "alunosAtivosFake.xls");
        $dataArray = $alunosAtivosGraPos->getArrayLines();
        return Excel::download(new ExportSessionArray($dataArray), 'alunosAtivosFake.csv', \Maatwebsite\Excel\Excel::CSV);
    }

}