<template>
 
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