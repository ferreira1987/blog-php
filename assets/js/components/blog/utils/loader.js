class Plugin {
    install(Vue){
        this.injectCSS();

        Vue.mixin({
            beforeCreate() {
                this.$loading = new LoadingOverlay(this);
            }
        });
    }
    injectCSS(){
        let node = document.createElement('style');
        node.innerHTML = `
            .swal2-loading-overlay.swal2-popup{
                width: auto; height: auto;
                padding: 0px !important;
            }
            .swal2-loading-overlay .swal2-popup{
                padding: 0px !important;
            }
            .swal2-loading-overlay .swal2-html-container{
                margin: 0px !important;
                padding: 15px 20px;
            }
        `.trim();
        document.body.appendChild(node);
    }    
}

let _vue;

function checkRequirements(vue){
    if(!vue.$swal)
        throw new Error('vue-sweetalert2 is required for swal2-loading-overlay to work and was not found.');
}

class LoadingOverlay {
    constructor(Vue){
        _vue = Vue;
    }

    show(){
        checkRequirements(_vue);
        _vue.$swal({
            customClass: 'swal2-loading-overlay',
            backdrop: 'rgba(0, 0, 0, 0.5)',
            showConfirmButton: false,
            animation: true,
            onOpen: _vue.$swal.showLoading,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            html: ` <span class="d-flex justify-content-center align-items-center">
                        <span class="spinner-border spinner-border-md mr-2" role="status" aria-hidden="true"></span>
                        <span>Aguarde...</span>
                    </span> `
        });
    }

    hide(){
        checkRequirements(_vue);
        _vue.$swal.close();
    }
}

export default new Plugin();