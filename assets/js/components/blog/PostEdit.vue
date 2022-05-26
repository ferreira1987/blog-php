<template>
    <div class="modal fade" id="editPost" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                    <h5 class="modal-title text-white">{{ form.titulo }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="formEditPost" id="formEditPost" @submit.prevent="onSubmit()">
                        <div class="form-group">
                            <label class="mb-0">Título</label>
                            <input type="text" class="form-control" name="nome" v-model="form.titulo" required
                                autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="mb-0">Descrição</label>
                            <textarea 
                                class="form-control" 
                                name="email" 
                                v-model="form.descricao" 
                                required 
                                rows="10"
                            >
                            </textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" form="formEditPost" class="btn btn-success">Atualiar Post</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fehar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                id: '',
                titulo: '',
                descricao: '',
            }
        }
    },
    mounted() {
        this.emitter.on('preencher', data => {
            this.form = data;
        });
    },
    methods: {
        onSubmit() {
            this.$loading.show();
            $('#editPost').modal('hide');

            axios.put(`/${this.form.id}`, this.form)
                .then(res => {
                    let data = res.data;
                    this.$swal({
                        icon: data.type,
                        title: data.title,
                        html: data.message,
                    });

                    this.$store.commit('setPosts', data.posts);
                })
                .catch(error => {
                    if (error.response) {
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