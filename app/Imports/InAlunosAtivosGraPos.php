<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\Reuso;

class InAlunosAtivosGraPos implements ToCollection{

    private $reuso;
    private $header;
    private $arrayLines;

    public function __construct() {

        $this->reuso = new Reuso();
        $this->header = ['firstname','lastname','email','token','curso','numregistro','nivelensino'];
    }

    public function collection(Collection $rows)
    {
        $linhas = array();
        $linhas[0] = $this->header;
        $key = 1;
        foreach ($rows as $row)
        {
           if($row[0] == "Nome Completo") { continue; } // primeira linha é cabeçalho original do arquivo
           $nomeCompleto = $row[0];
           $firstname = $this->reuso->retornaFirstName($nomeCompleto);
           $lastname = $this->reuso->retornaLastName($nomeCompleto);
           $token = $this->reuso->retornaToken();
           if(empty($row[3])) { continue; } // login vazio
           $email = $this->reuso->retornaEmailMinhaUfmg($row[3]);
           $curso = $row[1];
           $numregistro = $row[2];
           $nivelensino = $row[6];
           $linhas[$key] = ["$firstname","$lastname","$email","$token","$curso","$numregistro","$nivelensino"];
           $key++;
        }
        $this->arrayLines = $linhas;
    }

    public function getArrayLines(){
        return $this->arrayLines;
    }

}