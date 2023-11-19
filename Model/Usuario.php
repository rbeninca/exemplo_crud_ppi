<?php
    class Usuario {
        public $id;
        public $nome;
        public $email;
        public $senha;
        public $data_cadastro;

        public function setAll( $id,String $nome,String $email,String $senha,String $data_cadastro=null): void {
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->data_cadastro = $data_cadastro;
        }
        public function getAll(): array {
            return array($this->id, $this->nome, $this->email, $this->senha, $this->data_cadastro);
        }
       
        

    }


?>