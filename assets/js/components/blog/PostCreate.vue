<template>

</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            form: {
                titulo: '',
                descricao: ''
            }
        }
    },
    methods:{
        onSubmit(){
            this.$loading.show();
             $('#newPost').modal('hide');

            axios.post('/', this.form)
                .then(res => {
                    let data = res.data;           
                    this.$swal({
                        icon: data.type,
                        title: data.title,
                        html: data.message,
                    }); 

                    this.$store.commit('setPosts', data.posts);
                    this.$utils.resetForm(this.form);
                })
                .catch(error => {
                    if(error.response){
                        let data = error.response.data;
                        this.$swal({
                            icon: data.type,
                            title: data.title,
                            html: data.message,
                        });                        
                    }  
                    
                    console.log(error);
                })
        }
    }
}
</script>