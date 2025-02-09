<?php

class Disciplina {
    private $id;
    private $nome;
    private $cargaHoraria;
    private $alunos; // Array de alunos

    public function __construct($id, $nome, $cargaHoraria) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cargaHoraria = $cargaHoraria;
        $this->alunos = []; // Inicializa o array de alunos
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getCargaHoraria() {
        return $this->cargaHoraria;
    }

    public function setCargaHoraria($cargaHoraria) {
        $this->cargaHoraria = $cargaHoraria;
    }

    // Método para obter os alunos
    public function getAlunos() {
        return $this->alunos;
    }

    // Método para adicionar um aluno
    public function addAluno($aluno) {
        $this->alunos[] = $aluno;
    }

    // Método para definir um array de alunos
    public function setAlunos(array $alunos) {
        $this->alunos = $alunos;
    }
}
?>
