<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReqSender</title>
    <!-- Adicione Tailwind CSS para estilização -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alinha no topo para que ambos os forms fiquem visíveis */
            min-height: 100vh;
            background-color: #f3f4f6;
            padding: 2rem;
            box-sizing: border-box;
        }
        .main-wrapper {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            width: 100%;
            max-width: 60rem; /* Aumenta a largura máxima para acomodar ambos */
        }
        .form-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
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
            box-sizing: border-box;
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
        .action-button {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            border: none;
            color: #ffffff;
        }
        .action-button-primary {
            background-color: #10b981; /* green-500 */
        }
        .action-button-primary:hover {
            background-color: #059669; /* green-600 */
        }
        .action-button-danger {
            background-color: #ef4444; /* red-500 */
        }
        .action-button-danger:hover {
            background-color: #dc2626; /* red-600 */
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <!-- Formulário de Configuração -->
        <div class="form-container">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Configurar Formulário Principal</h2>
            <form id="configForm" class="mb-4">
                <div class="mb-4">
                    <label for="configUrl" class="form-label">URL da Requisição:</label>
                    <input type="text" id="configUrl" class="form-input" value="/api/main">
                </div>
                <div class="mb-4">
                    <label for="configMethod" class="form-label">Método HTTP:</label>
                    <select id="configMethod" class="form-input">
                        <option value="POST">POST</option>
                        <option value="GET">GET</option>
                        <option value="PUT">PUT</option>
                        <option value="PATCH">PATCH</option>
                        <option value="DELETE">DELETE</option>
                    </select>
                </div>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <button type="button" id="addFieldBtn" class="action-button action-button-primary">
                        Adicionar Campo
                    </button>
                    <button type="button" id="delFieldBtn" class="action-button action-button-danger">
                        Deletar Último Campo Vazio
                    </button>
                </div>
            </form>
        </div>

        <hr class="border-gray-300">

        <!-- Formulário Principal da API -->
        <div class="form-container">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Formulário Principal (API)</h1>
            <form id="mainForm" action="/api/main" method="POST">
                <!-- Este div conterá o CSRF e o spoofing de método (_method) -->
                <div id="hiddenMethodFields">
                    <!-- @csrf é adicionado dinamicamente via JS -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>

                <!-- Campos dinâmicos serão inseridos aqui -->
                <div id="dynamicFieldsContainer">
                    <!-- Campos de texto e fator não iniciam aqui agora -->
                </div>

                <button type="submit" class="submit-button mt-6">
                    Enviar Dados
                </button>
            </form>
        </div>
    </div>

    <!-- Inclui jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Token CSRF inicial do Laravel
            const csrfToken = "{{ csrf_token() }}";

            // Função para atualizar os campos ocultos do formulário principal (CSRF e _method)
            function updateHiddenFields() {
                const selectedMethod = $('#configMethod').val();
                const $hiddenFieldsDiv = $('#hiddenMethodFields');
                $hiddenFieldsDiv.empty(); // Limpa os campos ocultos existentes

                // Adiciona o token CSRF para métodos que requerem corpo (exceto GET)
                if (selectedMethod !== 'GET') {
                    $hiddenFieldsDiv.append(`<input type="hidden" name="_token" value="${csrfToken}">`);
                }

                // Adiciona o campo _method para spoofing de PUT, PATCH, DELETE
                if (selectedMethod !== 'POST' && selectedMethod !== 'GET') {
                    $hiddenFieldsDiv.append(`<input type="hidden" name="_method" value="${selectedMethod}">`);
                    // Para estes métodos, o formulário HTML ainda precisa ser POST
                    $('#mainForm').attr('method', 'POST');
                } else {
                    // Para GET e POST, o formulário HTML pode usar o método real
                    $('#mainForm').attr('method', selectedMethod);
                }
            }

            // Função para controlar a visibilidade dos campos dinâmicos
            function toggleDynamicFieldsVisibility() {
                const selectedMethod = $('#configMethod').val();
                if (selectedMethod === 'GET' || selectedMethod === 'DELETE') {
                    $('#dynamicFieldsContainer').hide();
                } else {
                    $('#dynamicFieldsContainer').show();
                }
            }

            // 1. Lógica para o campo 'URL'
            $('#configUrl').on('input', function() {
                $('#mainForm').attr('action', $(this).val());
            });

            // 2. Lógica para o campo 'Method'
            $('#configMethod').on('change', function() {
                updateHiddenFields();
                toggleDynamicFieldsVisibility();
            });

            // 3. Lógica para o botão 'Add Field'
            $('#addFieldBtn').on('click', function() {
                let fieldName = prompt("Por favor, digite o nome do novo campo:");
                if (fieldName) {
                    // Remove caracteres inválidos para nomes de campo HTML e IDs
                    fieldName = fieldName.replace(/[^a-zA-Z0-9_]/g, '');
                    if (fieldName === '') {
                        alert("Nome do campo inválido. Por favor, insira um nome válido (apenas letras, números e underscores).");
                        return;
                    }

                    // Verifica se o campo já existe para evitar duplicatas
                    if ($(`#field-group-${fieldName}`).length > 0) {
                        alert(`Um campo com o nome '${fieldName}' já existe.`);
                        return;
                    }

                    const newFieldHtml = `
                        <div class="mb-4 field-group" id="field-group-${fieldName}">
                            <label for="${fieldName}" class="form-label">${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)}:</label>
                            <input type="text" id="${fieldName}" name="${fieldName}" class="form-input">
                        </div>
                    `;
                    $('#dynamicFieldsContainer').append(newFieldHtml);
                }
            });

            // 4. Lógica para o botão 'Del Field'
            $('#delFieldBtn').on('click', function() {
                // Encontra o último grupo de campo que contém um input vazio
                const $lastEmptyFieldGroup = $('#dynamicFieldsContainer .field-group').filter(function() {
                    return $(this).find('input[type="text"]').val() === '';
                }).last();

                if ($lastEmptyFieldGroup.length > 0) {
                    $lastEmptyFieldGroup.remove();
                } else {
                    if ($('#dynamicFieldsContainer .field-group').length === 0) {
                        alert("Não há campos para deletar.");
                    } else {
                        alert("Não há campos vazios para deletar. Por favor, esvazie o campo que deseja remover.");
                    }
                }
            });

            // O formulário de configuração não deve recarregar a página
            $('#configForm').on('submit', function(e) {
                e.preventDefault();
            });

            // Inicializa o formulário principal:
            // - Limpa quaisquer campos iniciais (texto, fator)
            // - Configura a visibilidade dos campos com base no método inicial (POST)
            // - Configura os campos ocultos iniciais (CSRF)
            $('#dynamicFieldsContainer').empty();
            updateHiddenFields(); // Chama para garantir que o _token esteja presente no início
            toggleDynamicFieldsVisibility(); // Garante que os campos estejam visíveis se o método padrão for POST
        });
    </script>
</body>
</html>
