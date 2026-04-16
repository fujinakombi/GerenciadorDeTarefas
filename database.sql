-- Estrutura do Banco de Dados - Event Manager
-- MySQL

-- Tabela de Usuários
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de Eventos (CRUD Principal)
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(150) NOT NULL,
    event_date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabela de Tarefas
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Inserir usuário de teste (email: teste@example.com, senha: senha123)
INSERT INTO users (name, email, password) VALUES 
('Usuário Teste', 'teste@example.com', '$2y$10$JkW8c7Zl5dn9pB2qM3rR8.ZcKoT9x5vW4H6sY1aL2eF3gJ4bK5cN');

-- Inserir tarefas de exemplo
INSERT INTO tasks (user_id, title, completed) VALUES 
(1, 'Preparar apresentação do projeto', FALSE),
(1, 'Revisar código do MVC', FALSE),
(1, 'Implementar Design Patterns', FALSE),
(1, 'Testar o sistema', FALSE);

-- Inserir eventos de exemplo
INSERT INTO events (user_id, title, description, location, event_date) VALUES 
(1, 'Conferência de Tecnologia', 'Conferência anual sobre as últimas tendências em tecnologia e desenvolvimento web.', 'São Paulo - SP', '2026-05-15 09:00:00'),
(1, 'Meetup de Programadores', 'Encontro mensal para discussão sobre boas práticas e compartilhamento de conhecimento.', 'Rio de Janeiro - RJ', '2026-04-20 19:00:00');
