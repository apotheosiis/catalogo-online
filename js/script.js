document.addEventListener('DOMContentLoaded', () => {
    const productGrid = document.getElementById('product-grid');
    const searchInput = document.getElementById('searchInput');
    const sortOptions = document.getElementById('sortOptions');

    let allProducts = [];

    // Função para buscar produtos da API
    async function fetchProducts() {
        try {
            const response = await fetch('api/read.php');
            if (!response.ok) {
                throw new Error('Erro na rede ao buscar produtos.');
            }
            const products = await response.json();
            allProducts = products;
            renderProducts();
        } catch (error) {
            productGrid.innerHTML = `<p class="error-message">Não foi possível carregar os produtos. Tente novamente mais tarde.</p>`;
            console.error('Erro:', error);
        }
    }

    // Função para renderizar os produtos na tela
    function renderProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        const sortValue = sortOptions.value;

        // 1. Filtrar
        let filteredProducts = allProducts.filter(product =>
            product.nome.toLowerCase().includes(searchTerm) ||
            product.descricao.toLowerCase().includes(searchTerm)
        );

        // 2. Ordenar
        filteredProducts.sort((a, b) => {
            switch (sortValue) {
                case 'price-asc':
                    return a.preco - b.preco;
                case 'price-desc':
                    return b.preco - a.preco;
                case 'name-asc':
                    return a.nome.localeCompare(b.nome);
                case 'name-desc':
                    return b.nome.localeCompare(a.nome);
                default:
                    return 0;
            }
        });

        // 3. Renderizar
        productGrid.innerHTML = ''; // Limpa o grid
        if (filteredProducts.length === 0) {
            productGrid.innerHTML = `<p class="no-results-message">Nenhum produto encontrado.</p>`;
            return;
        }

        filteredProducts.forEach(product => {
            const productCard = `
                <div class="product-card">
                    <img src="imagens/${product.imagem}" alt="${product.nome}" class="product-image">
                    <div class="product-info">
                        <h2>${product.nome}</h2>
                        <p>${product.descricao}</p>
                        <p class="product-price">R$ ${parseFloat(product.preco).toFixed(2).replace('.', ',')}</p>
                    </div>
                </div>
            `;
            productGrid.innerHTML += productCard;
        });
    }

    // Adiciona os Event Listeners
    searchInput.addEventListener('input', renderProducts);
    sortOptions.addEventListener('change', renderProducts);

    // Carregamento inicial
    fetchProducts();
});