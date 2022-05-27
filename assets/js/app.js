import posts from './posts.js';
import user from './user.js';
import comments from './comments.js';
import loading from './utils/loader.js';
import utils from './utils/utils.js';

$(function () {
    $('body').on('blur', 'input[name="confirm"]', function(){
        user.validadePassword();
    });

    // Cadastrar Usuário
    $('body').on('submit', 'form[name="formSigin"]', function (e) {
        e.preventDefault();
        loading.show();
        $('.modal').modal('hide');
        let form = $(this).serialize();
        user.insert(form);
    });

    // Efetuar Login
    $('body').on('submit', 'form[name="formLogin"]', function (e) {
        e.preventDefault();
        loading.show();
        let form = $(this).serialize();

        user.login(form)
            .then(res => {
                let data = res.data;

                if (data.type === 'success') {
                    window.location.href = '/';
                } else {
                    Swal.fire({
                        icon: data.type,
                        title: data.title,
                        html: data.message
                    });
                }
            })
            .catch(error => {
                console.log(error);
            });
    });

    // Cadastra Post
    $('body').on('submit', 'form[name="formNewPost"]', function(e) {
        e.preventDefault();
        let form = $(this);
        loading.show();
        $('.modal').modal('hide');
        let post = $(this).serialize();

        posts.insert(post)
            .then(res => {
                let data = res.data;
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    html: data.message
                });

                if(data.type === 'success'){
                    utils.resetForm(form);
                }

            })
            .catch(error => {
                console.log(error);
            });        
    });

    // Busca Post e exibi para edição
    $('body').on('click', '[data-toggle="edit-post"]', function(){
        let id = $(this).attr('data-id');
        loading.show();
        
        posts.get(id)
            .then(res => {
                let data = res.data;
                $('form[name="formEditPost"] input[name="post_id"]').val(data.id);
                $('form[name="formEditPost"] input[name="titulo"]').val(data.titulo);
                $('form[name="formEditPost"] textarea[name="descricao"]').val(data.descricao);
                $('#editPost .modal-title').text(data.titulo);

                loading.hide();
                $('#editPost').modal('show')
            })
            .catch(error => {
                loading.hide();
                console.log(error);
            });         
    });

    // Atualiza Post
    $('body').on('submit', 'form[name="formEditPost"]', function(e){
        e.preventDefault();
        let form = $(this).serialize();
        loading.show();
        $('.modal').modal('hide');

        posts.update(form)
            .then(res => {
                let data = res.data;
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    html: data.message
                });
            })
            .catch(error => {
                loading.hide();
                console.log(error);
            });         
    });

    // Excluir Post
    $('body').on('click', '[data-toggle="edit-destroy"]', function(){
        let el = $(this);
        let id = el.attr('data-id');
        Swal.fire({
            icon: 'question',
            html: 'Deseja realmente excluir este post?',
            showDenyButton: true,
            denyButtonText: 'Não',
            confirmButtonText: 'Sim'
        })
        .then(result => {
            if(result.value){
                loading.show();        
                posts.destroy(id)
                    .then(res => {
                        let data = res.data;
        
                        Swal.fire({
                            icon: data.type,
                            title: data.title,
                            html: data.message
                        });
        
                        if(data.type === 'success'){
                            el.closest('.row').remove();
                        }
                    })
                    .catch(error => {
                        loading.hide();
                        console.log(error);
                    });                  
            }
        });
    }); 
    
    // Grava Comentário
    $('body').on('submit', 'form[name="formComment"]', function(e) {
        e.preventDefault();
        let form = $(this);
        let comment = form.serialize()
        loading.show();

        comments.insert(comment)
            .then(res => {
                let data = res.data;
                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    html: data.message
                });

                if(data.type === 'success'){
                    utils.resetForm(form);
                }

            })
            .catch(error => {
                console.log(error);
            });        
    });    

});