<div class="checkoutForm">
    <div id="product-list" class="checkout-ul">
        <!-- Cada card de produto vai ser add aki -->
    </div>
    <p id='valorItens' class="checkout-valor-itens"></p>
    <select id='bairro' class='bairro'>
        <option value="">Selecione um bairro</option>
    </select>
    <p id='valorFrete' class="checkout-valor-frete"></p>
    <p id='valorTotal' class="checkout-p"></p>
    <form id='endereco-form' class='endereco-form' 
    style="display: none; margin-bottom: 20px; font-size: 15px; background-color: white;">
        <label for="nome-cliente" class="form-label required">Como você se chama?</label>
        <input type="text" id="nome" name="nome" 
            placeholder="Seu nome e sobrenome" required>
        <label for="address" class="form-label required">Endereço completo:</label>
        <input type="text" id="address" name="address" 
            placeholder="ex: SQS 105 Bloco G..., SMPW Quadra 14 conjunto 2 lote..."  required/>
        
        <label for="apartment" class="form-label required">Número:</label>
        <input type="text" id="apartment" name="apartment" 
            placeholder="Número da casa ou apartamento" required />
        
        <label for="reference" class="form-label required">Ponto de Referência:</label>
        <input type="text" id="reference" name="reference" 
            placeholder="Próximo a..." required>

        <label for="obs" class="form-label">Observações: </label>
        <textarea id="obs" name="obs" rows="4" cols='20' placeholder="ex: deixar com o porteiro"></textarea>

        <div class="pagamento">
            <label for="pagamento" class="form-label required">Forma de pagamento:</label>
            <div class="formas-de-pagamento" id="checklists"> </div>
        </div>
    </form>
    <button id="whatsapp-button" class='btnwpp'>Faça checkout com o WhatsApp!</button>
    <button id="clear-cart-button" class='btn-clear'>Limpar carrinho</button>
</div>

