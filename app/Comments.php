<?php

class Comments{
    private $conn = null;
    private $user = null;

    public function __construct()
    {
        if(!$this->conn){
            $this->conn = Conexao::getInstance();
        }

        $this->user = $_SESSION['UserLogin'];
    }

    public function insert($comment){
        try{
            $data = date('Y-m-d H:i:s', time());

            $sql = "INSERT INTO comments (user_id, post_id, comment, data_inclusao) values (:user_id, :post_id, :comment, :data_inclusao)";

            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':user_id', $this->user->id);
            $stm->bindValue(':post_id', $comment['post_id']);
            $stm->bindValue(':comment', $comment['comment']);
            $stm->bindValue(':data_inclusao', $data);

            $stm->execute();

            echo json_encode(['type' => 'success', 'title' => '', 'message' => '<b>Comentário criado com sucesso.</b>']);
        }catch(\Throwable $e){
            echo json_encode(['type' => 'error', 'title' => 'Oops!', 'message' => '<b>Erro ao comentário post.</b><br>' . $e->getMessage()]);
        }      
    }
}