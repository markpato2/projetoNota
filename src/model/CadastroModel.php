<?php
require_once("Banco.php");

class CadastroModel extends Banco {

    private $numeroNota;
    private $data;
    private $destinatario;
    private $valor;
    private $cpf;
    private $endereco;
    private $cep;
    private $uf;

    //Metodos Set
    public function setNumeroNota($string){
        $this->numeroNota = $string;
    }
    public function setData($string){
        $this->data = $string;
    }
    public function setDestinatario($string){
        $this->destinatario = $string;
    }
    public function setValor($string){
        $this->valor = $string;
    }
    public function setCpf($string){
        $this->cpf = $string;
    }
    public function setEndereco($string){
        $this->endereco = $string;
    }
    public function setCep($string){
        $this->cep = $string;
    }

    public function setUf($string){
        $this->uf = $string;
    }

    //Metodos Get
    public function getNumeroNota(){
        return $this->numeroNota;
    }
    public function getData(){
        return $this->data;
    }
    public function getDestinatario(){
        return $this->destinatario;
    }
    public function getValor(){
        return $this->valor;
    }
    public function getCpf(){
        return $this->cpf;
    }
    public function getEndereco(){
        return $this->endereco;
    }
    public function getCep(){
        return $this->cep;
    }

    public function getUf(){
        return $this->uf;
    }


    public function incluir(){
        return $this->setXml($this->getNumeroNota(),$this->getData(),$this->getDestinatario(),$this->getValor(),$this->getCpf(),$this->getEndereco(),$this->getCep(),$this->getUf());
    }
}
?>
