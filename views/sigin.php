<div class="modal fade" id="modalSigIn" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary d-flex justify-content-center align-items-center">
                <h5 class="modal-title text-white">Cadastre-se</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="formSigin" id="formSigin">
                    <div class="form-group">
                        <label class="mb-0">Nome</label>
                        <input type="text" class="form-control" name="nome" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="mb-0">E-mail</label>
                        <input type="email" class="form-control" name="email" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label class="mb-0">Senha</label>
                        <input type="password" class="form-control" name="password" required autocomplete="off" minlength="6">
                    </div>
                    <div class="form-group">
                        <label class="mb-0">Confirme a Senha</label>
                        <input type="password" class="form-control" name="confirm" required autocomplete="off" minlength="6" id="confirm">
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" form="formSigin" class="btn btn-success">Cadastrar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fehar</button>
            </div>
        </div>
    </div>
</div>