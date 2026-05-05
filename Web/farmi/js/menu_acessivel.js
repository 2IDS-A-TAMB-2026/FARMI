let niveis = [0.8, 1, 1.2, 1.4];
let indiceAtual = 1; // começa no normal (1)

function aplicarEscala() {
    let escala = niveis[indiceAtual];

    document.body.style.transform = `scale(${escala})`;
    document.body.style.transformOrigin = "top left";
    document.body.style.width = (100 / escala) + "%";
}

function aumentarFonte() {
    if (indiceAtual < niveis.length - 1) {
        indiceAtual++;
        aplicarEscala();
    }
}

function diminuirFonte() {
    if (indiceAtual > 0) {
        indiceAtual--;
        aplicarEscala();
    }
}


/*Botão acessível*/
function toggleAcessibilidade() {
  document.body.classList.toggle("modo-acessivel");

  const icone = document.getElementById("iconeContraste");
  const mission = document.getElementById("mission");
  const vision = document.getElementById("vision");
  const values = document.getElementById("values");
  const loc = document.getElementById("loc_icon");
  const email = document.getElementById("email_icon");
  const call = document.getElementById("call_icon");
  const logo = document.getElementById("logo_farmi");
  const logo2 = document.getElementById("logo_farmi2");
  const logo_simples = document.getElementById("logo_simples");
  const seta1 = document.getElementById("seta1");
  const seta2 = document.getElementById("seta2");
  const seta3 = document.getElementById("seta3");
  const seta4 = document.getElementById("seta4");
  const seta5 = document.getElementById("seta5");
  const seta6 = document.getElementById("seta6");
  const banner1 = document.getElementById("banner1");
  const banner2 = document.getElementById("banner2");
  const banner3 = document.getElementById("banner3");

  /*COM contraste*/
  if (document.body.classList.contains("modo-acessivel")) {
    icone.src = "./images/contraste_ativado.png";
    mission.src = "images/mission_contraste.png"; 
    vision.src = "images/vision_contraste.png"; 
    values.src = "images/values_contraste.png"; 
    loc.src = "icon/loc.png";
    email.src = "icon/email.png";
    call.src = "icon/call.png";
    logo.src = "images/logo_contraste.png";
    logo2.src = "images/logo_contraste.png";
    logo_simples.src = "images/about_contraste.png";
    seta1.src = "icon/3_contraste.png";
    seta2.src = "icon/3_contraste.png"; 
    seta3.src = "icon/3_contraste.png"; 
    seta4.src = "icon/3_contraste.png"; 
    seta5.src = "icon/3_contraste.png"; 
    seta6.src = "icon/3_contraste.png";
    banner1.src = "images/banner_contraste.jpg";
    banner2.src = "images/banner_contraste.jpg";
    banner3.src = "images/banner_contraste.jpg";
  } 
  
  /*SEM contraste*/
  else {
    icone.src = "./images/contraste.png";
    mission.src = "images/mission.png";
    vision.src = "images/vision.png";
    values.src = "images/values.png";
    loc.src = "icon/loc1.png";
    email.src = "icon/email1.png";
    call.src = "icon/call1.png";
    logo.src = "images/logo_FARMI.png";
    logo2.src = "images/logo_FARMI.png";
    logo_simples.src = "images/about.png";
    seta1.src = "icon/3.png";
    seta2.src = "icon/3.png";
    seta3.src = "icon/3.png";
    seta4.src = "icon/3.png";
    seta5.src = "icon/3.png";
    seta6.src = "icon/3.png";
    banner1.src = "images/banner.jpg";
    banner2.src = "images/banner.jpg";
    banner3.src = "images/banner.jpg";
  }
}