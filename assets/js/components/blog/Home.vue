<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h2>Posts</h2>
            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn btn-success" @click="openModal()">Novo Post</button>
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

        <post-create></post-create>

        <post-edit></post-edit>

    </div>
</template>

<script>
import axios from 'axios';
import PostCreate from './PostCreate.vue';
import PostEdit from './PostEdit.vue';

export default {
    props: ['posts'],    
    components: {
        PostCreate,
        PostEdit
    },
    mounted(){
        this.$store.commit('setPosts', this.posts);
    },
    methods: {
        limitarText(text){
            let string = (text.length > 300 ? String(text).substring(0, 300) + ' ...'  : text);            
            return string;
        },
        formatDate(data){
            let date = new Date(data);
            let options = {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric'
            };

            return date.toLocaleDateString('pt-BR', options);
        },
        editarModal(post){
            this.emitter.emit('preencher', post);
            $('#editPost').modal('show');
        },
        openModal(){
            $('#newPost').modal('show');
        },
        excluir(id){
            this.$swal({
                icon: 'question',
                html: '<b>Deseja realmente excluir este post?</b>',
                showDenyButton: true,
                denyButtonText: 'Não',
                confirmButtonText: 'Sim'
            }).then(result => {
                if(result.value){
                    this.$loading.show();

                    axios.delete(`/${id}`)
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
                            if(error.response){
                                let data = error.response.data;
                                this.$swal({
                                    icon: data.type,
                                    title: data.title,
                                    html: data.message,
                                });                        
                            }  
                            
                            console.log(error);
                        });
                }
            })
        }
    }
}
</script>