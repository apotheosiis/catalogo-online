<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos de Tecnologia</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="header">
        <div class="container">
            <h1>TechShop</h1>
            <p>Os melhores produtos de tecnologia você encontra aqui.</p>
        </div>
    </header>

    <main class="container">
        <section class="filters">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar por nome ou descrição...">
            </div>
            <div class="sort-container">
                <label for="sortOptions">Ordenar por:</label>
                <select id="sortOptions">
                    <option value="name-asc">Nome (A-Z)</option>
                    <option value="name-desc">Nome (Z-A)</option>
                    <option value="price-asc">Preço (Menor)</option>
                    <option value="price-desc">Preço (Maior)</option>
                </select>
            </div>
        </section>

        <section id="product-grid" class="product-grid">
            <p class="loading-message">Carregando produtos...</p>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 TechShop - Todos os direitos reservados.</p>
            <p><a href="crud.php" class="admin-link">Área Administrativa</a></p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>