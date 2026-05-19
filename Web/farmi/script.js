// Alterar entre Alto Contraste

document.getElementById('contraste-btn')
.addEventListener("click", function(){

    document.body.classList.toggle('alto-contraste');

    const divPrincipal = document.getElementById('div_principal');

    if(divPrincipal){
        divPrincipal.classList.toggle('alto-contraste');
    }

    const addressForm = document.getElementById('addressForm');

    if(addressForm){
        addressForm.classList.toggle('alto-contraste');
    }

});