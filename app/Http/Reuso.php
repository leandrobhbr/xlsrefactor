<?php

namespace App\Http\Controllers;

class Reuso extends Controller
{
    public function retornaFirstName($nomeCompleto){
        $nomes=explode(" ",$nomeCompleto);
        return $nomes[0];
    }

    public function retornaLastName($nomeCompleto){
        $nomes=explode(" ",$nomeCompleto);
        $lastname="";
        $counter = 1;
        $qtdNome = count($nomes)-1;
        foreach ($nomes as $key => $value){
           if($key == 0) { continue; } // remove o firstName
           if($counter == $qtdNome) { $lastname.=$value; continue; } // remove espaço da última palavra
           $lastname.=$value." ";
           $counter = $counter + 1;
        }
        return $lastname;
    }

    public function retornaToken(){
        // date apenas não pega microsegundos precisa do dateTime
        $now = new \DateTime('now');
        $data = $now->format('Ymdu');
        return $data.rand(1,1000); // data e milisegundos + valor randonico pra ficar diferente
    }

    public function retornaEmailMinhaUfmg($login){
        return $login."@ufmg.br";
    }

    public function retornaLogin($email){
        $texto = explode("@",$email);
        return $texto[0];
    }

}