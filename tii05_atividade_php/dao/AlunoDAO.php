<?php
require_once 'BaseDAO.php';
require_once 'entity/Aluno.php';
require_once 'entity/Disciplina.php';
require_once 'config/Database.php';

class AlunoDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM Aluno WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Aluno($row['matricula'], $row['nome']);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Aluno";
        $stmt = $this->db->query($sql);
        $alunos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $alunos[] = new Aluno($row['matricula'], $row['nome']);
        }
        return $alunos;
    }

    public function create($aluno)
    {
        $sql = "INSERT INTO Aluno (nome) VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $aluno->getNome());
        $stmt->execute();
    }

    public function update($aluno)
    {
        $sql = "UPDATE Aluno SET nome = :nome WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $aluno->getNome());
        $stmt->bindParam(':id', $aluno->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM Aluno WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Método para obter aluno com suas disciplinas
    public function getAlunoWithDisciplinas($alunoID)
    {  

    // Exemplo de dados de alunos e disciplinas 
    $alunos = [
        1 => ['nome' => 'João Santos', 'disciplinas' => ['Matemática', 'Física']],
        2 => ['nome' => 'Mariana Costa', 'disciplinas' => ['Química', 'Biologia']],
        3 => ['nome' => 'Lucas Alves', 'disciplinas' => ['História', 'Geografia']]
        
    ];

    $alunoID = 1; // ID do aluno que deseja buscar
$dadosAluno = $this->getAlunoWithDisciplinas($alunoID);

// Exibir os resultados
if ($dadosAluno) {
    echo "Nome do Aluno: " . $dadosAluno['nome'] . "<br>";
    echo "Disciplinas: <br>";
    foreach ($dadosAluno['disciplinas'] as $disciplina) {
        echo "- " . $disciplina . "<br>";
    }
} else {
    echo "Nenhum aluno encontrado com esse ID.";
}



    // Verificar se o aluno com o ID especificado existe
   // if (isset($alunos[$alunoID])) {
   //     return $alunos[$alunoID]; // Retornar os dados do aluno com as disciplinas
  //  } else {
  //      return null; // Retornar null se o aluno não for encontrado
//}
if (isset($alunos[$alunoID])) {
    // Criar e retornar um objeto do tipo Aluno com as disciplinas
    $dados = $alunos[$alunoID];
    return new Aluno($dados['nome'], $dados['disciplinas']);
} else {
    return null; // Retornar null se o aluno não for encontrado
}

        /*
        Retorne a implementação de um objeto do tipo aluno, contendo suas respectivas disciplinas
         */

         //class Aluno {
           // public $nome;
           // public $disciplinas;
        
           // public function __construct($nome, $disciplinas) {
           //     $this->nome = $nome;
           //     $this->disciplinas = $disciplinas;
         //   }
       // }
        
        return null;
    }
}
