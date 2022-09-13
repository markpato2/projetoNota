<?php
require_once("../model/Banco.php");
class listarController{

    private $lista;

    public function __construct(){
        $this->lista = new Banco();
        $this->criarTabela();

    }

    private function criarTabela(){
        $row = $this->lista->getNotas();




        if(isset($row)){
            foreach ($row as $value){



                foreach ($value->numeroNota as $nota){ $numeroNota =$nota;}
                foreach ($value->data as $data){ $data =$data;}
                foreach ($value->destinatario as $destinatario){ $destinatario =$destinatario;}
                foreach ($value->cpf as $cpf){ $cpf =$cpf;}
                foreach ($value->cep as $cpf){ $cep =$cep;}
                foreach ($value->uf as $uf){ $uf =$uf;}
                foreach ($value->valor as $valor){ $valor =$valor;}


                echo "<tr>";
                echo "<th>".$numeroNota  ."</th>";
                echo "<td>".$data ."</td>";
                echo "<td>".$destinatario ."</td>";
                echo "<td>".$cpf ."</td>";
                echo "<td>".$cep."</td>";
                echo "<td>".$uf."</td>";
                echo "<td>".$value->endereco."</td>";
                echo "<td> R$".$valor ."</td>";
                echo "<td><a class='btn btn-danger' href='../controller/ControllerDeletar.php?id=".$value->_id."'>Excluir</a></td>";
                echo "</tr>";
            }

        }


    }
}