<script>
    const bairros = [
        {
            nome: 'Asa Sul',
            frete: 10.00,
        },
        {
            nome: 'Asa Norte',
            frete: 15.00,
        },
        {
            nome: 'Águas Claras',
            frete: 20.00,
        }
    ]

    const formasPagamento = [
        {
            nome: "PIX (Chave CNPJ 12.159.551/0001-81)",
            wppMsg: "Forma de pagamento desejada: PIX (Chave CNPJ 12.159.551/0001-81)",
        },
        {
            nome: "Cartão de crédito/débito",
            wppMsg: "Forma de pagamento desejada: Cartão de crédito/débito",
        },
        {
            nome: "Boleto bancário",
            wppMsg: "Forma de pagamento desejada: Boleto bancario",
        },
        {
            nome: "Dinheiro",
            wppMsg: "Forma de pagamento desejada: Dinheiro"
        }
    ]

    let carrinho = JSON.parse(localStorage.getItem('carrinho'));
    let pricesMap =JSON.parse(localStorage.getItem('pricesMap'));
    let lista = document.getElementById('product-list');
    let selectEl = document.getElementById('bairro');
    let wpp = document.getElementById('whatsapp-button');
    let clear = document.getElementById('clear-cart-button');
    let adressForm = document.getElementById('endereco-form');
    if (carrinho && carrinho.length > 0) {

        let total = 0.0;

        let frete = 0.0;
        let totalCART = 0.0;

        let bairroNome = '';

        let map = JSON.parse(localStorage.getItem('cart-map'));
        /**
         * invés de appendar um text-content como child na lista,
         * teremos para cada child li da lista, uma div ou algo do tipo
         * reunindo as informações de forma já formatada/estilizada,
         * como um card. Vamos criar um card para cada item e appendar
         * cada card à lista.
         */
        for (let itemName in map) {
            if (map.hasOwnProperty(itemName)) {
                let qtd = map[itemName];
                //let item = document.createElement('li');
                let itemPrice = pricesMap[itemName];
                let price = itemPrice * qtd;
                total += price;
                price = price.toFixed(2);
                //item.textContent =
                 //`${itemName} | ${qtd} unidade(s) | Valor und.: R$${itemPrice} | Valor total: R$${price}`;
                
                let card = document.createElement('div');
                card.classList.add('product-card');
                card.innerHTML = `
                    <p>${itemName}</p>
                    <p>${qtd} unidade(s), valor unitário R$${itemPrice}</p>
                    <p>Valor total: R$${price}</p>
                `;

                lista.appendChild(card);
            }
        }

        const paymentMethods = document.getElementById('checklists');
        formasPagamento.forEach((method, index) => {

            const checkDiv = document.createElement('div');
            checkDiv.classList.add('radio-div');

            const checkbox = document.createElement('input');
            checkbox.type = 'radio';
            checkbox.value = method.nome;
            checkbox.id = `metodo-pagamento-${index}`;
            checkbox.name = 'metodo-pagamento';

            const label = document.createElement('label');
            label.setAttribute('for', `metodo-pagamento-${index}`);
            label.classList.add('pay-label');
            label.textContent = method.nome;

            checkDiv.appendChild(checkbox);
            checkDiv.appendChild(label);

            paymentMethods.appendChild(checkDiv);
        });


        // SELEÇÃO DE BAIRRO PARA CÁLCULO DO FRETE.
        bairros.forEach(bairro => {
            let op = document.createElement('option');
            console.log(bairro.nome);
            op.value = bairro.frete;
            op.textContent = bairro.nome;
            selectEl.appendChild(op);
        });

        let p = document.getElementById('valorTotal');
        let itens = document.getElementById('valorItens');
        total = parseFloat(total).toFixed(2);
        itens.innerHTML = `Total dos itens: R$${total}`

        selectEl.addEventListener('change', function() {
            frete = selectEl.value;
            bairroNome = selectEl.selectedOptions[0].textContent;
            let f =document.getElementById('valorFrete');

            if (bairroNome.localeCompare('Selecione um bairro') != 0) {
                adressForm.style.display = 'block';

                if (optionsData.isActive && total > optionsData.minimumPrice) {
                    f.innerHTML = `Entrega grátis para compras acima de ${optionsData.minimumPrice}`;
                    frete = 0;
                }
                else {
                    f.innerHTML = `Taxa de entrega: R$${frete}`;
                }
                let compl = parseFloat(total) + parseFloat(frete);
                let t = `Total do carrinho: R$${compl.toFixed(2)}`;
                totalCART = compl;
                p.innerHTML = t;
            } else {
                adressForm.style.display = 'none';
                f.innerHTML = ``;
                p.innerHTML = `Selecione um bairro para entrega.`;
            }
        })
        // -------------------------------------------

        clear.addEventListener('click', function() {
                    localStorage.removeItem('carrinho');
                    localStorage.removeItem('cart-map');
                    localStorage.removeItem('pricesMap');
                    location.reload();
                });

        wpp.addEventListener('click', function() {
            const selectedValue = selectEl.value;
            if (!selectedValue) {
                alert('Selecione o bairro para entrega.');
            }
            else {

                const addressFormInputs = document
                                            .querySelectorAll('#endereco-form input[required]');
                let filledFlag = true;
                addressFormInputs.forEach(input => {
                    if (!input.value.trim() && filledFlag) {
                        filledFlag = !filledFlag;
                    }
                });

                const radioButtons = document.querySelectorAll('input[name="metodo-pagamento"]');
                let pagamentoSelecionado = null;
                radioButtons.forEach((radio) => {
                    if (radio.checked) {
                        pagamentoSelecionado = radio.value;
                    }
                });
                if (pagamentoSelecionado !== null) {
                    console.log('Pagamento: ' + pagamentoSelecionado);
                } else {
                    if (filledFlag) filledFlag = !filledFlag;
                }

                if (!filledFlag) {
                    alert('Preencha todos os campos.');
                }
                else {
                    const TELEFONE = "5561999865934";
                    let msg = 'Olá, gostaria de fazer o seguinte pedido:\n';
                    const items =lista.querySelectorAll('div.product-card');
                    let itemCounter = 1;
                    items.forEach((item => {
                        msg += '\n\t' + itemCounter + '. ' + item.textContent;
                        itemCounter++;
                    }));
                    msg+= '\n\nValor total dos itens: R$' +total;
                    msg+='\n\nCliente: ' +addressFormInputs[0].value;
                    msg += '\nEndereço: ' +addressFormInputs[1].value +
                        '\nNúmero: ' +addressFormInputs[2].value +
                        '\nPonto de referência: ' +addressFormInputs[3].value;
                    msg += '\nObservações: ' +document.getElementById('obs').value;
                    msg += '\n\nTaxa de entrega para o bairro ' +bairroNome + ': R$' +frete;
                    msg += '\n\n' + 'Valor total (com frete): R$' + totalCART; 

                    msg += '\n\nForma de pagamento selecionada: ' +pagamentoSelecionado;

                    window.open(`https://api.whatsapp.com/send?phone=${TELEFONE}&text=${encodeURIComponent(msg)}`,
                    '_blank');
                }

            }
        });
    }
    else {
        wpp.style.display = 'none';
        clear.style.display = 'none';
        selectEl.style.display = 'none';
        let vazio = document.createElement('div');
        vazio.innerHTML = `
                    <p>Seu carrinho está vazio.</p>
                `;
        lista.appendChild(vazio);
    }
</script>