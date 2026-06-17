# 📦 StockNot - Estoques Ágeis para Empresas Modernas

Bem-vindo ao **StockNot**! 👋 

Se você está cansado de lidar com planilhas confusas, perda de produtos e surpresas desagradáveis com estoque baixo, você encontrou a solução certa. O StockNot é sua ferramenta de controle de inventário que funciona de verdade – simples, rápida e confiável.

---

## 🎯 Por que o StockNot?

Imagine só: você está gerenciando um negócio e precisa saber exatamente o que tem em estoque, quando repor, e se algo está faltando. O StockNot faz isso por você, deixando você livre para se focar no que realmente importa: **fazer seu negócio crescer**.

### O que você consegue fazer com o StockNot:

✨ **Visualizar tudo em um só lugar** - Sem confusão, sem planilhas gigantes
📊 **Monitorar estoque em tempo real** - Sabe exatamente o que você tem agora
⚠️ **Receber alertas automáticos** - Quando algo está acabando, você já sabe
🎯 **Controlar entradas e saídas** - Cada movimento registrado
🔐 **Acesso seguro** - Seu estoque protegido com login seguro

---

## 💡 Benefícios que Você Sente na Prática

| Ganho | O que muda para você |
|------|----------------------|
| 💰 **Menos dinheiro parado** | Você não compra produtos que não vende |
| ⚡ **Reposição mais rápida** | Quando vê que está faltando, já repõe |
| 👀 **Controle total** | Você sabe exatamente o que entra e o que sai |
| 🚀 **Seu negócio cresce** | Com informações certas, você toma melhores decisões |

---

## 🛠️ Como Funciona Tecnicamente

O StockNot foi feito com as melhores práticas em mente:

- **Rápido e leve** - Desenvolvido em PHP, carrega super rápido
- **Interface limpa** - HTML5 e CSS3 fazem tudo funcionar como você espera
- **Banco de dados seguro** - MySQL armazena seus dados com segurança
- **Composição**: 50.7% PHP | 24.7% CSS | 24.6% HTML

---

## 🚀 Como Começar (Passo a Passo)

### Coisas que Você Precisa Antes:

1. Um servidor local rodando (pode ser XAMPP, WAMP ou Laragon)
2. MySQL instalado (já vem junto com os servidores acima)
3. Um navegador (Chrome, Firefox, Edge... qualquer um funciona)

### Instalação Rápida:

**Passo 1:** Clone o projeto
```bash
git clone https://github.com/josehenriquesilva299-png/StockNot.git
cd StockNot
```

**Passo 2:** Configure o banco de dados
- Abra o phpMyAdmin (normalmente em `http://localhost/phpmyadmin`)
- Crie um banco novo chamado `stocknot`
- Execute este comando SQL:
```sql
CREATE TABLE `stock` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `quantidade` INT NOT NULL,
  `minimo` INT NOT NULL
);
```

**Passo 3:** Coloque o projeto no lugar certo
- Se está usando XAMPP: `C:\xampp\htdocs\StockNot`
- Se está usando WAMP: `C:\wamp\www\StockNot`

**Passo 4:** Abra no navegador
- Vá para `http://localhost/StockNot/introducao.html`
- Pronto! Seu StockNot está rodando 🎉

---

## 📖 Como Usar a Plataforma

### 1️⃣ Primeiros Passos

Quando você entra pela primeira vez, você vê a página de introdução. Ali você pode:
- **Criar uma conta** - Se você é novo
- **Fazer login** - Se você já tem conta

### 2️⃣ Adicionando Produtos

No painel de estoque, você preenche:
- **Nome do produto** - O que você está guardando?
- **Quantidade atual** - Quantos você tem agora?
- **Quantidade mínima** - Quando você quer ser avisado que está acabando?

Clica em "Confirmar" e pronto! Seu produto está registrado.

### 3️⃣ Gerenciando o Estoque

Na lista de produtos você consegue:
- 👁️ **Ver tudo** - Cada produto e sua quantidade em um lugar só
- ✏️ **Editar** - Mudou o nome? Precisou atualizar o mínimo? Sem problema
- 🗑️ **Deletar** - Clica em "Excluir produto", seleciona qual quer remover e confirma

