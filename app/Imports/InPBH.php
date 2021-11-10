<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\Reuso;

class InPBH implements ToCollection{

    private $reuso;
    private $header;
    private $arrayLines;

    public function __construct() {

        $this->reuso = new Reuso();
        $this->header = ['username','password','firstname','lastname','email','Course1'];
    }

    public function collection(Collection $rows)
    {
        $linhas = array();
        $linhas[0] = $this->header;
        $key = 1;
        foreach ($rows as $key => $row)
        {
           $nomeCompleto = $row[0];
           $email=$row[1];
           if($key == 0) { continue; } // primeira linha é cabeçalho original do arquivo
           $firstname = $this->reuso->retornaFirstName($nomeCompleto);
           $lastname = $this->reuso->retornaLastName($nomeCompleto);
           $username = $this->reuso->retornaLogin($email);
           $password = "";
           $linhas[$key] = ["$username","$password","$firstname","$lastname","$email","VPTE_1"];
           $key++;
        }
        $this->arrayLines = $linhas;
    }

    public function getArrayLines(){
        return $this->arrayLines;
    }

}