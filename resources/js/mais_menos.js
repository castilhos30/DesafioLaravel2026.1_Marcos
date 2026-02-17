
    function alterarQuantidade(id, mudanca) {
        let input = document.getElementById('input-qtd-' + id);
        let form = document.getElementById('form-qtd-' + id);
        let valorAtual = parseInt(input.value);
        let max = parseInt(input.getAttribute('max'));
        let min = parseInt(input.getAttribute('min'));

        let novoValor = valorAtual + mudanca;
        if (novoValor >= min && novoValor <= max) {
            input.value = novoValor;
            form.submit();
        }
    }
