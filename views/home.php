<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <h2>Posts</h2>
        </div>
        <div class="col-6 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newPost">Novo Post</button>
        </div>
    </div>

    <div v-for="item in $store.state.posts" :key="item.id" class="row border-top mt-3">
        <div class="col-lg-10 col-12 py-3">
            <h4 class="mb-2">
                <a :href="`/noticia/${item.id}`">{{ item.titulo }}</a>
            </h4>
            <p>{{ limitarText(item.descricao) }}</p>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <i><b>Autor:</b> {{ item.user.name }}</i>
                </div>
                <div class="col-lg-4 col-12">
                    <i><b>Data:</b> {{ formatDate(item.data_inclusao) }}</i>
                </div>
                <div class="col-lg-4 col-12">
                    <i><b>Comentários:</b> {{ item.comments.length }}</i>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-12 py-3 d-flex align-items-center justify-content-end">
            <button class="btn btn-sm btn-primary mr-2" @click="editarModal(item)">Editar</button>
            <button class="btn btn-sm btn-danger" @click="excluir(item.id)">Excluir</button>
        </div>
    </div>
</div>

<?php
    include(__DIR__ . '/views/post-create.php');
    include(__DIR__ . '/views/post-edit.php');
?>