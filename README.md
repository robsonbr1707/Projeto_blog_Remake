# Projeto_blog_Remake
Laravel/Vite/Inertia/Vue

# Primeiro passo: Fazer configuração do ambiente
<p>Lembre-se de configurar seu banco em .env</p>

    composer install
    npm install
    php artisan migrate
    php artisan db:seed
    php artisan key:generate

# Segundo passo: Iniciar o servidor

    php artisan serve
    npm run dev

# Criamos uma seed para criar a conta Admin, então vamos usar.

    http://127.0.0.1:8000/login

    Login: admin@admin.com
    Senha: admin123

# Faça alguns posts, notícias, registros e comentarios para testar o projeto!
