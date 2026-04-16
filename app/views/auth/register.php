<?php $pageTitle = 'Cadastro'; ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body p-5">
                <h3 class="text-center mb-4" style="color: #667eea;">Criar Conta</h3>

                <form method="POST" action="<?php echo BASE_URL; ?>/auth/storeRegister">
                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="form-text text-muted">Mínimo de 6 caracteres</small>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                </form>

                <hr class="my-4">

                <p class="text-center text-muted mb-0">
                    Já possui conta? 
                    <a href="<?php echo BASE_URL; ?>" style="color: #667eea; font-weight: bold;">Faça login aqui</a>
                </p>
            </div>
        </div>
    </div>
</div>
