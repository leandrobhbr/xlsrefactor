<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\Reuso;

class InAlunos implements ToCollection{

    private $reuso;
    private $header;
    private $arrayLines;

    public function __construct() {

        $this->reuso = new Reuso();
        $this->header = ['firstname','lastname','email','token'];
    }

    public function collection(Collection $rows)
    {
        $linhas = array();
        $linhas[0] = $this->header;
        $key = 1;
        foreach ($rows as $key => $row)
        {
           $nomeCompleto = $row[0];
           $login=$row[1];
           if($key == 0) { continue; } // primeira linha é cabeçalho original do arquivo
           #dd($row);
           if(empty($login)) { continue; } // login vazio
           $firstname = $this->reuso->retornaFirstName($nomeCompleto);
           $lastname = $this->reuso->retornaLastName($nomeCompleto);
           $token = $this->reuso->retornaToken();
           $email = $this->reuso->retornaEmailMinhaUfmg($login);
           $linhas[$key] = ["$firstname","$lastname","$email","$token"];
           #dd($linhas);
           $key++;
        }
        $this->arrayLines = $linhas;
    }

    public function getArrayLines(){
        return $this->arrayLines;
    }

}