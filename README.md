# StockNot - Estoques Ágeis para Empresas Modernas

Bem-vindo ao **StockNot**! Solução simples e eficaz para controlar estoque da sua empresa.

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
- Execute:
```sql
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
- Acesse `http://localhost/StockNot/introducao.html`

## Como Usar

1. **Primeiros Passos** - Crie uma conta ou faça login na página de introdução
2. **Adicionando Produtos** - Preencha nome, quantidade atual e quantidade mínima
3. **Gerenciando Estoque** - Veja, edite ou delete produtos
4. **Recebendo Alertas** - Sistema avisa automaticamente quando estoque está baixo

## Estrutura do Projeto

```
StockNot/
├── PÁGINAS
│   ├── inicio.html
│   ├── introducao.html
│   ├── cadastro.html
│   ├── login.html
│   └── painel.php
├── PROCESSAMENTO
│   ├── cadastro.php
│   ├── login.php
│   ├── stock.php
│   ├── salvar.php
│   └── conexao.php
└── VISUAL
    ├── styleInicio.css
    ├── styleCadastro.css
    ├── styleIntroducao.css
    └── styleStock.css
```

## Segurança

- Dados sanitizados contra ataques
- Login obrigatório
- Validação de informações
- Banco de dados protegido

## Troubleshooting

| Problema | Solução |
|----------|---------|
| "Erro ao conectar" | Verifique se MySQL está rodando |
| Produtos não salvam | Confirme que banco `stocknot` existe |
| Site sem cores | Coloque arquivos CSS na mesma pasta |
| Alertas não funcionam | Teste com quantidade menor que mínimo |
| Nada carrega | Verifique se servidor está ligado |

## Precisa de Ajuda?

Abra uma **Issue** no GitHub com uma descrição do problema.

## Sobre o Projeto

**StockNot** nasceu da necessidade de controlar estoque de forma simples e eficaz.

- **Criado por**: [josehenriquesilva299-png](https://github.com/josehenriquesilva299-png)
- **Ano**: 2026
- **Tipo**: Projeto Integrador - Estoques Ágeis
- **Status**: Em desenvolvimento

---

Soluções em Estoques Ágeis para Empresas Modernas
