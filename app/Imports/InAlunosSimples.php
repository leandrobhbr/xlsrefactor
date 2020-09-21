<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\Reuso;

class InAlunosSimples implements ToCollection{

    private $reuso;
    private $header;
    private $arrayLines;

    public function __construct() {

        $this->reuso = new Reuso();
        $this->header = ['email','registro','curso'];
    }

    public function collection(Collection $rows)
    {
        $linhas = array();
        $linhas[0] = $this->header;
        $key = 1;
        foreach ($rows as $key => $row)
        {
           $registro = $row[3];
           $curso = $row[2];
           $login=$row[1];
           if($key == 0) { continue; } // primeira linha é cabeçalho original do arquivo
           if(empty($login)) { continue; } // login vazio
           $email = $this->reuso->retornaEmailMinhaUfmg($login);
           $linhas[$key] = ["$email","$registro","$curso"];
           $key++;
        }
        $this->arrayLines = $linhas;
    }

    public function getArrayLines(){
        return $this->arrayLines;
    }

}