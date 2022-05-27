<div class="modal fade" id="editPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                <h5 class="modal-title text-white">{{ form.titulo }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="formEditPost" id="formEditPost">
                    <div class="form-group">
                        <label class="mb-0">Título</label>
                        <input type="text" class="form-control" name="nome" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="mb-0">Descrição</label>
                        <textarea class="form-control" name="email" required rows="10">
                            </textarea>
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