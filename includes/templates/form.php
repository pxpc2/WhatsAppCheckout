<div>
    <div class="form-div">
        <p class='form-p'>Quantidade: </p>
        <input type="number" class="form-input" id="quantityInput" min="1" value="1">
        <dialog id='modal' class='form-modal'>
            <div class='modal-div'>
                <a class="details-modal-close">
                    <svg id='fechar' xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7071 1.70711C14.0976 1.31658 14.0976 0.683417 13.7071 0.292893C13.3166 -0.0976311 12.6834 -0.0976311 12.2929 0.292893L7 5.58579L1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L5.58579 7L0.292893 12.2929C-0.0976311 12.6834 -0.0976311 13.3166 0.292893 13.7071C0.683417 14.0976 1.31658 14.0976 1.70711 13.7071L7 8.41421L12.2929 13.7071C12.6834 14.0976 13.3166 14.0976 13.7071 13.7071C14.0976 13.3166 14.0976 12.6834 13.7071 12.2929L8.41421 7L13.7071 1.70711Z" fill="black" />
                    </svg>
                </a>
                <div class="details-modal-title">
                    <h3 id='titulo' class="modal-titulo">Produto adicionado!</h3>
                </div>
                <div class="details-modal-content">
                    <p id='texto' class='modal-texto'></p>
                </div>
                <div class="details-modal-actions">
                    <button 
                        onclick="redirectToCart();" class="btn-clear"
                        id="ver-cart">
                        Ver carrinho
                    </button>
                    <button
                        onclick="window.location='https://mercadoorganico.coop.br/index.php/categorias/';" class="btn-clear">
                        Continuar comprando
                    </button>
                </div>
            </div>
        </dialog>
    </div>
 <button type='submit' id="addToCart" class="btn-clear">Adicionar ao carrinho</button>
</div>

<script>
    function redirectToCart() {
        let currCart = JSON.parse(localStorage.getItem('carrinho'));
        if (currCart && currCart.length > 0) { 
            let map = currCart.reduce(function(prev, cur) {
                prev[cur] = (prev[cur] || 0) + 1;
                return prev;
            }, {});
            localStorage.setItem('cart-map', JSON.stringify(map));
        } 
        window.location = "https://mercadoorganico.coop.br/index.php/checkout/";
    }
    jQuery(document).ready(function($) {
        $('#addToCart').on('click', function(e) {
            let postTitle = postData.post_title;
            let postPrice = postData.post_price;

            let carrinho = JSON.parse(localStorage.getItem('carrinho'));
            let pricesMap =JSON.parse(localStorage.getItem('pricesMap')) || {};
            let modal = document.getElementById('modal');
            
            if (carrinho === null) {
                carrinho = [];
            }
            let qtd =parseInt($('#quantityInput').val());
            for (let i = 0; i < qtd; i++) {
                carrinho.push(postTitle);
            }
            localStorage.setItem('carrinho', JSON.stringify(carrinho));

            pricesMap[postTitle] = postPrice;
            localStorage.setItem('pricesMap', JSON.stringify(pricesMap));

            let modalTexto =document.getElementById('texto');
            modalTexto.innerHTML = `${qtd} unidade(s) de ${postTitle} adicionados ao carrinho!`;
            modal.showModal();
            document.getElementById('ver-cart').blur();
        });
    });
    jQuery(document).ready(function($) {
        $('#fechar').on('click', function(e) {
            modal.close();
        });
    });
</script>