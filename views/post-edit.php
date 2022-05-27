<div class="modal fade" id="editPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                <h5 class="modal-title text-white"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="formEditPost" id="formEditPost">
                    <div class="form-group">
                        <label class="mb-0">Título</label>
                        <input type="text" class="form-control" name="titulo" required autocomplete="off">
                        <input type="hidden" name="post_id" value="">
                    </div>
                    <div class="form-group">
                        <label class="mb-0">Descrição</label>
                        <textarea class="form-control" name="descricao" name="email" required rows="10"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" form="formEditPost" class="btn btn-success">Atualiar Post</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fehar</button>
            </div>
        </div>
    </div>
</div>