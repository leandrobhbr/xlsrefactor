<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InAlunos;
use App\Imports\InAlunosSimples;
use App\Imports\InAnswers;
use App\Exports\ExportSessionArray;
use DB;

class ExcelController extends Controller
{
    public function alunos(){
        $alunos = new InAlunos();
        Excel::import($alunos, "disciplinaIsolada.xls");
        $dataArray = $alunos->getArrayLines();
        return Excel::download(new ExportSessionArray($dataArray), 'disciplinaIsolada.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function coordenadores(){
        $coordenadores = new InAlunos();
        Excel::import($coordenadores, "listaCoordenadores020920.xls");
        $dataArray = $coordenadores->getArrayLines();
        return Excel::download(new ExportSessionArray($dataArray), 'coordenadores080920.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function taes(){
        $taes = new InAlunos();
        Excel::import($taes, "taes.xls");
        $dataArray = $taes->getArrayLines();
        return Excel::download(new ExportSessionArray($dataArray), 'taes140920.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function credenciados(){
        $credenciados = new InAlunos();
        Excel::import($credenciados, "credenciados.xls");
        $dataArray = $credenciados->getArrayLines();
        return Excel::download(new ExportSessionArray($dataArray), 'credenciados210920.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function naocredenciados(){
        $naocredenciados = new InAlunos();
        Excel::import($naocredenciados, "naocredenciados.xls");
        $dataArray = $naocredenciados->getArrayLines();
        return Excel::download(new ExportSessionArray($dataArray), 'naocredenciados210920.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function joao(){
        // return 'joao';
        $linhas = array();
        $linhas[0] = ['Nome Aluno','Escola','Area de interesse'];
        $inscricoesAlunos = InscricaoAluno::all();
        $num = 1;
        foreach($inscricoesAlunos as $inscricaoAluno){
            $linhas[$num] = ["$nomeAluno","$escola","$area"];
            $num++;
        }
        return Excel::download(new ExportSessionArray($linhas), 'joao.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function limeUsersPG(){

        $alunos = new InAlunos();
        Excel::import($alunos, "alunosPG.xls");
        $dataArray = $alunos->getArrayLines();
        echo "INSERT INTO `lime`.`lime_tokens_239241_pg` (`id`, `email`) VALUES";
        echo "<br/>";
        // lime_tokens_239241_pg // criar utf8mb4_unicode_ci
        foreach($dataArray as $key => $value){
            if($key == 0) { continue; } // cabeçalho
            $email = $value[2];
            #echo "UPDATE `lime`.`lime_tokens_239241` SET `tipo`='PG' WHERE `email` IN (SELECT `email` FROM `lime`.`lime_tokens_239241_pg`);";
            echo "('$key', '$email'),";
            echo "<br/>";
            #DB::update("UPDATE lime_tokens_239241 SET tipo='PG' WHERE email = ?", array("$email"));
        }
    }

    public function limeUsersIS(){

        $alunos = new InAlunos();
        Excel::import($alunos, "alunosIS.xls");
        $dataArray = $alunos->getArrayLines();
        echo "INSERT INTO `lime`.`lime_tokens_239241_is` (`id`, `email`) VALUES";
        echo "<br/>";
        // lime_tokens_239241_pg // criar utf8mb4_unicode_ci
        foreach($dataArray as $key => $value){
            if($key == 0) { continue; } // cabeçalho
            $email = $value[2];
            #echo "UPDATE `lime`.`lime_tokens_239241` SET `tipo`='IS' WHERE `email` IN (SELECT `email` FROM `lime`.`lime_tokens_239241_is`);";
            echo "('$key', '$email'),";
            echo "<br/>";
        }
    }

    public function surveysUniq(){

        $surveysFull = DB::connection()->select("SELECT * FROM lime_survey_239241 ORDER BY id asc");
        $surveysUniq = [];

        foreach($surveysFull as  $surveys){
            $surveysUniq["{$surveys->token}"] = $surveys->id;
        }

        echo "INSERT INTO `lime_survey_239241_uniq` (`id`, `token`) VALUES";
        echo "<br/>";

        foreach($surveysUniq as $key => $value){
            $id = $value;
            $token = $key;
            echo "($id, '$token'),"; echo "<br/>";
        }
        #SELECT * FROM lime_survey_239241 WHERE id NOT IN (SELECT id FROM lime_survey_239241_uniq)
        #delete FROM lime_survey_239241 WHERE id NOT IN (SELECT id FROM lime_survey_239241_uniq);
    }

    public function limeAnswersExport(){

        $alunosPG = new InAlunosSimples();
        Excel::import($alunosPG, "alunosPG.xls");
        $dataArrayPG = $alunosPG->getArrayLines();
        $arrayPG = [];
        foreach($dataArrayPG as $keyPG => $valuePG){
            if($keyPG == 0) { continue; } // cabeçalho
            $arrayPG["".$valuePG[0].""] = array("registro" => $valuePG[1], "curso" => $valuePG[2]);
        }

        $alunosGR = new InAlunosSimples();
        Excel::import($alunosGR, "alunosGR.xls");
        $dataArrayGR = $alunosGR->getArrayLines();
        $arrayGR = [];
        foreach($dataArrayGR as $keyGR => $valueGR){
            if($keyGR == 0) { continue; } // cabeçalho
            $arrayGR["".$valueGR[0].""] = array("registro" => $valueGR[1], "curso" => $valueGR[2]);
        }

        $alunosIS = new InAlunosSimples();
        Excel::import($alunosIS, "alunosIS.xls");
        $dataArrayIS = $alunosIS->getArrayLines();
        $arrayIS = [];
        foreach($dataArrayIS as $keyIS => $valueIS){
            if($keyIS == 0) { continue; } // cabeçalho
            $arrayIS["".$valueIS[0].""] = array("registro" => $valueIS[1], "curso" => $valueIS[2]);
        }

        $answers = new InAnswers();
        Excel::import($answers, "respostasExportadas1706.xls");
        $dataArray = $answers->getArrayLines();

        foreach($dataArray as $key => $data){
            if($key == 0) { continue; } // cabeçalho
            $nivel = $data[0];
            $curso = $data[2];
            $registro = $data[3];
            $email = $data[4];
            if($nivel == "GR") {
                if(!empty($arrayGR["$email"])) {
                    $dataArray[$key][3] = $arrayGR["$email"]["registro"];
                    $dataArray[$key][2] = $arrayGR["$email"]["curso"];
                }
            }
            if($nivel == "PG") {
                if(!empty($arrayPG["$email"])) {
                    $dataArray[$key][3] = $arrayPG["$email"]["registro"];
                    $dataArray[$key][2] = $arrayPG["$email"]["curso"];
                }
            }
            if($nivel == "IS") {
                if(!empty($arrayIS["$email"])) {
                    $dataArray[$key][3] = $arrayIS["$email"]["registro"];
                    $dataArray[$key][2] = $arrayIS["$email"]["curso"];
                }
            }
        }
        #dd($dataArray);
        return Excel::download(new ExportSessionArray($dataArray), 'respostasGeralFinal1706.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    #UPDATE `lime`.`lime_tokens_239241` SET `completed`= 'N' WHERE  `tipo` != 'GR';
    #UPDATE `lime`.`lime_tokens_239241` SET `completed`= 'N' WHERE  `tipo` != 'GR';
    #DELETE FROM `lime`.`lime_survey_239241` WHERE `token` IN (SELECT `token` FROM `lime`.`lime_tokens_239241` WHERE `tipo` != 'GR');
    #DELETE FROM `lime`.`lime_survey_239241` WHERE `token` IN (SELECT `token` FROM `lime`.`lime_tokens_239241` WHERE `tipo` != 'PG');
    #DELETE FROM `lime`.`lime_survey_239241` WHERE `token` IN (SELECT `token` FROM `lime`.`lime_tokens_239241` WHERE `tipo` != 'IS');



}