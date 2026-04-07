<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $cpf = trim($_POST["cpf"]);
        $nome = trim($_POST["nome"]);
        $email = trim($_POST["email"]);
        $senha = $_POST["senha"];
        $confirmar = $_POST["confirmar"];
        $perfil = $_POST["perfil"];
        $termos = isset($_POST["termos"]);

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FARMI - Cadastro do Usuário</title>

    <!--Ícone do site-->
    <link rel="icon" href="../images/about.png" type="image/png" />

    <!-- Fonte Roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Mesmo CSS do login -->
    <link rel="stylesheet" href="login.css">

    <!-- Biblioteca para aparecer a setinha -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

    <!-- ESQUERDA -->
    <div class="left">
        <div class="logo-left">
            <img src="../images/logo_FARMI.png">
        </div>
    </div>

    <!-- DIREITA -->
    <div class="right">
        <div class="login-box">
            <h2>Cadastro do Usuário</h2>


            <form id="formCadastro" method="POST" action="">
                
                <label class="campo">CPF:</label>
                <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00"><br>

                <label class="campo">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Nome completo"><br>

                <label class="campo">E-mail:</label>
                <input type="email" name="email" id="email" placeholder="nome@email.com"><br>

                <label class="campo">Senha:</label>
                <div class="input-icone">
                    <input type="password" name="senha" id="senha" placeholder="********">
                    <i class="fa-solid fa-eye" id="toggleSenha"></i>
                </div>

                <label class="campo">Confirmar senha:</label>
                <div class="input-icone">
                    <input type="password" name="confirmar" id="confirmar" placeholder="********">
                    <i class="fa-solid fa-eye" id="toggleConfirmar"></i>
                </div>

                <div class="campo-select">
                    <label>Tipo de perfil:</label>
                    <select name="perfil" id="perfil">
                        <option value="">--Selecione--</option>
                        <option value="usuario">Usuário</option>
                        <option value="admin">Admin</option>
                    </select><br>
                </div>

                <div class="termos">
                    <label class="checkbox-container">
                        <input type="checkbox" id="termos" name="termos"> Aceito os termos de uso
                        <span class="checkmark"></span>
                    </label><br>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>

                <div class="back">
                    <a href="../home.html">
                        <i class="fas fa-arrow-left"></i> Voltar a Tela Inicial
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- <script src="cadastro.js"></script> -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formCadastro');
        const cpfInput = document.getElementById('cpf');

        // Máscara de CPF
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            e.target.value = value;
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let isValid = true;

            // Limpa bordas
            document.querySelectorAll('input, select').forEach(el => {
                el.style.border = '';
            });

            // ===== CPF =====
            const cpf = document.getElementById('cpf');
            if (cpf.value.trim() === '' || !validarCPF(cpf.value)) {
                cpf.style.border = '2px solid red';
                isValid = false;
            } else {
                cpf.style.border = '2px solid green';
            }

            // ===== NOME =====
            const nome = document.getElementById('nome');
            if (nome.value.trim() === '' || nome.value.length < 3) {
                nome.style.border = '2px solid red';
                isValid = false;
            } else {
                nome.style.border = '2px solid green';
            }

            // ===== EMAIL =====
            const email = document.getElementById('email');
            if (email.value.trim() === '' || !validarEmail(email.value)) {
                email.style.border = '2px solid red';
                isValid = false;
            } else {
                email.style.border = '2px solid green';
            }

            // ===== SENHA =====
            const senha = document.getElementById('senha');
            if (senha.value === '' || senha.value.length < 8) {
                senha.style.border = '2px solid red';
                isValid = false;
            } else {
                senha.style.border = '2px solid green';
            }

            // ===== CONFIRMAR =====
            const confirmar = document.getElementById('confirmar');
            if (confirmar.value === '' || confirmar.value !== senha.value) {
                confirmar.style.border = '2px solid red';
                isValid = false;
            } else {
                confirmar.style.border = '2px solid green';
            }

            // ===== PERFIL =====
            const perfil = document.getElementById('perfil');
            if (perfil.value === '') {
                perfil.style.border = '2px solid red';
                isValid = false;
            } else {
                perfil.style.border = '2px solid green';
            }

            // ===== TERMOS =====
            const termos = document.getElementById('termos');
            if (!termos.checked) {
                alert('Você deve aceitar os termos de uso.');
                isValid = false;
            }

            // ===== ENVIO =====
            if (isValid) {
                cpf.value = cpf.value.replace(/\D/g, '');
                form.submit();
            }
        });
    });

    // VALIDAR CPF
    function validarCPF(cpf) {
        cpf = cpf.replace(/\D/g, '');
        if (cpf.length !== 11) return false;
        if (/^(\d)\1{10}$/.test(cpf)) return false;

        let sum = 0;
        for (let i = 0; i < 9; i++) {
            sum += parseInt(cpf[i]) * (10 - i);
        }
        let remainder = (sum * 10) % 11;
        if (remainder === 10) remainder = 0;
        if (remainder !== parseInt(cpf[9])) return false;

        sum = 0;
        for (let i = 0; i < 10; i++) {
            sum += parseInt(cpf[i]) * (11 - i);
        }
        remainder = (sum * 10) % 11;
        if (remainder === 10) remainder = 0;
        if (remainder !== parseInt(cpf[10])) return false;

        return true;
    }

    // VALIDAR EMAIL
    function validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // ===== OLHO SENHA =====
    const toggleSenha = document.getElementById('toggleSenha');
    const senhaInput = document.getElementById('senha');

    toggleSenha.addEventListener('click', function () {
        const tipo = senhaInput.type === 'password' ? 'text' : 'password';
        senhaInput.type = tipo;

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // ===== OLHO CONFIRMAR =====
    const toggleConfirmar = document.getElementById('toggleConfirmar');
    const confirmarInput = document.getElementById('confirmar');

    toggleConfirmar.addEventListener('click', function () {
        const tipo = confirmarInput.type === 'password' ? 'text' : 'password';
        confirmarInput.type = tipo;

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    </script>
</body>
</html>