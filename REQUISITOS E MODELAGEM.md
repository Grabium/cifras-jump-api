# Requisitos e Modelagem para a API CifrasJump

Este documento detalha os requisitos funcionais e não funcionais, além da modelagem do sistema, para a API CifrasJump.

1. Documento de Requisitos

1.1. Declaração de Visão e Escopo

Visão: Fornecer uma Web API REST simples e eficiente para a transposição de cifras musicais em conteúdos textuais, facilitando o trabalho de músicos e estudantes de música.

Escopo: A API CifrasJump inicialmente oferecerá um único endpoint capaz de receber um texto com cifras musicais e um fator de transposição, retornando o texto com as cifras ajustadas. O foco está na funcionalidade central de transposição e na validação dos dados de entrada. Futuras funcionalidades, como a detecção automática de cifras ou outros métodos de transposição, estão fora do escopo inicial.

1.2. Requisitos Funcionais

    RF1: Endpoint de Transposição:

        O sistema deve expor um único endpoint POST: /api/main.

        Este endpoint deve aceitar requisições POST com um corpo JSON contendo os campos texto e fator.

    RF2: Transposição de Cifras:

        A API deve identificar cifras musicais no campo texto (ex: C, Dm, G7, Bb, F#m).

        A API deve transpor as cifras musicais identificadas de acordo com o valor do campo fator.

        O texto resultante, com as cifras transpostas, deve ser retornado como resposta.

    RF3: Validação do Campo 'texto':

        O campo texto é obrigatório.

        O campo texto deve ser uma string não vazia.

        Se a validação falhar, a API deve retornar um erro apropriado (e.g., código HTTP 422 Unprocessable Entity) com uma mensagem descritiva.

    RF4: Validação do Campo 'fator':

        O campo fator é obrigatório.

        O campo fator deve ser um número inteiro.

        O campo fator deve estar entre -11 e 11 (inclusive).

        Se a validação falhar, a API deve retornar um erro apropriado (e.g., código HTTP 422 Unprocessable Entity) com uma mensagem descritiva.

    RF5: Resposta da API:

        Em caso de sucesso, a API deve retornar um código HTTP 200 (OK) e um JSON contendo o texto transposto.

        Em caso de erro de validação, a API deve retornar um código HTTP 422 (Unprocessable Entity) e um JSON contendo os erros de validação.

        Em caso de erro interno do servidor, a API deve retornar um código HTTP 500 (Internal Server Error) e uma mensagem genérica de erro.

1.3. Requisitos Não Funcionais

    RNF1: Desempenho: A API deve responder a requisições em menos de 200ms para 95% das chamadas, sob carga normal.

    RNF2: Confiabilidade: A API deve ter uma disponibilidade mínima de 99% do tempo.

    RNF3: Escalabilidade: O sistema deve ser capaz de escalar horizontalmente para lidar com o aumento de requisições.

    RNF4: Segurança: As requisições à API devem ser feitas via HTTPS.

    RNF5: Manutenibilidade: O código-fonte deve ser limpo, bem comentado e seguir as melhores práticas de desenvolvimento PHP/Laravel.

    RNF6: Usabilidade (Desenvolvedor): A documentação da API (futuramente com Swagger/OpenAPI) deve ser clara e fácil de entender para desenvolvedores que consumirão o serviço.

2. Modelagem do Sistema

Dada a natureza de micro serviço e o escopo inicial focado em uma única funcionalidade, a modelagem será mais simples, focando nos componentes essenciais.

2.1. Modelo Conceitual (Domínio)

Não há um modelo de dados persistente complexo neste micro serviço, pois ele não armazena informações sobre cifras ou usuários. O conceito central é a Transposição de Cifras.

    Entidades Lógicas:

        RequisicaoTransposicao: Representa a entrada para o endpoint, contendo texto e fator.

        RespostaTransposicao: Representa a saída do endpoint, contendo o texto transposto.

2.2. Modelo de Componentes/Arquitetura

graph TD
    A[Cliente (Navegador/Aplicação)] -- Requisição POST JSON --> B(Nginx/Apache);
    B --> C(Servidor PHP-FPM);
    C --> D(Aplicação Laravel);
    D -- Validação de Dados --> E(Componente de Validação Laravel);
    E -- Dados Válidos --> F(Controlador CifrasJump);
    F -- Processa Transposição --> G(Serviço/Classe de Lógica de Transposição);
    G -- Retorna Texto Transposto --> F;
    F -- Retorna Resposta JSON --> D;
    D --> C;
    C --> B;
    B -- Resposta JSON --> A;

    subgraph "Aplicação Laravel"
        D -- "app/Http/Controllers/MainController.php" --> F
        D -- "app/Services/CipherTransposer.php" --> G
        D -- "app/Http/Requests/TranspositionRequest.php" --> E
    end

Explicação do Modelo de Componentes:

    Cliente: Qualquer aplicação que consuma a API (e.g., um frontend web, aplicativo móvel).

    Servidor Web (Nginx/Apache): Roteia as requisições para a aplicação Laravel.

    Servidor PHP-FPM: Processa as requisições PHP da aplicação Laravel.

    Aplicação Laravel: O framework principal que hospeda a lógica da API.

        Componente de Validação (TranspositionRequest): Classe de Request Form do Laravel responsável por validar os campos texto e fator.

        Controlador (MainController): O ponto de entrada para o endpoint /api/main, que orquestra a validação e chama o serviço de transposição.

        Serviço/Classe de Lógica de Transposição (CipherTransposer): Contém a lógica de negócios para identificar e transpor as cifras musicais no texto. Esta é a inteligência central da API.

2.3. Modelo de Processo (Fluxo de Requisição)

sequenceDiagram
    participant C as Cliente
    participant FW as Firewall/Load Balancer
    participant SW as Servidor Web (Nginx)
    participant PF as PHP-FPM
    participant L as Laravel App
    participant V as Validação (Request)
    participant CTL as Controlador (MainController)
    participant LGT as Lógica de Transposição

    C->>FW: POST /api/main {texto, fator}
    FW->>SW: Rota para /api/main
    SW->>PF: Passa requisição para PHP
    PF->>L: Inicia aplicação Laravel
    L->>V: Valida dados da requisição (texto, fator)
    alt Dados Válidos
        V-->>L: Sucesso na validação
        L->>CTL: Chama método index/process
        CTL->>LGT: Transpor(texto, fator)
        LGT-->>CTL: Retorna texto transposto
        CTL-->>L: Retorna resposta de sucesso
        L->>PF: Prepara resposta HTTP 200 OK
    else Dados Inválidos
        V-->>L: Falha na validação
        L->>PF: Prepara resposta HTTP 422 Unprocessable Entity com erros
    end
    PF-->>SW: Envia resposta HTTP
    SW-->>FW: Envia resposta HTTP
    FW-->>C: Envia resposta HTTP

  Explicação do Fluxo de Requisição:

Este diagrama ilustra o caminho de uma requisição desde o cliente até a resposta da API, incluindo os passos de validação e processamento da lógica de negócios. Ele destaca as principais interações entre os componentes.

<h2>Tipos de acordes que devem ser capturados para a conversão</h2>
<p>Eis a lista contendo apenas o A (lá), mas considere os demais (B, C, D, E, F, G,):</p>
    A (Lá Maior)

    Am (Lá Menor)

    A7 (Lá Dominante com Sétima)

    Amaj7 (Lá Maior com Sétima Maior)

    AmMaj7 (Lá Menor com Sétima Maior)

    Am7 (Lá Menor com Sétima Menor)

    Asus4 (Lá Suspenso com Quarta)

    Asus2 (Lá Suspenso com Segunda)

    Aadd9 (Lá Maior com Nona Adicionada)

    Amadd9 (Lá Menor com Nona Adicionada)

    A6 (Lá Maior com Sexta)

    Am6 (Lá Menor com Sexta)

    Adim (Lá Diminuto)

    Adim7 (Lá Diminuto evidenciando a Sétima Diminuta)

    Aø (Lá Meio Diminuto)

    Aaug (Lá Aumentado)

    A+ (Lá Aumentado - Notação alternativa)

    A7b5 (Lá Dominante com Sétima e Quinta Diminuta)

    A7#5 (Lá Dominante com Sétima e Quinta Aumentada)

    A7b9 (Lá Dominante com Sétima e Nona Menor)

    A7#9 (Lá Dominante com Sétima e Nona Aumentada)

    A9 (Lá Dominante com Nona)

    Amaj9 (Lá Maior com Nona Maior)

    Am9 (Lá Menor com Nona Menor)

    A11 (Lá Dominante com Décima Primeira)

    Amaj11 (Lá Maior com Décima Primeira Maior)

    Am11 (Lá Menor com Décima Primeira Menor)

    A13 (Lá Dominante com Décima Terceira)

    Amaj13 (Lá Maior com Décima Terceira Maior)

    Am13 (Lá Menor com Décima Terceira Menor)

    Aalt (Lá Alterado - frequentemente para acordes dominantes com tensões alteradas, como b9, #9, b5, #5)

    A7sus4 (Lá Dominante com Sétima e Suspenso com Quarta)

    A/C# (Lá Maior com C# no baixo - inversão)

    Am/G (Lá Menor com G no baixo - inversão)

    Am7b5 (Lá meio diminuto com Sétima)

    A5(9) (Lá com a Nona maior e um destaque na quinta)
     
    A5(7M/9)  (Lá com a Sétima maior, Nona maior e um destaque na quinta)
    
Conclusão

Este documento fornece uma base sólida para o desenvolvimento da API CifrasJump. Ele define claramente o que o sistema deve fazer (requisitos) e como ele será estruturado e processará as requisições (modelagem). A simplicidade do design reflete o escopo inicial do micro serviço, mas a arquitetura em camadas (controlador, serviço de lógica) permite uma futura expansão sem grandes refatores.
