<?php $pageTitle = 'Login'; ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body p-5">
                <h3 class="text-center mb-4" style="color: #667eea;">Bem-vindo</h3>

                <form method="POST" action="<?php echo BASE_URL; ?>/auth/login">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </form>

                <hr class="my-4">

                <p class="text-center text-muted mb-0">
                    Não possui conta?
                    <a href="<?php echo BASE_URL; ?>/auth/register"
                        style="color: #667eea; font-weight: bold;">Cadastre-se aqui</a>
                </p>
            </div>
        </div>


    </div>
</div>