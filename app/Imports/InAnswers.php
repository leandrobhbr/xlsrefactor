<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Http\Controllers\Reuso;

class InAnswers implements ToCollection{

    private $reuso;
    private $header;
    private $arrayLines;

    public function __construct() {

        $this->reuso = new Reuso();
        $this->header = ['nivel','nome','curso','registro','email','token','completed','submitdate','Qx1xA','Qx1xB','Qx1xC','Qx1xD','Qx1xE','Qx1xF','Qx2','Qx3','Qx4','Qx5','Qx6','Qx7','Qx8','Qx9','Qx10','Qx11','Qx111','Qx12','Qx13xA','Qx13xB','Qx13xC','Qx13xD','Qx13xE','Qx13xF','Qx13xG','Qx13xH','Qx13xI','Qx13xJ','Qx131xJ','Qx14xA','Qx14xB','Qx14xC','Qx14xD','Qx14xE','Qx14xF','Qx14xG','Qx14xH','Qx15xA','Qx15xB','Qx15xC','Qx15xD','Qx15xE','Qx15xF','Qx15xG','Qx15xH','Qx15xI','Qx16'];
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
           $nivel = $row[0];
           $nome = $row[1];
           $curso = $row[2];
           $registro = $row[3];
           $email = $row[4];
           $token = $row[5];
           $completed = $row[6];
           $submitdate = $row[7];
           $Qx1xA = $row[8];
           $Qx1xB = $row[9];
           $Qx1xC = $row[10];
           $Qx1xD = $row[11];
           $Qx1xE = $row[12];
           $Qx1xF = $row[13];
           $Qx2 = $row[14];
           $Qx3 = $row[15];
           $Qx4 = $row[16];
           $Qx5 = $row[17];
           $Qx6 = $row[18];
           $Qx7 = $row[19];
           $Qx8 = $row[20];
           $Qx9 = $row[21];
           $Qx10 = $row[22];
           $Qx11 = $row[23];
           $Qx111 = $row[24];
           $Qx12 = $row[25];
           $Qx13xA = $row[26];
           $Qx13xB = $row[27];
           $Qx13xC = $row[28];
           $Qx13xD = $row[29];
           $Qx13xE = $row[30];
           $Qx13xF = $row[31];
           $Qx13xG = $row[32];
           $Qx13xH = $row[33];
           $Qx13xI = $row[34];
           $Qx13xJ = $row[35];
           $Qx131xJ = $row[36];
           $Qx14xA = $row[37];
           $Qx14xB = $row[38];
           $Qx14xC = $row[39];
           $Qx14xD = $row[40];
           $Qx14xE = $row[41];
           $Qx14xF = $row[42];
           $Qx14xG = $row[43];
           $Qx14xH = $row[44];
           $Qx15xA = $row[45];
           $Qx15xB = $row[46];
           $Qx15xC = $row[47];
           $Qx15xD = $row[48];
           $Qx15xE = $row[49];
           $Qx15xF = $row[50];
           $Qx15xG = $row[51];
           $Qx15xH = $row[52];
           $Qx15xI = $row[53];
           $Qx16 = $row[54];
           $linhas[$key] = ["$nivel","$nome","$curso","$registro","$email","$token","$completed","$submitdate","$Qx1xA","$Qx1xB","$Qx1xC","$Qx1xD","$Qx1xE","$Qx1xF","$Qx2","$Qx3","$Qx4","$Qx5","$Qx6","$Qx7","$Qx8","$Qx9","$Qx10","$Qx11","$Qx111","$Qx12","$Qx13xA","$Qx13xB","$Qx13xC","$Qx13xD","$Qx13xE","$Qx13xF","$Qx13xG","$Qx13xH","$Qx13xI","$Qx13xJ","$Qx131xJ","$Qx14xA","$Qx14xB","$Qx14xC","$Qx14xD","$Qx14xE","$Qx14xF","$Qx14xG","$Qx14xH","$Qx15xA","$Qx15xB","$Qx15xC","$Qx15xD","$Qx15xE","$Qx15xF","$Qx15xG","$Qx15xH","$Qx15xI","$Qx16"];
           $key++;
        }
        $this->arrayLines = $linhas;
    }

    public function getArrayLines(){
        return $this->arrayLines;
    }

}