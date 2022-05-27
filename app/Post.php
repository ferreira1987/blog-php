<?php

class Post{

    private $conn = null;
    private $user = null;

    public function __construct()
    {
        if(!$this->conn){
            $this->conn = Conexao::getInstance();
        }

        $this->user = $_SESSION['UserLogin'];
    }

    public function insert($post){
        try{
            $data = date('Y-m-d H:i:s', time());

            $sql = "INSERT INTO post (user_id, titulo, descricao, data_inclusao) values (:user_id, :titulo, :descricao, :data_inclusao)";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':user_id', $this->user->id);
            $stm->bindValue(':titulo', $post['titulo']);
            $stm->bindValue(':descricao', $post['descricao']);
            $stm->bindValue(':data_inclusao', $data);

            $stm->execute();

            echo json_encode(['type' => 'success', 'title' => '', 'message' => '<b>Post criado com sucesso.</b>']);
        }catch(\Throwable $e){
            echo json_encode(['type' => 'error', 'title' => 'Oops!', 'message' => '<b>Erro ao criar post.</b><br>' . $e->getMessage()]);
        }      
    }

    public function update($post){
        try{
            $sql = "UPDATE post SET user_id = :user_id,  titulo = :titulo,  descricao = :descricao WHERE id = :post_id";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':user_id', $this->user->id);
            $stm->bindValue(':titulo', $post['titulo']);
            $stm->bindValue(':descricao', $post['descricao']);
            $stm->bindValue(':post_id', $post['post_id']);

            $stm->execute();

            echo json_encode(['type' => 'success', 'title' => '', 'message' => '<b>Post atualizado com sucesso.</b>']);
        }catch(\Throwable $e){
            echo json_encode(['type' => 'error', 'title' => 'Oops!', 'message' => '<b>Erro ao atualizar post.</b><br>' . $e->getMessage()]);
        }      
    }

    public function destroy($id){
        try{
            $sql = "DELETE FROM post WHERE id = :post_id";
            $stm = $this->conn->prepare($sql);
            $stm->bindValue(':post_id', $id);
            $stm->execute();

            echo json_encode(['type' => 'success', 'title' => '', 'message' => '<b>Post excluído com sucesso.</b>']);
        }catch(\Throwable $e){
            echo json_encode(['type' => 'error', 'title' => 'Oops!', 'message' => '<b>Erro ao excluir post.</b><br>' . $e->getMessage()]);
        }      
    }

    public function get($id){
        $sql = "SELECT post.id, post.titulo, post.descricao, post.data_inclusao, user.name as username
                    FROM post INNER JOIN user ON (user.id=post.user_id) WHERE post.id = :post_id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(':post_id', $id);
        $stm->execute();

        return $stm->fetchObject();
    }

    public function getWithComment($id){
        $sql = "SELECT post.id, post.titulo, post.descricao, post.data_inclusao, user.name as username, cm.comment, cm.data, cm.user
                    FROM post INNER JOIN user ON (user.id=post.user_id) 
                    LEFT JOIN (SELECT comments.post_id, comments.comment, comments.data_inclusao as data, user.name as user
                        FROM comments INNER JOIN user ON (user.id=comments.user_id) ) as cm ON (cm.post_id=post.id) WHERE post.id = :post_id";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(':post_id', $id);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }    

    public function getAll(){
        $sql = "SELECT post.id, post.titulo, post.descricao, post.data_inclusao, user.name as username, COALESCE(cm.qtde, 0) AS qtdeComennt
                    FROM post INNER JOIN user ON (user.id=post.user_id) LEFT JOIN (SELECT post_id, count(*) as qtde FROM comments GROUP BY post_id) as cm ON (cm.post_id=post.id) 
                    ORDER BY id DESC";
        $stm = $this->conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }    

}