# StockNot - Estoques Ágeis para Empresas Modernas

Bem-vindo ao StockNot! Solução simples e eficaz para controlar estoque da sua empresa.

Se você está cansado de lidar com planilhas confusas e surpresas com estoque baixo, encontrou a solução certa.

## Por que o StockNot?

O StockNot permite que você:
- Visualizar tudo em um só lugar - sem confusão
- Monitorar estoque em tempo real
- Receber alertas automáticos quando algo está faltando
- Controlar entradas e saídas com registros precisos
- Acessar com segurança através de login protegido

## Benefícios na Prática

| Ganho | O que muda para você |
|------|----------------------|
| Menos dinheiro parado | Não compra produtos que não vende |
| Reposição mais rápida | Identifica faltantes rapidamente |
| Controle total | Sabe exatamente o que entra e sai |
| Negócio cresce | Melhores decisões com informações certas |

## Como Funciona Tecnicamente

- **Rápido e leve** - Desenvolvido em PHP
- **Interface limpa** - HTML5 e CSS3
- **Banco de dados seguro** - MySQL
- **Composição**: 50.7% PHP | 24.7% CSS | 24.6% HTML

## Como Começar

### Requisitos:
1. Servidor local (XAMPP, WAMP ou Laragon)
2. MySQL instalado
3. Um navegador web

### Instalação Rápida:

**Passo 1:** Clone o projeto
```bash
git clone https://github.com/josehenriquesilva299-png/StockNot.git
cd StockNot
```

**Passo 2:** Configure o banco de dados
- Abra phpMyAdmin em `http://localhost/phpmyadmin`
- Crie um banco chamado `stocknot`
- Execute os seguintes comandos SQL:

```sql
CREATE TABLE `usuarios` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) UNIQUE NOT NULL,
  `senha` VARCHAR(255) NOT NULL
);

CREATE TABLE `stock` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `quantidade` INT NOT NULL,
  `minimo` INT NOT NULL
);
```

**Passo 3:** Coloque o projeto no lugar certo
- XAMPP: `C:\xampp\htdocs\StockNot`
- WAMP: `C:\wamp\www\StockNot`

**Passo 4:** Abra no navegador
- Acesse `http://localhost/StockNot/Inicio.html`

## Como Usar

1. **Primeiros Passos** - Crie uma conta em cadastro.html ou faça login em login.html
2. **Acessar Painel** - Após login, você será redirecionado para painel.php (personalizável com seu nome)
3. **Gerenciar Estoque** - Acesse Stock.php para adicionar, editar ou deletar produtos
4. **Adicionando Produtos** - Preencha nome, quantidade atual e quantidade mínima
5. **Recebendo Alertas** - Sistema avisa automaticamente quando estoque está baixo

## Estrutura do Projeto

```
StockNot/
├── PÁGINAS
│   ├── Inicio.html          (página inicial/landing)
│   ├── introducao.html      (página introdutória)
│   ├── cadastro.html        (formulário de cadastro)
│   ├── login.html           (formulário de login)
│   ├── entra.html           (página de entrada)
│   ├── painel.php           (painel personalizado do usuário)
│   └── Stock.php            (gerenciador de estoque)
├── PROCESSAMENTO
│   ├── conexao.php          (conexão com banco de dados)
│   ├── cadastro.php         (processa novo cadastro de usuários)
│   ├── login.php            (processa autenticação de usuários)
│   ├── Stock.php            (gerencia operações de estoque)
│   └── salvar.php           (salva novos produtos)
└── VISUAL
    ├── styleInicio.css      (estilos da página inicial)
    ├── styleCadastro.css    (estilos do cadastro)
    ├── styleIntroducao.css  (estilos da introdução)
    └── styleStock.css       (estilos do gerenciador de estoque)
```

## Documentação Técnica dos Códigos

### conexao.php
Arquivo responsável por estabelecer a conexão com o banco de dados MySQL.

**Configuração:**
```php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "stocknot";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro ao conectar");
}
```

**Variáveis da Conexão:**
- `$servidor`: localhost (servidor MySQL local)
- `$usuario`: root (usuário padrão)
- `$senha`: vazia (sem senha por padrão)
- `$banco`: stocknot (banco de dados utilizado)

**Funcionamento:** Estabelece conexão com o servidor MySQL e exibe mensagem de erro caso a conexão falhe. Este arquivo é incluído em todos os arquivos PHP que precisam acessar o banco de dados.

---

### cadastro.php
Processa o registro de novos usuários no sistema.

**Fluxo de Funcionamento:**

