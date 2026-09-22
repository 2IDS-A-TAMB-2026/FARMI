// Alterar entre Alto Contraste

const contrasteBtn = document.getElementById('contraste-btn');

if (contrasteBtn) {

    contrasteBtn.addEventListener("click", function () {

        document.body.classList.toggle('alto-contraste');

        const divPrincipal = document.getElementById('div_principal');

        if (divPrincipal) {
            divPrincipal.classList.toggle('alto-contraste');
        }

        const addressForm = document.getElementById('addressForm');

        if (addressForm) {
            addressForm.classList.toggle('alto-contraste');
        }

    });

}

document.addEventListener('DOMContentLoaded', () => {
    const contrasteBtn = document.getElementById('contraste-btn');

    // 1. Carrega o estado salvo ao abrir/navegar na página
    if (localStorage.getItem('altoContraste') === 'true') {
        document.body.classList.add('alto-contraste', 'contraste');
    }

    // 2. Evento de clique para alternar o modo
    if (contrasteBtn) {
        contrasteBtn.addEventListener('click', () => {
            document.body.classList.toggle('alto-contraste');
            document.body.classList.toggle('contraste');

            const ehAltoContraste = document.body.classList.contains('alto-contraste') || 
                                    document.body.classList.contains('contraste');

            // Salva a escolha do usuário
            localStorage.setItem('altoContraste', ehAltoContraste);
        });
    }
});


