<div class="cart-button">
    <a href="/index.php/checkout/" id="viewCart" class="cart-link">
    <svg xmlns="http://www.w3.org/2000/svg" 
    viewBox="0 0 32 32" 
    id="shoppingcart" width="50px">
        <path fill="#ffbb5c" 
            d="m9.651 8.81 14.215.917a1 1 0 0 1 .906 1.24l-1.52 6.079a1 1 0 0 1-.97.757h-11.22" 
            class="colorffcc5c svgShape">
        </path>
        <path fill="#ffbb5c"
         d="m9.651 8.81 14.215.917a1 1 0 0 1 .906 1.24l-1.52 6.079a1 1 0 0 1-.97.757h-11.22" 
         class="colorffcc5c svgShape">
        </path>
         <path fill="#ffa62a" 
         d="m23.866 9.727-1.087-.07c.007.102.02.205-.007.311l-.952 3.807a4 4 0 0 1-3.881 3.03h-7.034l.157 1h11.219a1 1 0 0 0 .97-.757l1.52-6.079a1 1 0 0 0-.905-1.242z" 
         class="colorf7b546 svgShape">
        </path>
        <path fill="none" stroke="#4c8652" stroke-linecap="round"
         stroke-linejoin="round" stroke-miterlimit="10" 
         d="M24.937 22.804H10.423c-.901 0-1.342-1.098-.693-1.721l.962-.923a1 1 0 0 0 .297-.863L9.185 6.663a1 1 0 0 0-.99-.859H6.062"
          class="colorStroke4c6d86 svgStroke">
        </path><path fill="none" stroke="#d5f1d8" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M13.438 25.804H9.5m11.938 0H18.5" class="colorStroked5e5f1 svgStroke"></path><circle cx="13.562" cy="24.804" r="1.5" fill="#45d955" class="color617e95 svgShape"></circle><circle cx="21.562" cy="24.804" r="1.5" fill="#45d955" class="color617e95 svgShape"></circle><circle cx="13.562" cy="24.804" r=".5" fill="#d5f1d8" class="colord5e5f1 svgShape"></circle><circle cx="21.562" cy="24.804" r=".5" fill="#d5f1d8" class="colord5e5f1 svgShape"></circle></svg>
    </a>
</div>


<script>
    let btn = document.getElementById('viewCart');
    btn.addEventListener('click', function() {
        let currCart = JSON.parse(localStorage.getItem('carrinho'));
        if (currCart && currCart.length > 0) { 
            let map = currCart.reduce(function(prev, cur) {
                prev[cur] = (prev[cur] || 0) + 1;
                return prev;
            }, {});
            localStorage.setItem('cart-map', JSON.stringify(map));
        } 
    });
</script>