// import axios from 'axios';
// import PostCreate from './PostCreate.vue';
// import PostEdit from './PostEdit.vue';

export default {
    props: ['posts'],    
    components: {
        // PostCreate,
        // PostEdit
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