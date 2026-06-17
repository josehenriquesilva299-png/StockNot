<?php

include("conexao.php");

$modoEdicao = false;
$produtoEdit = null;

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

if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    $sqlDelete = "DELETE FROM stock WHERE id=$idExcluir";
    mysqli_query($conexao, $sqlDelete);
    header("Location: Stock.php");
    exit;
}

if (isset($_GET['editar'])) {
    $modoEdicao = true;
    $idEditar = intval($_GET['editar']);
    $sqlEdit = "SELECT * FROM stock WHERE id=$idEditar";
    $resultadoEdit = mysqli_query($conexao, $sqlEdit);
    if ($resultadoEdit) {
        $produtoEdit = mysqli_fetch_assoc($resultadoEdit);
    }
}

$sql = "SELECT * FROM stock";
$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockNot - Stock</title>
    <link rel="stylesheet" href="styleStock.css">
    <style>
        .lista-produtos {
            position: relative;
        }
        .lista-produtos .lista-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .lista-produtos .lista-header button {
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
        .produto-item {
            padding: 0.75rem 1rem;
            border: 1px solid #ccc;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 4px;
            transition: background-color 0.2s, border-color 0.2s;
        }
        .produto-item.delete-ativo:hover {
            background-color: #fff6f6;
            border-color: #d33;
        }
        .produto-item.selecionado {
            background-color: #feeaea;
            border-color: #d33;
        }
        .produto-item .row-actions {
            display: flex;
            gap: 0.5rem;
        }
        .delete-confirm {
            display: none;
            border: 1px solid #d33;
            background: #fff0f0;
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 4px;
        }
        .delete-confirm.visible {
            display: block;
        }
        .delete-confirm button {
            margin-right: 0.5rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header>
        <div class="voltar">
            <a href="Inicio.html">
                <button>Voltar</button>
            </a>
        </div>

        <div class="img">
            <img src=" alt="StockNot">
        </div>
    </header>

    <main>
        <section class="informacoes">
            <div>
                Produtos
                Quantidade
            </div>
        </section>

        <section class="formulario">
            <form action="salvar.php" method="POST">
                <input
                    type="text"
                    name="nome"
                    placeholder="Nome do produto"
                    required
                >

                <input
                    type="number"
                    name="quantidade"
                    placeholder="0"
                    required
                >

                <input
                    type="number"
                    name="minimo"
                    placeholder="Quantidade mínima"
                    required
                >

                <button type="submit">
                    Confirmar
                </button>
            </form>
        </section>

        <section class="lista-produtos">
            <div class="lista-header">
                <div>Produtos</div>
                <button id="toggleDeleteMode" type="button">Excluir produto</button>
            </div>
            <?php
            while($produto = mysqli_fetch_assoc($resultado)){
                echo "<div class='produto-item' data-id='" . (int)$produto['id'] . "' data-nome='" . htmlspecialchars($produto['nome'], ENT_QUOTES) . "'>";
                echo "<span>" . htmlspecialchars($produto['nome']) . " - " . (int)$produto['quantidade'] . " (min: " . (int)$produto['minimo'] . ")</span>";
                echo "<span class='row-actions'>";
                echo "<a href='Stock.php?editar=" . (int)$produto['id'] . "'><button type='button'>Editar</button></a>";
                echo "</span>";
                echo "</div>";
            }
            ?>
            <div id="deleteConfirm" class="delete-confirm">
                <p id="deleteMessage">Clique em um produto para selecionar a linha que deseja excluir.</p>
                <button id="confirmDelete" type="button" disabled>Confirmar exclusão</button>
                <button id="cancelDelete" type="button">Cancelar</button>
            </div>
        </section>

        <?php if ($modoEdicao && $produtoEdit): ?>
            <section class="editar-produto">
                <h2>Editar Produto</h2>
                <form action="Stock.php" method="POST">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?php echo (int)$produtoEdit['id']; ?>">

                    <label>Nome:</label>
                    <input
                        type="text"
                        name="nome"
                        value="<?php echo htmlspecialchars($produtoEdit['nome']); ?>"
                        required
                    >

                    <label>Quantidade:</label>
                    <input
                        type="number"
                        value="<?php echo (int)$produtoEdit['quantidade']; ?>"
                        disabled
                    >
                    <input
                        type="hidden"
                        name="quantidade"
                        value="<?php echo (int)$produtoEdit['quantidade']; ?>"
                    >

                    <label>Mínimo:</label>
                    <input
                        type="number"
                        name="minimo"
                        value="<?php echo (int)$produtoEdit['minimo']; ?>"
                        required
                    >

                    <button type="submit">Confirmar</button>
                    <a href="Stock.php"><button type="button">Cancelar</button></a>
                </form>
            </section>
        <?php endif; ?>

        <section class="alerta">
            <?php
            mysqli_data_seek($resultado, 0);
            while($produto = mysqli_fetch_assoc($resultado)){
                if($produto['quantidade'] <= $produto['minimo']){
                    echo "⚠ O produto ";
                    echo $produto['nome'];
                    echo " está com estoque baixo.<br>";
                    
                }
            }
            ?>
        </section>

    </main>

    <script>
        const toggleDeleteMode = document.getElementById('toggleDeleteMode');
        const produtoItems = document.querySelectorAll('.produto-item');
        const deleteConfirm = document.getElementById('deleteConfirm');
        const deleteMessage = document.getElementById('deleteMessage');
        const confirmDelete = document.getElementById('confirmDelete');
        const cancelDelete = document.getElementById('cancelDelete');
        let deleteMode = false;
        let selectedProductId = null;

        function resetDeleteMode() {
            deleteMode = false;
            selectedProductId = null;
            deleteConfirm.classList.remove('visible');
            confirmDelete.disabled = true;
            deleteMessage.textContent = 'Clique em um produto para selecionar a linha que deseja excluir.';
            produtoItems.forEach(item => {
                item.classList.remove('delete-ativo', 'selecionado');
            });
        }

        function enterDeleteMode() {
            deleteMode = true;
            deleteConfirm.classList.add('visible');
            deleteMessage.textContent = 'Clique em um produto para selecionar a linha que deseja excluir.';
            produtoItems.forEach(item => item.classList.add('delete-ativo'));
        }

        toggleDeleteMode.addEventListener('click', () => {
            if (!deleteMode) {
                enterDeleteMode();
            } else {
                resetDeleteMode();
            }
        });

        produtoItems.forEach(item => {
            item.addEventListener('click', (event) => {
                if (!deleteMode) return;
                if (event.target.closest('button') || event.target.closest('a')) return;

                produtoItems.forEach(i => i.classList.remove('selecionado'));
                item.classList.add('selecionado');
                selectedProductId = item.dataset.id;
                const nome = item.dataset.nome;
                deleteMessage.textContent = `Produto selecionado: ${nome}. Clique em Confirmar para apagar.`;
                confirmDelete.disabled = false;
            });
        });

        confirmDelete.addEventListener('click', () => {
            if (!selectedProductId) return;
            window.location.href = `Stock.php?excluir=${selectedProductId}`;
        });

        cancelDelete.addEventListener('click', resetDeleteMode);
    </script>
</body>
</html>