<template>

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