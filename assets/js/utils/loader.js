class LoadingOverlay {
    show(){
        Swal.fire({
            customClass: 'swal2-loading-overlay',
            backdrop: 'rgba(0, 0, 0, 0.5)',
            showConfirmButton: false,
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
        Swal.close();
    }
}

export default new LoadingOverlay();