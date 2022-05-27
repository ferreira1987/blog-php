<?php 
require_once(__DIR__ . '/conexao/conexao.php');

class User{

    private $conn = null;

    public function __construct()
    {
        if(!$this->conn){
            $this->conn = Conexao::getInstance();
        }
    }

    public function login($user){
        try{;
            $senha = $user['password'];

            $sql = "SELECT id, name, email, password FROM user WHERE email = :email";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':email', $user['email']);
            $stm->execute();
            $result = $stm->fetchObject();

            if($result){
                if(password_verify($senha, $result->password)){
                    $_SESSION['UserLogin'] = $result;
                    echo json_encode(['type' => 'success', 'title' => '', 'message' => '<b>Login efetuado com sucesso.</b>']);                
                }else{
                    echo json_encode(['type' => 'warning', 'title' => '', 'message' => '<b>Email ou senha incorreto.</b>']);
                }
            }else{
                echo json_encode(['type' => 'warning', 'title' => '', 'message' => '<b>Email ou senha incorreto.</b>']);
            }

        }catch(Exception $e){
            echo json_encode(['type' => 'error', 'title' => 'Oops!', 'message' => '<b>Erro ao efetuar login.</b><br>' . $e->getMessage()]);
        }
    }

    public function insert($user){
        try{
            $data = date('Y-m-d H:i:s', time());
            $senha = password_hash($user['password'], PASSWORD_BCRYPT);

            $sql = "INSERT INTO user (name, email, password, data_inclusao) values (:name, :email, :password, :data_inclusao)";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':name', $user['nome']);
            $stm->bindValue(':email', $user['email']);
            $stm->bindValue(':password', $senha);
            $stm->bindValue(':data_inclusao', $data);

            $stm->execute();

            echo json_encode(['type' => 'success', 'title' => '', 'message' => '<b>Usuário Cadastro com sucesso.</b>']);
        }catch(Exception $e){
            echo json_encode(['type' => 'error', 'title' => 'Oops!', 'message' => '<b>Erro ao cadastrar Usuário</b><br>' . $e->getMessage()]);
        }
    }

}