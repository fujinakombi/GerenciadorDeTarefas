<?php $pageTitle = 'Editar Evento'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px 15px 0 0;">
                <h5 class="mb-0">✏️ Editar Evento</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?php echo BASE_URL; ?>/event/update/<?php echo $event['id']; ?>">
                    <div class="form-group">
                        <label for="title">Título do Evento *</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?php echo htmlspecialchars($event['title']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Descrição *</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="location">Local *</label>
                            <input type="text" class="form-control" id="location" name="location" 
                                   value="<?php echo htmlspecialchars($event['location']); ?>" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="event_date">Data e Hora *</label>
                            <input type="datetime-local" class="form-control" id="event_date" name="event_date" 
                                   value="<?php echo date('Y-m-d\TH:i', strtotime($event['event_date'])); ?>" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            💾 Salvar Alterações
                        </button>
                        <a href="<?php echo BASE_URL; ?>/event" class="btn btn-secondary">
                            ← Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