1. Inclui arquivo de conexão com o banco de dados
2. Verifica se a requisição é do tipo POST
3. Recebe os dados do formulário: nome, email e senha
4. Sanitiza os dados usando `mysqli_real_escape_string()` para proteção contra SQL Injection
5. Insere os dados na tabela de usuários
6. Em caso de sucesso, redireciona para a página inicial
7. Em caso de erro, exibe mensagem de falha

**Código Implementado:**
```php
<?php
include("conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $sql = "INSERT INTO usuarios(nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conexao, $sql)) {
        header("Location: Inicio.html");
        exit;
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($conexao);
    }
}

mysqli_close($conexao);
?>
```

**Dados Recebidos:**
- nome: Nome completo do usuário
- email: Endereço de email para login
- senha: Senha de acesso ao sistema

---

### login.php
Realiza a autenticação de usuários no sistema.

**Fluxo de Funcionamento:**

1. Inicia uma sessão para armazenar dados do usuário logado
2. Inclui o arquivo de conexão com o banco de dados
3. Recebe email e senha do formulário de login
4. Realiza busca no banco de dados para validar as credenciais
5. Se o usuário for encontrado:
   - Armazena ID e nome do usuário na sessão
   - Redireciona para o painel do usuário
6. Se não encontrado:
   - Exibe mensagem de erro

**Código Implementado:**
```php
<?php
session_start();
include("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];

    header("Location: painel.php");
    exit;
} else {
    echo "Email ou senha incorretos";
}
?>
```

**Variáveis de Sessão Criadas:**
- $_SESSION['id']: ID único do usuário no banco
- $_SESSION['nome']: Nome do usuário para personalização

---

### painel.php
Painel de boas-vindas personalizado para cada usuário logado.

**Fluxo de Funcionamento:**

1. Inicia a sessão para acessar dados do usuário
2. Verifica se o usuário possui uma sessão ativa (se está logado)
3. Se não estiver logado, redireciona para a página de login
4. Se estiver logado, exibe página de boas-vindas com o nome do usuário

**Código Implementado:**
```php
<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.html");
}
?>

<h1>
    Bem vindo,
    <?php echo $_SESSION['nome']; ?>
</h1>
```

**Segurança:** Este arquivo valida se o usuário possui uma sessão válida antes de exibir qualquer conteúdo, evitando acesso não autorizado.

---

### salvar.php
Responsável por adicionar novos produtos ao estoque do sistema.

**Fluxo de Funcionamento:**

1. Inclui a conexão com o banco de dados
2. Recebe os dados do formulário de adição de produtos
3. Obtém: nome do produto, quantidade em estoque e quantidade mínima
4. Insere os dados na tabela de estoque
5. Redireciona de volta para a página de gerenciamento de estoque

**Código Implementado:**
```php
<?php
include("conexao.php");

$nome = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$minimo = $_POST['minimo'];

$sql = "INSERT INTO stock (nome, quantidade, minimo) 
        VALUES ('$nome', '$quantidade', '$minimo')";

mysqli_query($conexao, $sql);

header("Location: Stock.php");
exit;
?>
```

**Dados Recebidos:**
- nome: Identificação do produto
- quantidade: Quantidade atual em estoque
- minimo: Quantidade mínima permitida (para alertas)

---

### Stock.php
Gerenciador completo de operações com produtos do estoque.

**Funcionalidades Implementadas:**

#### 1. Criar Produtos
O sistema oferece um formulário para adicionar novos produtos ao estoque:

- Campo de nome do produto
- Campo de quantidade em estoque
- Campo de quantidade mínima
- Botão de confirmação que envia para salvar.php

#### 2. Ler Produtos
Exibe lista de todos os produtos registrados no estoque:

```php
$sql = "SELECT * FROM stock";
$resultado = mysqli_query($conexao, $sql);

while($produto = mysqli_fetch_assoc($resultado)){
    echo htmlspecialchars($produto['nome']) . " - " . (int)$produto['quantidade'];
}
```

Cada produto é exibido com seu nome, quantidade atual e quantidade mínima.

#### 3. Atualizar Produtos
Sistema de edição com modo especial:

