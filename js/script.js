// Arquivo: js/script.js (Versão Completa com Filtro de Categoria)

/**
 * Filtra os produtos por categoria. Esta função é chamada pelos links no HTML.
 * @param {string|null} category - O nome da categoria a ser filtrada, ou null para mostrar todos.
 */
function filterByCategory(category) {
    const searchInput = document.getElementById('searchInput');
    // Limpa a busca textual ao filtrar por categoria para evitar confusão
    searchInput.value = ''; 
    
    // Chama a função fetchProducts (que está dentro do outro escopo) passando a categoria
    window.fetchProducts(category);

    // Adiciona um estilo visual para a categoria ativa
    const categoryLinks = document.querySelectorAll('.categories-nav a');
    categoryLinks.forEach(link => {
        const linkCategory = link.textContent.trim();
        if ((category && linkCategory === category) || (!category && linkCategory === 'Ver Todos')) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}


document.addEventListener('DOMContentLoaded', () => {
    // Seleciona os elementos do DOM
    const productGrid = document.getElementById('product-grid');
    const searchInput = document.getElementById('searchInput');
    const sortOptions = document.getElementById('sortOptions');

    // Array para armazenar os produtos atualmente exibidos
    let currentProducts = [];

    /**
     * Busca produtos da API, opcionalmente filtrados por categoria.
     * @param {string|null} category - A categoria para filtrar.
     */
    window.fetchProducts = async function(category = null) {
        let apiUrl = 'api/read.php';

        // Se uma categoria foi passada, adiciona como um parâmetro de busca na URL
        if (category) {
            apiUrl += `?categoria=${encodeURIComponent(category)}`;
        }
        
        productGrid.innerHTML = `<p class="loading-message">Carregando produtos...</p>`;

        try {
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error('Erro na rede ao buscar produtos.');
            }
            currentProducts = await response.json();
            renderProducts(); // Renderiza os produtos recém-buscados
        } catch (error) {
            productGrid.innerHTML = `<p class="error-message">Não foi possível carregar os produtos.</p>`;
            console.error('Erro:', error);
        }
    }

    /**
     * Renderiza os produtos na tela, aplicando busca por texto e ordenação.
     */
    function renderProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        const sortValue = sortOptions.value;

        // A filtragem por texto acontece sobre os produtos já filtrados pela categoria (em `currentProducts`)
        let processedProducts = currentProducts.filter(product =>
            product.nome.toLowerCase().includes(searchTerm) ||
            product.descricao.toLowerCase().includes(searchTerm)
        );

        // Ordena os produtos filtrados
        processedProducts.sort((a, b) => {
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

        // Limpa o grid e renderiza os produtos processados
        productGrid.innerHTML = '';
        if (processedProducts.length === 0) {
            productGrid.innerHTML = `<p class="no-results-message">Nenhum produto encontrado.</p>`;
            return;
        }

        processedProducts.forEach(product => {
            const productCardHTML = `
                <a href="produto.php?id=${product.id}" class="product-card-link">
                    <div class="product-card">
                        <img src="imagens/${product.imagem}" alt="${product.nome}" class="product-image">
                        <div class="product-info">
                            <h2>${product.nome}</h2>
                            <p>${product.descricao}</p>
                            <p class="product-price">R$ ${parseFloat(product.preco).toFixed(2).replace('.', ',')}</p>
                        </div>
                    </div>
                </a>
            `;
            productGrid.innerHTML += productCardHTML;
        });
    }

    // Adiciona os "escutadores" de eventos para a busca e ordenação por texto
    searchInput.addEventListener('input', renderProducts);
    sortOptions.addEventListener('change', renderProducts);

    // Chama a função inicial para carregar TODOS os produtos quando a página abre
    fetchProducts();
});