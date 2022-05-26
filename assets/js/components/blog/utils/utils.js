class Plugin{
    install(Vue){
        Vue.mixin({
            beforeCrate(){
                this.$utils = new Utils();
            }
        });
    }
}

class Utils{

    resetForm(form){
        Object.keys(form).forEach(key => {
            form[key] = '';
        });
    }
}

export default new Plugin();