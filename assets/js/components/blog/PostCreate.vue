<template>
 <div class="modal fade" id="newPost" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                    <h5 class="modal-title text-white">Novo Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="sigIn" id="sigIn" @submit.prevent="onSubmit()">
                        <div class="form-group">
                            <label class="mb-0">Título</label>
                            <input type="text" class="form-control" name="nome" v-model="form.titulo" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="mb-0">Descrição</label>
                            <textarea 
                                class="form-control" 
                                name="email" 
                                v-model="form.descricao" 
                                required
                                rows="10">
                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" form="sigIn" class="btn btn-success">Criar Post</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fehar</button>
                </div>
            </div>
        </div>
    </div>    
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