# Acelerai: Sistema de Rally

Bem-vindo ao **Acelerai**, um sistema de gerenciamento de corridas de rally. Este projeto foi desenvolvido para facilitar a organização e participação em corridas de rally, permitindo o cadastro de usuários, veículos, corridas e a visualização de resultados.

---

## 🎥 Demonstração

Confira abaixo uma [**demonstração**](https://ibb.co/1R4g3Cn) do projeto em execução.

![Demonstração do Projeto](https://i.ibb.co/1R4g3Cn/demo.gif)

---

## 📋 Funcionalidades

- CRUD e validação de usuários.
- CRUD de veículos.
- CRUD de corridas.
- Participação de veículos em corridas.
- Visualização de resultados e rankings.

---

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel, PHP
- **Banco de Dados**: PostgreSQL
- **Frontend**: Tailwind CSS e Blade 
- **Mapas**: Leaflet
- **Contêinerização**: Docker, Docker Compose

---

## 🔧 Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas em seu ambiente:

- **Docker**

---

## 🚀 Como Rodar o Projeto

### 1️⃣ Clonar o Repositório

```bash
git clone https://github.com/Guto06/acelerai.git
cd acelerai
```

### 2️⃣ Configurar o Ambiente

Copie o arquivo `.env.example` para `.env` e ajuste as configurações conforme necessário:

```bash
cp .env.example .env
```

### 3️⃣ Subir os Contêineres Docker

```bash
docker compose up -d
```

### 4️⃣ Acessar o Contêiner

Entre no contêiner Laravel:

```bash
docker exec -it laravel-acelerai /bin/bash
```

### 5️⃣ Configurar Permissões

```bash
chown -R www-data:www-data /var/www/html/storage
```

### 6️⃣ Instalar Dependências

Dentro do contêiner, execute:

```bash
composer install
npm install
```

### 7️⃣ Executar Migrações e Seeders

```bash
php artisan migrate
php artisan db:seed --class=CustomSeeder
php artisan db:seed --class=UserSeeder
```

### 8️⃣ Compilar os Assets

```bash
npm run build
```

### 9️⃣ Acessar a Aplicação

A aplicação estará disponível em [http://localhost:8000](http://localhost:8000) por padrão.

---

## 🤝 Contribuição

Se você deseja contribuir com o projeto, sinta-se à vontade para abrir **issues** e enviar **pull requests**. Toda contribuição é bem-vinda!

---

## 📜 Licença

Este projeto está licenciado sob a licença **MIT**. Consulte o arquivo `LICENSE` para mais detalhes.
