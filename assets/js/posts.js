class Posts{
    async insert(post){
        return await axios.post('/route/post-create', post)
    }

    async update(post){
        return await axios.post('/route/post-update/', post)
    }

    async destroy(id){
        return await axios.post('/route/post-destroy/' + id)
    }

    async get(id){
        return await axios.get('/route/post/' + id)
    }
}

export default new Posts();