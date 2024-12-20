<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AzzO</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #007BFF;
    color: white;
}
header, .horizontal-sidebar {
    transition: transform 0.3s ease-in-out;
}

header.hidden, .horizontal-sidebar.hidden {
    transform: translateY(-100%);
}

.search-bar input {
    padding: 10px;
    border: none;
    border-radius: 5px;
}

.auth-buttons button, .mode-toggle button {
    margin-left: 10px;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
/* Sessão de Cursos */
.courses {
    padding: 20px;
    background-color: #f9f9f9;
}

.courses h2 {
    text-align: center;
    margin-bottom: 20px;
}

.course-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Espaçamento entre os itens */
    justify-content: center;
}

.course-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    width: calc(33.333% - 40px); /* Três itens por linha com espaçamento */
    box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
    text-align: center;
    box-sizing: border-box;
}

.course-item img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
}

.course-item h3 {
    margin: 15px 0 10px;
    font-size: 18px;
}

.course-item p {
    color: #666;
    margin-bottom: 15px;
}

.course-item button {
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    cursor: pointer;
}

.course-item button:hover {
    background-color: #0056b3;
}

footer {
    padding: 20px;
    text-align: center;
    background-color: #f1f1f1;
}

.dark-mode {
    background-color: #333;
    color: white;
}
.dark-mode h2 {
    color: #111;
}
.dark-mode label {
    color: #111;
}

.dark-mode header {
    background-color: #222;
}

.dark-mode footer {
    background-color: #111;
}

.dark-mode .course-item {
    background-color: #444;
    color: white;
    border-color: #555;
}

/* Modal */
.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: white;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; 
    max-width: 400px;
    border-radius: 5px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover, .close:focus {
    color: black;
}

.modal-content form {
    display: flex;
    flex-direction: column;
}

.modal-content form label {
    margin-top: 10px;
}

.modal-content form input {
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.modal-content form button {
    margin-top: 20px;
    padding: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
/* Sidebar Horizontal */
/* Sidebar Horizontal */
.horizontal-sidebar {
    background-color: #f1f1f1;
    padding: 10px 20px;
    box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
    width: 100%;
    position: relative;
    top: 0;
    left: 0;
}

.horizontal-sidebar ul {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
    justify-content: center;
}

.horizontal-sidebar ul li {
    margin: 0 10px;
}

.horizontal-sidebar ul li a {
    text-decoration: none;
    color: #333;
    font-size: 18px;
}

.horizontal-sidebar ul li a:hover {
    color: #007BFF;
}

/* Dropdown dentro da sidebar */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: #333;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dark-mode {
    background-color: #333;
    color: white;
}

.dark-mode header {
    background-color: #222;
}

.dark-mode footer {
    background-color: #111;
}

.dark-mode .course-item {
    background-color: #444;
    color: white;
    border-color: #555;
}
    </style>
</head>
<body class="light-mode">
    <!-- Header -->
    <header>
        <div class="search-bar">
            <input type="text" placeholder="Pesquisar Conhecimento...">
        </div>
        <img src="logo alternativa.png" id="alternativo">
        <div class="auth-buttons">
            <button id="login-btn">Entrar</button>
            <button id="register-btn">Cadastrar-se</button>
        </div>
        <div class="mode-toggle">
            <button id="mode-switch">Dark mode</button>
        </div>
    </header>

    <!-- Modal de Cadastro -->
    <div id="register-modal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-register">&times;</span>
            <h2>Cadastro</h2>
            <form id="register-form">
                <label for="register-name">Nome:</label>
                <input type="text" id="register-name" name="name" required>
                
                <label for="register-email">E-mail:</label>
                <input type="email" id="register-email" name="email" required>
                
                <label for="register-password">Senha:</label>
                <input type="password" id="register-password" name="password" required>
                
                <button type="submit">Cadastrar-se</button>
            </form>
        </div>
    </div>

    <!-- Modal de Login -->
    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-login">&times;</span>
            <h2>Entrar</h2>
            <form id="login-form">
                <label for="login-email">E-mail:</label>
                <input type="email" id="login-email" name="email" required>
                
                <label for="login-password">Senha:</label>
                <input type="password" id="login-password" name="password" required>
                
                <button type="submit">Entrar</button>
            </form>
        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 AzzO. Todos os direitos reservados.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>