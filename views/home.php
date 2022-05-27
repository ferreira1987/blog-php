<?php
    require(__DIR__ . '/../app/Post.php');
    $posts = (new Post())->getAll();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h2>Posts</h2>
        </div>
        <div class="col-6 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newPost">Novo Post</button>
        </div>
    </div>

    <?php
        foreach($posts as $post):
    ?>
        <div v-for="item in $store.state.posts" :key="item.id" class="row border-top mt-3">
            <div class="col-lg-10 col-12 py-3">
                <h4 class="mb-2">
                    <a href="/noticia/<?= $post->id; ?>"><?= $post->titulo; ?></a>
                </h4>
                <p><?= (strlen($post->descricao) > 300 ? substr($post->descricao, 0, 300) . ' ...' : $post->descricao); ?></p>
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <i><b>Autor:</b> <?= $post->username; ?></i>
                    </div>
                    <div class="col-lg-4 col-12">
                        <i><b>Data:</b> <?= date('d/m/Y H:i', strtotime($post->data_inclusao)); ?></i>
                    </div>
                    <div class="col-lg-4 col-12">
                        <i><b>Comentários:</b> <?= $post->qtdeComennt;?></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-12 py-3 d-flex align-items-center justify-content-end">
                <button class="btn btn-sm btn-primary mr-2" data-toggle="edit-post" data-id="<?= $post->id;?>">Editar</button>
                <button class="btn btn-sm btn-danger" data-toggle="edit-destroy" data-id="<?= $post->id;?>">Excluir</button>
            </div>
        </div>
    <?php
        endforeach;
    ?>
</div>

<?php
    include(__DIR__ . '/post-create.php');
    include(__DIR__ . '/post-edit.php');
?>