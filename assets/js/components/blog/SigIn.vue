<template>
    <div class="modal fade" id="modalSigIn" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                    <h5 class="modal-title text-white">Cadastre-se</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="sigIn" id="sigIn" @submit.prevent="onSubmit()">
                        <div class="form-group">
                            <label class="mb-0">Nome</label>
                            <input type="text" class="form-control" name="nome" v-model="form.nome" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="mb-0">E-mail</label>
                            <input type="email" class="form-control" name="email" v-model="form.email" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="mb-0">Senha</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                name="password" 
                                v-model="form.senha" 
                                required 
                                autocomplete="off"
                                minlength="6"
                            >
                        </div>
                        <div class="form-group">
                            <label class="mb-0">Confirme a Senha</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                name="confirm" 
                                v-model="form.confirm" 
                                required 
                                autocomplete="off"
                                minlength="6"
                                id="confirm"
                                @blur="onBlur()"
                            >
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" form="sigIn" class="btn btn-success">Cadastrar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fehar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, onMounted } from 'vue';
import axios from 'axios';

export default {
    data(){
        return {
            form: {
                nome: '',
                email: '',
                senha: '',
                confirm: ''
            }            
        }
    },
    mounted(){
        this.validadePassword();
    },
    methods: {
        validadePassword() {
            let confirm = document.getElementById('confirm');

            if(this.form.senha != this.form.confirm){
                confirm.setCustomValidity('Senhas não correspondem!');
            }else{
                confirm.setCustomValidity('');              
            }
        },

        onBlur(){
            this.validadePassword();
        },

        onSubmit(){
            this.$loading.show();
            $('#modalSigIn').modal('hide');

            axios.post('/sigin', this.form)
                .then((res) => {
                    let data = res.data;

                    this.$swal({
                        icon: data.type,
                        title: data.title,
                        html: data.message,
                    });
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
                });
        }
    }
}
</script>