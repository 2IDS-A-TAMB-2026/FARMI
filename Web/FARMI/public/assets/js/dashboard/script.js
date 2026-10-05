// ========================================================
// ALTO CONTRASTE
// ========================================================

const CHAVE_CONTRASTE = 'altoContraste';

function iniciarContraste() {

    const contrasteBtn = document.getElementById('contraste-btn');

    // Recupera o estado salvo
    if (localStorage.getItem(CHAVE_CONTRASTE) === 'true') {
        document.body.classList.add('alto-contraste');
    } else {
        document.body.classList.remove('alto-contraste');
    }

    // Configura o botão
    if (contrasteBtn) {

        contrasteBtn.onclick = function () {

            document.body.classList.toggle('alto-contraste');

            const contrasteAtivo =
                document.body.classList.contains('alto-contraste');

            localStorage.setItem(
                CHAVE_CONTRASTE,
                contrasteAtivo ? 'true' : 'false'
            );

        };
    }
}

// Executa quando a página estiver pronta
if (document.readyState === 'loading') {

    document.addEventListener(
        'DOMContentLoaded',
        iniciarContraste
    );

} else {

    iniciarContraste();

}