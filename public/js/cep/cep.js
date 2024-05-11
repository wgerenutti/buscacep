$(document).ready(function () {
    $('#cep').on('input', function () {
        var val = this.value.replace(/\D/g, '');
        val = val.replace(/^(\d{5})(\d)/, "$1-$2");
        this.value = val;
    });

    $('#consultar').click(function () {
        var cep = $('#cep').val().replace(/\D/g, '');

        $('#overlay').show();

        $.ajax({
            url: '/api/cep/' + cep,
            type: 'GET',
            success: function (data) {
                $('#overlay').hide();
                var cepFormatado = data.data.cep.replace(/(\d{5})(\d{3})/, "$1-$2");

                $('#resultado').html(`
            <h2>Resultado:</h2>
            <p><strong>CEP:</strong> ${cepFormatado}</p>
            <p><strong>Logradouro:</strong> ${data.data.logradouro}</p>
            <p><strong>Bairro:</strong> ${data.data.bairro}</p>
            <p><strong>Cidade:</strong> ${data.data.cidade}</p>
            <p><strong>Estado:</strong> ${data.data.estado}</p>
        `);
            },
            error: function () {
                $('#overlay').hide();

                $('#resultado').html('<p>CEP não encontrado</p>');
            }
        });
    });
});
