class User{
    
    async login(user){
        return await axios.post('/route/login', user);  
    }

    insert(user){
        axios.post('/route/sigin', user)
            .then(res => {
                let data = res.data;

                Swal.fire({
                    icon: data.type,
                    title: data.title,
                    html: data.message
                });
            })
            .catch(error => {
                console.log(error);
            });
    }

}

export default new User();