### 4️⃣ Recebendo Alertas

O StockNot fica de olho automaticamente. Quando um produto tem quantidade menor que o mínimo, ele avisa você com um ⚠️. Assim você nunca mais é surpreendido com estoque zerado.

---

## 📁 Estrutura do Projeto (Para os Curiosos)

Se você quer entender como tudo funciona por trás das cenas:

```
StockNot/
│
├── 🏠 PÁGINAS (O que você vê)
│   ├── Inicio.html           → Página inicial
│   ├── introducao.html       → Apresentação e benefícios
│   ├── cadastro.html         → Formulário para criar conta
│   ├── login.html            → Tela de login
│   └── painel.php            → Seu dashboard pessoal
│
├── 🔧 PROCESSAMENTO (O trabalho pesado)
│   ├── cadastro.php          → Processa novo cadastro
│   ├── login.php             → Verifica login
│   ├── Stock.php             → Gerencia estoque
│   ├── salvar.php            → Salva produtos novos
│   └── conexao.php           → Se conecta ao banco de dados
│
└── 🎨 VISUAL (Como fica bonito)
    ├── styleInicio.css       → Estilos da página inicial
    ├── styleCadastro.css     → Estilos do cadastro
    ├── styleIntroducao.css   → Estilos da intro
    └── styleStock.css        → Estilos do estoque
```

---

## 🔐 Segurança - Seu Estoque Protegido

A gente leva segurança a sério aqui:

✅ Dados sanitizados (sem risco de "ataques hackers")
✅ Login obrigatório (seu estoque é só seu)
✅ Validação de informações (tudo é verificado antes de salvar)
✅ Banco de dados protegido (suas informações seguras)

---

## 🔄 Fluxo Rápido (Como Tudo se Conecta)

```
📍 Você entra na página inicial
        ↓
    ┌───┴───┐
    ↓       ↓
  CRIAR   FAZER
  CONTA   LOGIN
    ↓       ↓
    └───┬───┘
        ↓
   🎯 PAINEL DO ESTOQUE
        ↓
   ┌─────┴────────────────┐
   ↓     ↓        ↓       ↓
  VER  ADICIONAR EDITAR DELETAR
 TUDO  PRODUTO  PRODUTO PRODUTO
   
   ↓ (Se algo está faltando)
   ⚠️ ALERTAS AUTOMÁTICOS
```

---

## ❓ Algo Não Está Funcionando?

Relaxa, a gente resolve! Aqui estão os problemas mais comuns:

| 🚨 Problema | ✅ Solução |
|-----------|----------|
| "Erro ao conectar" aparece | Cheque se seu banco de dados existe e o MySQL está rodando |
| Não consigo ver os produtos salvos | Confirme que o banco `stocknot` existe no MySQL |
| O site fica feio (sem cores) | Coloque todos os arquivos `.css` na mesma pasta |
| Alertas não aparecem | Tente salvar um produto com quantidade menor que o mínimo |
| Nada carrega | Acesse `http://localhost` primeiro - seu servidor pode não estar ligado |

---

## 💬 Precisa de Ajuda?

Se algo não funcionou como esperado:
- Abra uma **Issue** aqui no GitHub
- Descreva o que aconteceu
- A gente vai te ajudar! 🤝

---

## 👋 Sobre Este Projeto

**StockNot** nasceu de uma necessidade real: empresas precisam controlar estoque de forma simples e eficaz. Aqui a gente entrega exatamente isso.

- 👤 **Criado por**: [josehenriquesilva299-png](https://github.com/josehenriquesilva299-png)
- 📅 **Ano**: 2026
- 🎓 **Tipo**: Projeto Integrador - Estoques Ágeis
- 🚀 **Status**: Em desenvolvimento e melhorando a cada dia

---

## 📚 Quer Saber Mais?

Explore o repositório, veja o código, entenda como funciona. O StockNot é um projeto aberto e você pode aprender com ele!

---

<div align="center">

### 🌟 Soluções em Estoques Ágeis para Empresas Modernas

**Feito com ❤️ para facilitar sua vida**

</div>
