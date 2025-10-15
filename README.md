# Sistema de Cadastro de Produtos - Demonstração SRP

Sistema simples de cadastro e listagem de produtos desenvolvido em PHP, demonstrando a aplicação do princípio de Responsabilidade Única (Single Responsibility Principle - SRP) do SOLID.

## Estrutura do Projeto

\`\`\`
.
├── public/
│   ├── index.php       # Página inicial com formulário de cadastro
│   ├── create.php      # Processa o cadastro de produtos
│   └── products.php    # Lista produtos cadastrados
├── src/
│   ├── Application/
│   │   └── ProductService.php          # Serviço de aplicação
│   ├── Contracts/
│   │   ├── ProductRepository.php       # Interface do repositório
│   │   └── ProductValidator.php        # Interface do validador
│   ├── Domain/
│   │   ├── Product.php                 # Entidade de domínio
│   │   └── SimpleProductValidator.php  # Implementação da validação
│   └── Infra/
│       └── FileProductRepository.php   # Persistência em arquivo
├── storage/
│   └── products.txt    # Arquivo de armazenamento
└── composer.json
\`\`\`

## Requisitos

- PHP 8.0 ou superior
- Composer

## Instalação

1. Clone ou extraia o projeto:
\`\`\`bash
cd solid-srp-demo
\`\`\`

2. Instale as dependências via Composer:
\`\`\`bash
composer install
\`\`\`

3. Certifique-se de que o diretório `storage/` tem permissões de escrita:
\`\`\`bash
chmod 755 storage/
\`\`\`

## Execução

### Usando o servidor embutido do PHP

1. Inicie o servidor na pasta `public/`:
\`\`\`bash
php -S localhost:8000 -t public/
\`\`\`

2. Acesse no navegador:
\`\`\`
http://localhost:8000
\`\`\`

### Usando outro servidor web

Configure o document root para apontar para a pasta `public/`.

## Casos de Teste Manuais

### Teste 1: Cadastro Válido

**Objetivo:** Verificar que um produto válido é cadastrado com sucesso.

**Passos:**
Preencha o formulário:
   - Nome: `Notebook Dell`
   - Preço: `2500.00`
Clique em "Cadastrar"

**Resultado Esperado:**
- Redirecionamento para a página de listagem
- Produto aparece na tabela com ID, nome "Notebook Dell" e preço "R$ 2.500,00"

---

### Teste 2: Cadastro Inválido - Nome Curto

**Objetivo:** Verificar validação de nome com menos de 2 caracteres.

**Passos:**
Preencha o formulário:
   - Nome: `A`
   - Preço: `100.00`
Clique em "Cadastrar"

**Resultado Esperado:**
- Página de erro exibida com o título "Erro ao cadastrar produto"
- Mensagem de validação: "Nome inválido (precisa ter entre 2 e 100 caracteres)."

---

### Teste 3: Cadastro Inválido - Preço Negativo

**Objetivo:** Verificar validação de preço negativo.

**Passos:**
Preencha o formulário:
   - Nome: `Produto Teste`
   - Preço: `-50.00`
Clique em "Cadastrar"

**Resultado Esperado:**
- Página de erro exibida com o título "Erro ao cadastrar produto"
- Mensagem de validação: "Preço inválido (precisa ser numérico e >= 0)."

---

### Teste 4: Listagem Vazia

**Objetivo:** Verificar comportamento quando não há produtos cadastrados.

**Passos:**
Certifique-se de que o arquivo `storage/products.txt` está vazio ou não existe

**Resultado Esperado:**
- Página exibe o título "Produtos Cadastrados"
- Mensagem exibida: "Nenhum produto cadastrado."

---

### Teste 5: Listagem com Produtos

**Objetivo:** Verificar exibição correta de produtos cadastrados.

**Passos:**
Cadastre pelo menos 2 produtos válidos:
   - Produto 1: Nome: `Mouse Logitech`, Preço: `89.90`
   - Produto 2: Nome: `Teclado Mecânico`, Preço: `350.00`

**Resultado Esperado:**
- Página exibe o título "Produtos Cadastrados"
- Tabela HTML exibida com colunas: ID, Nome, Preço
- Linha 1: ID gerado, "Mouse Logitech", "R$ 89,90"
- Linha 2: ID gerado, "Teclado Mecânico", "R$ 350,00"

---

## Validações Implementadas

- **Nome:** Obrigatório, entre 2 e 100 caracteres
- **Preço:** Obrigatório, numérico, maior ou igual a zero

## Princípios SOLID Aplicados

### Single Responsibility Principle (SRP)

Cada classe tem uma única responsabilidade:

- **Product:** Representa a entidade de domínio
- **ProductValidator:** Responsável apenas pela validação
- **ProductRepository:** Responsável apenas pela persistência
- **ProductService:** Orquestra as operações de negócio

## Tecnologias Utilizadas

- PHP 8.0+
- PSR-4 Autoloading
- Arquitetura em camadas (Domain, Application, Infrastructure)

## Desenvolvedores do Projeto

- **Matheus Thierry Santos da Silva** - RA: 1999010
- **Artur Camilo Taroco** - RA: 2009597
