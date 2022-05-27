class Comments{
    async insert(comment){
        return await axios.post('/route/comment-create', comment)
    }
}

export default new Comments();