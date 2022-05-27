import posts from './posts.js';
import user from './user.js';
import loading from './utils/loader.js';

$(function(){
    $('body').on('submit', 'form[name="formNewPost"]', function(e) {
        e.preventDefault();
        posts.insert();
    });

    // Cadastrar Usuário
    $('body').on('submit', 'form[name="formSigin"]', function(e) {
        e.preventDefault();
        loading.show();
        let form = $(this).serialize();
        user.insert(form);
    });

    // Efetuar Login
    $('body').on('submit', 'form[name="formLogin"]', function(e) {
        e.preventDefault();
        loading.show();
        let form = $(this).serialize();

        user.login(form)
            .then(res => {
                let data = res.data;
                
                if(data.type === 'success'){
                    window.location.href = '/';
                }else{
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
});