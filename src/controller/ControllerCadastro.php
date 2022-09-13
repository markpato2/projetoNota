<?php
require_once("../model/CadastroModel.php");
class cadastroController{

    private $cadastro;

    public function __construct(){
        $this->cadastro = new CadastroModel();
        $this->incluir();
    }

    private function incluir(){


        $formatosPermitidos = array("xml","XML");
        $extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
        //Verifica Formato Permitido
        if(in_array($extensao,$formatosPermitidos)){
            $pasta = "../arquivos\\";
            $temporario = $_FILES['arquivo']['tmp_name'];
            $novoNome = uniqid().".$extensao";
            if(move_uploaded_file($temporario, $pasta.$novoNome)) {

                // Transformando arquivo XML em Objeto
                $xml = simplexml_load_file($pasta.$novoNome);
                //Obter valores para guardar no banco

                //Verificar se é CPF ou CNPJ
                if(isset($xml->NFe->infNFe->dest->CPF)){
                    $cpfCnpj = $xml->NFe->infNFe->dest->CPF;
                }else{
                    $cpfCnpj = $xml->NFe->infNFe->dest->CNPJ;
                }
                //Verifica se Tem tag <emit>
                if(isset($xml->NFe->infNFe->emit->CNPJ)) {

                    $cnpjEmit = $xml->NFe->infNFe->emit->CNPJ;

                    //Valida CNPJ do Emitente
                    if ($cnpjEmit != CNPJ_VALIDO) {
                        //Apagar Arquivo
                        unlink($pasta . $novoNome);
                        $mensagem = "'CNPJ do Emitente Inválido '";
                        echo "<script>alert($mensagem);history.back()</script>";
                        return;
                    }

                    //Valida tag nProt
                    if($xml->protNFe->infProt->nProt==""){
                        unlink($pasta . $novoNome);
                        $mensagem = "'nProt Inválido '";
                        echo "<script>alert($mensagem);history.back()</script>";
                        return;
                    }

                    //Obter Nota Fiscal
                    if (isset($xml->NFe->infNFe)) {
                        $notaFiscal = $xml->NFe->infNFe->attributes();
                    } else {
                        $notaFiscal = $xml->infNFe->attributes();
                    }

                    $existeNota= $this->cadastro->pesquisaNota($notaFiscal->Id);

                    foreach ($existeNota as $document) {

                        $nota=$document->numeroNota;
                    }

                    if(isset($nota)){
                        unlink( $pasta.$novoNome);
                        $mensagem = "'Nota já Cadastrada'";
                        echo "<script>alert($mensagem);history.back()</script>";
                        return;

                    }

                }else{
                    unlink( $pasta.$novoNome);
                    $mensagem = "'CNPJ do Emitente Inválido '";
                    echo "<script>alert($mensagem);history.back()</script>";
                    return;
                }

                $dataNota = $xml->protNFe->infProt->dhRecbto;
                $destinatario = $xml->NFe->infNFe->dest->xNome;
                $valorNota = $xml->NFe->infNFe->total->ICMSTot->vNF;
                $endereco = $xml->NFe->infNFe->dest->enderDest->xLgr.
                    " número ".$xml->NFe->infNFe->dest->enderDest->nro.
                    " complemento ".$xml->NFe->infNFe->dest->enderDest->xCpl.
                    " bairro ".$xml->NFe->infNFe->dest->enderDest->xBairro.
                    " municipio ".$xml->NFe->infNFe->dest->enderDest->xMun;
                $uf = $xml->NFe->infNFe->dest->enderDest->UF;
                $cep = $xml->NFe->infNFe->dest->enderDest->CEP;

                //Guardar Dados
                $this->cadastro->setNumeroNota($notaFiscal->Id);
                $this->cadastro->setData($dataNota);
                $this->cadastro->setDestinatario($destinatario);
                $this->cadastro->setValor($valorNota);
                $this->cadastro->setCpf($cpfCnpj);
                $this->cadastro->setEndereco($endereco);
                $this->cadastro->setUf($uf);
                $this->cadastro->setCep($cep);
                $result = $this->cadastro->incluir();
                if($result >= 1){
                    unlink( $pasta.$novoNome);
                    echo "<script>alert('Registro incluído com sucesso!');document.location='../view/index.php'</script>";
                }else{
                    unlink( $pasta.$novoNome);
                    echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
                }


            } else {
                $mensagem = "'Erro, não foi possível fazer o upload'";
                echo "<script>alert($mensagem);history.back()</script>";
            }
        } else {
            $mensagem = "'Formato Inválido'";
            echo "<script>alert($mensagem);history.back()</script>";
        }


    }
}
new cadastroController();
