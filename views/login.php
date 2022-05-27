<div>
    <div class="container mt-5">
        <div class="row">
            <div class="offset-lg-4 col-lg-4">
                <div class="card">
                    <div class="card-header bg-light text-center">
                        <h5 class="card-title mb-0">Autenticação</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" name="formLogin" id="formLogin">
                            <div class="form-group">
                                <label class="mb-0">E-mail</label>
                                <input type="email" name="email" class="form-control" placeholder="Digite aqui seu E-mail" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="mb-0">Senha</label>
                                <input type="password" name="password" class="form-control" placeholder="Digite aqui sua Senha" required autocomplete="off">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Lembre-me
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success w-100">Entrar</button>
                                <span class="d-block mt-3 text-center">
                                    Ainda não tem cadastro? <a href="#modalSigIn" data-toggle="modal">Clique aqui</a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include(__DIR__ . '/sigin.php');
?>