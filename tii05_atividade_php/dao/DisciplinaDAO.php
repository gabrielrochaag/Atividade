<?php
require_once 'BaseDAO.php';
require_once 'entity/Disciplina.php';
require_once 'entity/Aluno.php';
require_once 'entity/Professor.php';
require_once 'config/Database.php';

class DisciplinaDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Disciplina WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Disciplina($row['id'], $row['nome'], $row['carga_horaria']);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Disciplina";
        $stmt = $this->db->query($sql);
        $disciplinas = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $disciplinas[] = new Disciplina($row['id'], $row['nome'], $row['carga_horaria']);
        }
        return $disciplinas;
    }

    public function create($disciplina)
    {
        $sql = "INSERT INTO Disciplina (nome, chave, carga_horaria) VALUES (:nome, :chave, :carga_horaria)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $disciplina->getNome());
        $stmt->bindParam(':chave', $disciplina->getChave());
        $stmt->bindParam(':carga_horaria', $disciplina->getCargaHoraria());
        $stmt->execute();
    }

    public function update($disciplina)
    {
        $sql = "UPDATE Disciplina SET nome = :nome, chave = :chave, carga_horaria = :carga_horaria WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $disciplina->getNome());
        $stmt->bindParam(':chave', $disciplina->getChave());
        $stmt->bindParam(':carga_horaria', $disciplina->getCargaHoraria());
        $stmt->bindParam(':id', $disciplina->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Disciplina WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Método para obter disciplina com seus alunos
    public function getDisciplinaWithAlunos($disciplinaID)
    {
        // Simulação de dados
        $disciplinas = [
            1 => ['nome' => 'Programação', 'alunos' => [1, 2]],
            2 => ['nome' => 'Banco de Dados', 'alunos' => [2, 3]],
            3 => ['nome' => 'Redes de Computadores', 'alunos' => [1, 3]],
        ];

        $alunos = [
            1 => ['id' => 1, 'nome' => 'João Santos'],
            2 => ['id' => 2, 'nome' => 'Mariana Costa'],
            3 => ['id' => 3, 'nome' => 'Lucas Alves'],
        ];

        // Verifica se a disciplina existe
        if (isset($disciplinas[$disciplinaID])) {
            $disciplinaDados = $disciplinas[$disciplinaID];
            $disciplina = new Disciplina($disciplinaID, $disciplinaDados['nome']);

            // Obter os alunos associados à disciplina
            $alunosAssociados = [];
            foreach ($disciplinaDados['alunos'] as $alunoID) {
                if (isset($alunos[$alunoID])) {
                    $alunoInfo = $alunos[$alunoID];
                    $alunosAssociados[] = new Aluno($alunoInfo['id'], $alunoInfo['nome']);
                }
            }

            // Associar os alunos à disciplina
            $disciplina->setAlunos($alunosAssociados);

            return $disciplina; // Retornar a disciplina com seus alunos
        }

        return null; // Disciplina não encontrada
    }

    // Método para obter os professores da disciplina
    public function getProfessoresForDisciplina($disciplinaID)
    {
        $professoresDados = [
            ['id' => 1, 'nome' => 'Aécio', 'disciplina_id' => 1],
            ['id' => 2, 'nome' => 'Maria', 'disciplina_id' => 2],
            ['id' => 3, 'nome' => 'Luana', 'disciplina_id' => 3],
        ];

        // Filtra os professores pela disciplina
        $professoresAssociados = array_filter($professoresDados, fn($p) => $p['disciplina_id'] === $disciplinaID);

        $professores = [];
        foreach ($professoresAssociados as $professorInfo) {
            $professores[] = new Professor($professorInfo['id'], $professorInfo['nome'], $professorInfo['disciplina_id']);
        }

        return $professores; // Retornar os professores da disciplina
    }
}
