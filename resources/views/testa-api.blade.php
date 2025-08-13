<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de API</title>
    <!-- Adicione Tailwind CSS para estilização (opcional, mas recomendado para uma boa aparência) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f3f4f6;
        }
        .container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 28rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            margin-bottom: 1.25rem;
            box-sizing: border-box; /* Garante que padding não aumente a largura total */
        }
        .submit-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #4f46e5;
            color: #ffffff;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        .submit-button:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Enviar Dados para API</h1>

        <!-- Formulário para enviar dados para a rota /api/main -->
        <form action="{{ url('/api/main') }}" method="POST">
            <!-- Diretiva CSRF para proteção contra Cross-Site Request Forgery -->
            @csrf

            <div class="mb-4">
                <label for="texto" class="form-label">Texto:</label>
                <input type="text" id="texto" name="texto" class="form-input" placeholder="Digite seu texto aqui" required>
            </div>

            <div class="mb-6">
                <label for="fator" class="form-label">Fator:</label>
                <input type="number" id="fator" name="fator" class="form-input" placeholder="Digite um valor numérico" required>
            </div>

            <button type="submit" class="submit-button">
                Enviar Dados
            </button>
        </form>
    </div>
</body>
</html>