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

    validadePassword(){
        let password = document.getElementById('password');
        let confirm = document.getElementById('confirm');

        if(password.value !== confirm.value){
            confirm.setCustomValidity('Senhas não correspondem.');
            return false;
        }else{
            confirm.setCustomValidity('');
            return true;
        }
    }    

}

export default new User();