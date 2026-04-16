<?php $pageTitle = 'Meus Eventos'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color: white;">📅 Meus Eventos</h2>
    <a href="<?php echo BASE_URL; ?>/event/create" class="btn btn-light">
        ➕ Novo Evento
    </a>
</div>

<?php if (!empty($events)): ?>
    <div class="row">
        <?php foreach ($events as $event): ?>
            <div class="col-md-6 mb-4">
                <div class="card event-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                        
                        <p class="card-text">
                            <?php echo htmlspecialchars(substr($event['description'], 0, 100)); ?>
                            <?php if (strlen($event['description']) > 100): ?>...<?php endif; ?>
                        </p>

                        <div class="mb-3">
                            <span class="badge badge-info">
                                📍 <?php echo htmlspecialchars($event['location']); ?>
                            </span>
                        </div>

                        <div class="mb-3">
                            <p class="event-date">
                                📅 <?php echo date('d/m/Y H:i', strtotime($event['event_date'])); ?>
                            </p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="<?php echo BASE_URL; ?>/event/edit/<?php echo $event['id']; ?>" 
                               class="btn btn-sm btn-primary">
                                ✏️ Editar
                            </a>
                            <a href="<?php echo BASE_URL; ?>/event/delete/<?php echo $event['id']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Tem certeza que deseja deletar este evento?');">
                                🗑️ Deletar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <h5 class="text-muted">Nenhum evento criado ainda</h5>
            <p class="text-muted mb-3">Comece criando seu primeiro evento!</p>
            <a href="<?php echo BASE_URL; ?>/event/create" class="btn btn-primary">
                ➕ Criar Primeiro Evento
            </a>
        </div>
    </div>
<?php endif; ?>
