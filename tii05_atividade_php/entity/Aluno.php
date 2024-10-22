<?php
class Aluno {
    private $matricula;
    private $nome;
    private $disciplinas; // Array de disciplinas

    public function __construct($matricula, $nome) {
        $this->matricula = $matricula;
        $this->nome = $nome;
        $this->disciplinas = []; // Inicializa o array de disciplinas
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    // Método para obter as disciplinas
    public function getDisciplinas() {
        return $this->disciplinas;
    }

    // Método para adicionar uma disciplina
    public function addDisciplina($disciplina) {
        $this->disciplinas[] = $disciplina;
    }

    // Método para definir um array de disciplinas
    public function setDisciplinas(array $disciplinas) {
        $this->disciplinas = $disciplinas;
    }
}
?>