- Ativado através do parâmetro ?editar={id} na URL
- Abre formulário com os dados atuais do produto
- Permite modificar nome e quantidade mínima
- A quantidade não pode ser alterada através da edição
- Submete os dados com action=update

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = intval($_POST['id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $quantidade = intval($_POST['quantidade']);
    $minimo = intval($_POST['minimo']);

    $sqlUpdate = "UPDATE stock SET nome='$nome', quantidade=$quantidade, minimo=$minimo WHERE id=$id";
    mysqli_query($conexao, $sqlUpdate);
    header("Location: Stock.php");
    exit;
}
```

#### 4. Deletar Produtos
Sistema seguro de exclusão com confirmação visual:

- Ativado através do parâmetro ?excluir={id} na URL
- Oferece modo de exclusão interativo antes de confirmar
- O usuário deve selecionar o produto antes de excluir

```php
if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    $sqlDelete = "DELETE FROM stock WHERE id=$idExcluir";
    mysqli_query($conexao, $sqlDelete);
    header("Location: Stock.php");
    exit;
}
```

#### 5. Sistema de Alertas
Monitora automaticamente o estoque e avisa quando produtos estão faltando:

```php
while($produto = mysqli_fetch_assoc($resultado)){
    if($produto['quantidade'] <= $produto['minimo']){
        echo "Aviso: O produto " . $produto['nome'] . " está com estoque baixo.";
    }
}
```

O sistema verifica se a quantidade em estoque é menor ou igual à quantidade mínima configurada, exibindo um aviso claro para o usuário.

**Interface Interativa com JavaScript:**
- Modo de exclusão com confirmação visual
- Seleção destacada de produtos
- Proteção contra cliques acidentais em botões
- Interface responsiva e amigável

---

## Banco de Dados

### Tabela: usuarios
Armazena informações dos usuários cadastrados no sistema.

```
id          INT - Identificador único (auto incremento, chave primária)
nome        VARCHAR(255) - Nome completo do usuário
email       VARCHAR(255) - Email para login (campo único)
senha       VARCHAR(255) - Senha de acesso
```

### Tabela: stock
Armazena todos os produtos do estoque.

```
id          INT - Identificador único (auto incremento, chave primária)
nome        VARCHAR(255) - Nome do produto
quantidade  INT - Quantidade atual em estoque
minimo      INT - Quantidade mínima para alertas
```

---

## Segurança

O sistema implementa várias camadas de proteção:

- Dados sanitizados contra ataques usando `mysqli_real_escape_string()`
- Login obrigatório através de sessões PHP
- Validação de informações com `htmlspecialchars()`
- Proteção contra SQL Injection em operações com banco de dados
- Banco de dados protegido por autenticação

**Recomendações para Produção:**

- Utilizar Prepared Statements em lugar de concatenação de strings em queries
- Criptografar senhas usando `password_hash()` e validar com `password_verify()`
- Implementar HTTPS para transmissão segura de dados
- Configurar variáveis de ambiente para credenciais sensíveis
- Adicionar validação de email no cadastro
- Implementar rate limiting para tentativas de login

---

## Troubleshooting

| Problema | Solução |
|----------|---------|
| Erro ao conectar no banco | Verifique se o serviço MySQL está rodando |
| Produtos não salvam | Confirme que o banco de dados stocknot foi criado |
| Login falha | Verifique se a tabela usuarios foi criada corretamente |
| Site sem cores ou estilos | Coloque todos os arquivos CSS na mesma pasta |
| Alertas de estoque não funcionam | Teste definindo quantidade menor que a quantidade mínima |
| Nada carrega na página | Verifique se o servidor local está ligado |
| Erro sobre Session não definida | Confirme que session_start() está no topo dos arquivos PHP |
| Produtos desaparecem após recarregar | Verifique se os dados estão sendo salvos corretamente no banco |
| Não consegue fazer login | Verifique se as credenciais estão corretas e se o email foi cadastrado |

---

## Melhorias Futuras

O projeto tem potencial para as seguintes melhorias:

- Implementar criptografia de senhas com password_hash()
- Converter todas as queries para Prepared Statements
- Adicionar sistema de backup automático do banco de dados
- Criar relatórios de estoque em diferentes períodos
- Adicionar histórico de todas as movimentações de estoque
- Possibilidade de exportar dados para PDF e Excel
- Integração com APIs de fornecedores
- Sistema de múltiplos armazéns
- Controle de permissões por usuário
- Interface responsiva melhorada para mobile

---

## Precisa de Ajuda?

Caso tenha dúvidas ou encontre problemas, abra uma Issue no GitHub com uma descrição detalhada do problema.

## Sobre o Projeto

StockNot nasceu da necessidade de controlar estoque de forma simples, rápida e eficaz para pequenas e médias empresas.

- **Criado por**: josehenriquesilva299-png
- **Ano**: 2026
- **Tipo**: Projeto Integrador - Estoques Ágeis
- **Status**: Em desenvolvimento
- **Linguagem Primária**: PHP
- **Banco de Dados**: MySQL
- **Tecnologias**: PHP, HTML5, CSS3, JavaScript, MySQL

---

Soluções em Estoques Ágeis para Empresas Modernas
