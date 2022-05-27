const { createStore  } = Vuex;

const store = createStore({
    state(){
        return{
            posts: [],
            post: {},
            comments: []
        }
    },
    mutations: {
        setPosts(state, obj){
            state.posts = obj;
        },
        setPost(state, obj){
            state.post = obj;
        },
        setComments(state, obj){
            state.comments = obj;
        }
    }
});

export default store;