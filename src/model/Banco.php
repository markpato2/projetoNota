<?php

require_once("../init.php");
class Banco{

    protected $bulk;
    protected $manager;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){

        $this->bulk = new MongoDB\Driver\BulkWrite;
        $this->manager = new MongoDB\Driver\Manager(LINK_CONEXAO);

    }

    public function setXml($numeroNota,$data,$destinatario,$valor,$cpf,$endereco,$cep,$uf){

        $doc = [
            'numeroNota' => $numeroNota,
            'data' => $data,
            'destinatario' => $destinatario,
            'valor' => $valor,
            'cpf' => $cpf,
            'endereco' => $endereco,
            'cep' => $cep,
            'uf' => $uf,
        ];

        $this->bulk->insert($doc);

        $result = $this->manager->executeBulkWrite('care.notas', $this->bulk);


        if( $result == TRUE){
            return true ;
        }else{
            return false;
        }

    }

    public function getNotas(){

        $filter      = [];
        $options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
        $rows   = $this->manager->executeQuery('care.notas', $query);
        return $rows;


    }

    public function deleteNota($id){
       // $delete = new MongoDB\Driver\BulkWrite();
        //$delRec = new MongoDB\Driver\BulkWrite;
        $this->bulk->delete(['_id' =>new MongoDB\BSON\ObjectID($id)],
            ['limit' => 1]);
        $result = $this->manager->executeBulkWrite('care.notas', $this->bulk);

       // $result = $this->manager->executeBulkWrite('care.notas', $delete);

        if($result) {
           return true;
        }else{
            return false;
        }

    }

    public function pesquisaNota($id){
        $filter      = ['numeroNota'=>$id];
        $options = [];
        $query = new MongoDB\Driver\Query($filter, $options);
        $row   = $this->manager->executeQuery('care.notas', $query);
        return $row;

    }
}
?>
