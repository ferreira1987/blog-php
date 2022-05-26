<template>
<div>
    <div class="container mt-5">
        <div class="row">
            <div class="offset-lg-4 col-lg-4">
                <div class="card">
                    <div class="card-header bg-light text-center">
                        <h5 class="card-title mb-0">Autenticação</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" @submit.prevent="onSubmit()">
                            <div class="form-group">
                                <label class="mb-0">E-mail</label>
                                <input type="email" class="form-control" v-model="form.email" placeholder="Digite aqui seu E-mail" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="mb-0">Senha</label>
                                <input type="password" class="form-control" v-model="form.password" placeholder="Digite aqui sua Senha" required autocomplete="off">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" v-model="form.remember" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Lembre-me
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success w-100">Entrar</button>
                                <span class="d-block mt-3 text-center">
                                    Ainda não tem cadastro? <a href="#" @click.prevent="openModal">Clique aqui</a>
                                </span>                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <modal-sig-in></modal-sig-in>

</div>
</template>

<script>
import axios from 'axios';
import ModalSigIn from './SigIn.vue';

export default {
    components: {
        ModalSigIn
    },
    data(){
        return{
            form: {
                email: '',
                password: '',
                remember: false
            }
        }
    },
    methods: {
        onSubmit(){
            this.$loading.show();
            axios.post('/login', this.form)
                .then(res => {
                    window.location.href =  '/';
                })
                .catch(error => {
                    if(error.response.data){
                        let data = error.response.data;
                        this.$swal({
                            icon: data.type,
                            title: data.title,
                            html: data.message,
                        });                        
                    }
                    
                    console.log(error.response);
                });
        },

        openModal(){
            $('#modalSigIn').modal('toggle');
        },
    }
}
</script>