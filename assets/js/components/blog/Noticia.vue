<template>
    <div class="container mt-5 mb-5">
        <h3 class="text-info">{{ post.titulo }}</h3>
        <small class="d-block">
            <i>{{ post.user.name }}, {{ formatDate(post.data_inclusao) }}</i>
        </small>
        <div class="mt-3 d-block">{{ post.descricao}}</div>

        <form class="mt-5" @submit.prevent="onSubmit()">
            <div class="form-group">
                <label>Deixe seu comentário:</label>
                <textarea class="form-control" rows="5" v-model="comentario" required minlength="10"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Comentar</button>
            </div>
        </form>

        <div v-if="$store.state.comments.length > 0">
            <h6 class="border-top border-bottom mt-5 py-2 text-danger">Comentários</h6>
            <div v-for="item in $store.state.comments" :key="item.id" class="d-block mt-2 border-bottom pb-3">
                <p class="font-weight-bold mb-0">{{ item.user.name }}</p>
                <small class="d-block mb-2">{{ formatDate(item.created_at) }}</small>
                <div class="d-block">
                    {{ item.comment }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['post'],
    data(){
        return{
            comentario: '',
        }
    },
    mounted(){
        this.$store.commit('setComments', this.post.comments);
    },
    methods: {
        formatDate(data){
            let date = new Date(data);
            let options = {day: 'numeric', month: 'long', year: 'numeric'};
            return date.toLocaleDateString('pt-BR', options);
        },
        onSubmit(){
            this.$loading.show();

            axios.post('/comment', {comment: this.comentario, post_id: this.post.id})
                .then(res => {
                    let data = res.data;
                    this.$swal({
                        icon: data.type,
                        title: data.title,
                        html: data.message,
                    });

                    this.comentario = '';
                    this.$store.commit('setComments', data.comments);
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