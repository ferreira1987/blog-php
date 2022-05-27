<?php
    require(__DIR__ . '/../app/Post.php');
    $posts = (new Post())->getWithComment(URL::getURL(1));
    $post = $posts[0];
?>

<div class="container mt-5 mb-5">
    <h3 class="text-info"><?= $post->titulo ?></h3>
    <small class="d-block">
        <i><?= $post->username ?>, <?= date('d/m/Y H:i', strtotime($post->data_inclusao)); ?></i>
    </small>
    <div class="mt-3 d-block"><?= $post->descricao ?></div>

    <form name="formComment" class="mt-5">
        <div class="form-group">
            <label>Deixe seu comentário:</label>
            <textarea class="form-control" name="comment" rows="5" required minlength="10"></textarea>
            <input type="hidden" name="post_id" value="<?= $post->id ?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Comentar</button>
        </div>
    </form>

    <?php
        if($post->comment):            
    ?>
        <div v-if="$store.state.comments.length > 0">
            <h6 class="border-top border-bottom mt-5 py-2 text-danger">Comentários</h6>
            <?php
                foreach($posts as $item):
            ?>
                <div class="d-block mt-2 border-bottom pb-3">
                    <p class="font-weight-bold mb-0"><?= $item->user; ?></p>
                    <small class="d-block mb-2"><?= date('d/m/Y H:i', strtotime($item->data)); ?></small>
                    <div class="d-block">
                        <?= $item->comment; ?>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
        </div>
    <?php
        endif;
    ?>
</div