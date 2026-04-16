<?php $pageTitle = 'Dashboard'; ?>

<h2 style="color: white; margin-bottom: 30px;">📋 Meu Dashboard</h2>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between align-items-center">
                    Tarefas Pendentes
                    <span class="badge badge-primary"><?php echo count($tasks); ?></span>
                </h5>
                <p class="card-text text-muted">Tarefas que ainda precisam ser concluídas</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-flex justify-content-between align-items-center">
                    Total de Eventos
                    <span class="badge badge-primary"><?php echo $totalEvents; ?></span>
                </h5>
                <p class="card-text text-muted">Eventos que você criou</p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Atalhos</h5>
                <a href="<?php echo BASE_URL; ?>/event/create" class="btn btn-sm btn-primary">
                    ➕ Novo Evento
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card" style="margin-bottom: 30px;">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="mb-0">✅ Tarefas Pendentes</h5>
            </div>
            <div class="card-body">
                <!-- Formulário para adicionar tarefa -->
                <form method="POST" action="<?php echo BASE_URL; ?>/dashboard/addTask" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="title" placeholder="Adicione uma nova tarefa..." required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Adicionar</button>
                        </div>
                    </div>
                </form>

                <!-- Lista de Tarefas -->
                <?php if (!empty($tasks)): ?>
                    <?php foreach ($tasks as $task): ?>
                        <div class="task-item">
                            <div>
                                <p class="task-title"><?php echo htmlspecialchars($task['title']); ?></p>
                                <small class="text-muted">
                                    Criada em: <?php echo date('d/m/Y', strtotime($task['created_at'])); ?>
                                </small>
                            </div>
                            <div>
                                <a href="<?php echo BASE_URL; ?>/dashboard/completeTask/<?php echo $task['id']; ?>" 
                                   class="btn btn-sm btn-success" title="Marcar como concluída">
                                    ✓
                                </a>
                                <a href="<?php echo BASE_URL; ?>/dashboard/deleteTask/<?php echo $task['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Tem certeza que deseja deletar?');" title="Deletar">
                                    ✕
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        Nenhuma tarefa pendente! Aproveite para descansar ou criar uma nova.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="mb-0">Tarefas Concluídas</h5>
            </div>
            <div class="card-body">
                <?php 
                $completedTasks = array_filter($allTasks, function($task) {
                    return $task['completed'] == 1;
                });
                ?>

                <?php if (!empty($completedTasks)): ?>
                    <p class="text-center mb-3">
                        <span class="badge badge-success">
                            <?php echo count($completedTasks); ?> Concluídas
                        </span>
                    </p>
                    <div style="max-height: 300px; overflow-y: auto;">
                        <?php foreach ($completedTasks as $task): ?>
                            <div class="task-item completed">
                                <p class="task-title"><?php echo htmlspecialchars($task['title']); ?></p>
                                <a href="<?php echo BASE_URL; ?>/dashboard/incompleteTask/<?php echo $task['id']; ?>" 
                                   class="btn btn-sm btn-warning" 
                                   title="Marcar como não concluída">
                                    ↩
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center">Nenhuma tarefa concluída ainda</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
