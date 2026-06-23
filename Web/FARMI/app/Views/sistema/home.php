<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- METAS -->
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- === TÍTULO === aba do site -->
    <title>FARMI</title>

    <!-- METAS -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- LINKS -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- style css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- Responsive-->
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
    <!--Ícone do site-->
    <link rel="icon"  href="<?= base_url('assets/images/about.png') ?>" type="image/png" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/jquery.mCustomScrollbar.min.css') ?>">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--Equipe-->
    <link rel="stylesheet" href="<?= base_url('assets/equipe/equipe.css') ?>">
</head>



<!-- === BODY === -->
<body class="main-layout">
    <!-- loader/loading  -->
    <!--
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="Símbolo de loading" /></div>
    </div>
    -->
    <!-- end loader -->


    <!-- === HEADER === -->
    <header>
        <!-- header inner -->
        <div class="header">

            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="#about"><img src="<?= base_url('assets/images/logo_FARMI.png') ?>" id="logo_farmi" alt="Logo com o nome “Farmi” acompanhado de folhas e símbolo de conexão, indicando tecnologia agrícola." style="width: 50% !important;"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="location_icon_bottum_tt">
                            <ul>
                                <li><img src="<?= base_url('assets/icon/loc1.png') ?>" id="loc_icon" alt="Símbolo de local" />SESI</li>
                                <li><img src="<?= base_url('assets/icon/email1.png') ?>" id="email_icon" alt="Símbolo de uma carta"/>farmi_tcc2026@gmail</li>
                                <li><img src="<?= base_url('assets/icon/call1.png') ?>" id="call_icon" alt="Símbolo de telefone"/>(19)99112-6878</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 location_icon_bottum">
                       <div class="row">
                            <div class="col-md-8 ">
                                <div class="menu-area">
                                    <div class="limit-box">
                                        <nav class="main-menu">
                                            <ul class="menu-area-main">
                                                <li> <a href="#about">Sobre</a> </li>
                                                <li><a href="#contact">Nos contate</a></li>
                                                <li><a href="#identidade">Identidade</a></li>
                                                <li><a href="<?= base_url('/login') ?>">Entrar</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-acessibilidade">
                                <button onclick="aumentarFonte()">A+</button>
                                <button onclick="diminuirFonte()">A-</button>
                                <button onclick="toggleAcessibilidade()"><img src="<?= base_url('assets/images/contraste.png') ?>" alt="Ícone de contraste normal" class="contraste" id="iconeContraste"/></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header inner -->
    </header>
    <!-- === END HEADER === -->



    <!-- === CARROSSEL === carousel -->
    <section class="slider_section">
        <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class=""></li>
                <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src="<?= base_url('assets/images/banner.jpg') ?>" id="banner1" alt="Imagem de uma paisagem rural com plantações e colinas suaves ao fundo, transmitindo tranquilidade no campo.">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <h1>FARMI</h1>
                            <span>Fazenda Automatizada Remota de Monitoramento Inteligente</span>
                            
                            <a class="buynow" href="#about">Sobre Nós</a><a class="buynow ggg" href="#contact">Contato</a>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="second-slide" src="<?= base_url('assets/images/banner.jpg') ?>" id="banner2" alt="Imagem de uma paisagem rural">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <h1>FARMI</h1>
                            <span>Fazenda Automatizada Remota de Monitoramento Inteligente</span>

                            <p>Tecnologia que protege e faz sua fazenda crescer</p>
                            <a class="buynow" href="#about">Sobre Nós</a><a class="buynow ggg" href="#contact">Contato</a>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="third-slide" src="<?= base_url('assets/images/banner.jpg') ?>" id="banner3" alt="Imagem de uma paisagem rural">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <h1>FARMI</h1>
                            <span>Fazenda Automatizada Remota de Monitoramento Inteligente</span>

                            <p>Do campo ao controle: inteligência que produz mais</p>
                            <a class="buynow" href="#about">Sobre Nós</a><a class="buynow ggg" href="#contact">Contato</a>

                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <i class='fa fa-angle-left'></i>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <i class='fa fa-angle-right'></i>
            </a>
        </div>
    </section>
    <!-- === END CARROSSEL === -->



    <!-- === SOBRE A FARMI === -->
    <!-- about -->
    <div id="about" class="about">
        <div class="container">
            <div class="row">

                <div class="col-xl-5 col-lg-5 col-md-5 co-sm-l2">
                    <div class="about_box">
                        <h2>Sobre a<br><strong class="black"> FARMI</strong></h2>
                        <p>A FARMI (Fazenda Automatizada e Remota com Monitoramento Inteligente) é uma solução de AgTech focada em transformar a gestão rural por meio da tecnologia. Nosso objetivo é centralizar dados dispersos em uma plataforma única, facilitando a tomada de decisão e aumentando a produtividade no campo. Através de sensores IoT, monitoramos em tempo real indicadores como temperatura, umidade e iluminosidade do tempo. O sistema oferece um painel intuitivo com alertas automáticos sobre condições críticas, garantindo o uso sustentável de recursos e redução de custos. Projetada para pequenos e grandes produtores, a FARMI une a tradição do cultivo à inovação digital.</p>
                        <a href="<?= base_url('assets/images/leia_mais.pdf') ?>" class="leia_mais" target="_blank" >Leia Mais</a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 co-sm-l2">
                    <div class="about_img">
                        <figure><img src="<?= base_url('assets/images/about.png') ?>" id="logo_simples" alt="Logo simples da FARMI" /></figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end about -->
    <!-- === END SOBRE A FARMI === -->



    <!-- === NOSSA IDENTIDADE === -->
    <!-- Título -->
    <div id="identidade" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>Nossa <strong class="black"> Identidade</strong></h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Conteúdo -->
    <section class="agro-simple-section">
        <div class="container">

            <div class="agro-columns">

                <!-- MISSÃO -->
                <div class="agro-col">
                    <img id="mission" src="<?= base_url('assets/images/mission.png') ?>" alt="Foguete representando missão">
                    <h3>Missão</h3>
                    <p>
                        Usar sensores e monitoramento em tempo real para ajudar produtores a tomar decisões mais eficientes no cultivo.
                    </p>
                </div>

                <!-- VISÃO -->
                <div class="agro-col">
                    <img id="vision" src="<?= base_url('assets/images/vision.png') ?>" alt="Olho representando visão">
                    <h3>Visão</h3>
                    <p>
                        Ser referência em tecnologia agrícola, promovendo soluções inteligentes e sustentáveis no campo.
                    </p>
                </div>

                <!-- VALORES -->
                <div class="agro-col">
                    <img id="values" src="<?= base_url('assets/images/values.png') ?>" alt="Mão com coração representando valores">
                    <h3>Valores</h3>
                    <p>
                        Sustentabilidade, inovação e eficiência, buscando sempre otimizar recursos e melhorar a produção.
                    </p>
                </div>

            </div>

        </div>
    </section>
    <!-- === END NOSSA IDENTIDADE === -->



    <!-- === SENSORES UTILIZADOS === -->
    <!-- offer -->
    <div class="offer" id="offer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Sensores <strong class="black"> Utilizados</strong></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="offer-bg">
            <div class="container">
                <div class="row">

                    <!-- SOLO -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                        <div class="offer_box">
                            <h3>Sensor do Solo</h3>
                            <figure><img src="<?= base_url('assets/images/offer1.png') ?>" class="sensores" alt="Imagem de um sensor de umidade do solo eletrônico com fios, usado para medições em projetos tecnológicos." /></figure>
                            <p><b>Sensor de umidade do solo:</b> Mede a umidade da terra e serve para indicar o momento ideal de irrigação, evitando excesso ou falta de água</p>

                        </div>
                    </div>

                    <!-- CLIMA -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 margin_ttt">
                        <div class="offer_box">
                            <h3>Sensor de Clima</h3>
                            <figure><img src="<?= base_url('assets/images/offer2.png') ?>" class="sensores" alt="Sensor de temperatura e umidade (modelo DHT11), usado em projetos de monitoramento ambiental." /></figure>
                            <p><b>Sensor de temperatura e umidade do clima:</b> Mede a temperatura (°C) e a umidade do ar (%) e serve para monitorar o ambiente, garantindo melhores condições para o cultivo</p>
                        </div>
                    </div>

                    <!-- LUZ -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 margin-lkk">
                        <div class="offer_box">
                            <h3>Sensor de Luz</h3>
                            <figure><img src="<?= base_url('assets/images/offer3.png') ?>" class="sensores" alt="Pequeno componente eletrônico sensível à luz (fotoresistor), usado para detectar luminosidade." /></figure>
                            <p><b>Sensor de luz:</b> Mede a intensidade luminosa em lux (lx) e serve para controlar a quantidade de luz recebida pelas plantas, favorecendo seu crescimento saudável</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end offer -->
    <!-- === END SENSORES UTILIZADOS === -->



    <!-- === CONSIGA MONITORAR === -->
    <!-- product -->
    <div id="product" class="product">
        <!-- Título -->
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <h2> <strong class="black"> Monitore</strong></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Conteúdo -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                    <div class="row">

                        <!-- TEMPERATURA -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="product_box">
                                <figure><img src="<?= base_url('assets/images/product_img1.jpg') ?>" alt="Termômetro sob o sol em um céu azul, representando medição de temperatura." />
                                    <h3> Temperatura </h3></figure>
                            </div>
                        </div>

                        <!-- UMIDADE -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="product_box">
                                <figure><img src="<?= base_url('assets/images/product_img2.jpg') ?>" alt="Planta jovem crescendo em solo úmido com gotas de água, simbolizando irrigação ou cultivo." />
                                    <h3> Umidade </h3>
                                </figure>
                            </div>
                        </div>

                        <!-- CULTIVO -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="product_box">
                                <figure><img src="<?= base_url('assets/images/product_img4.jpg') ?>" alt="Linhas de plantação organizadas em campo aberto, mostrando agricultura em larga escala." />
                                    <h3> Cultivo </h3></figure>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="row">

                        <!-- LUMINÂNCIA -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="product_box">
                                <figure><img src="<?= base_url('assets/images/product_img3.jpg') ?>" alt="Plantação iluminada pelo nascer ou pôr do sol, destacando produção agrícola e iluminação." />
                                    <h3>Iluminância </h3></figure>
                            </div>
                        </div>

                        <!-- SENSORES -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="product_box">
                                <figure><img src="<?= base_url('assets/images/product_img5.jpg') ?>" alt="Sistema com sensores conectados a plantas em vasos, indicando tecnologia aplicada à agricultura." />
                                    <h3>Sensores </h3></figure>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end product -->
    <!-- === END CONSIGA MONITORAR === -->



    <!-- === NOSSA EQUIPE === -->
    <!--team-->
    <section class="team" id="team">
        <h2 class="titulo">NOSSA EQUIPE</h2>

        <div class="team-container">

            <div class="card">
                <a href="https://www.instagram.com/thaienetessaro/" target="_blank">
                    <img src="<?= base_url('assets/equipe/thaiene.png') ?>" alt="Membro da Equipe chamado: Thaiene">
                </a>
                <h3>Thaiene Tessaro</h3>
                <p>Scrum Master e Programadora Back-End</p>
            </div>

            <div class="card">
                <a href="https://www.instagram.com/zito_paula/" target="_blank">
                    <img src="<?= base_url('assets/equipe/paula.jpg') ?>" alt="Membro da Equipe chamado: Paula">
                </a>
                <h3>Paula Zito</h3>
                <p>P.O e Programadora Back-End</p>
            </div>

            <div class="card">
                <a href="https://www.instagram.com/vinyssues/" target="_blank">
                    <img src="<?= base_url('assets/equipe/vinicius.jpg') ?>" alt="Membro da Equipe chamado: Vinicius">
                </a>
                <h3>Vinícius Lima</h3>
                <p>Desenvolvedor Full Stack</p>
            </div>

            <div class="card">
                <a href="https://www.instagram.com/_isabellagarcia__/" target="_blank">
                    <img src="<?= base_url('assets/equipe/isabella.png') ?>" alt="Membro da Equipe chamado: Isabella">
                </a>
                <h3>Isabella Garcia</h3>
                <p>Desenvolvedora Full Stack</p>
            </div>

            <div class="card">
                <a href="https://www.instagram.com/imnott_mariaaaa/" target="_blank">
                    <img src="<?= base_url('assets/equipe/maria.jpg') ?>" alt="Membro da Equipe chamado: Maria">
                </a>
                <h3>Maria Clara Braga</h3>
                <p>Analista de Banco de Dados</p>
            </div>

            <div class="card">
                <a href="https://www.instagram.com/vitinzxx__/" target="_blank">
                    <img src="<?= base_url('assets/equipe/vitor.png') ?>" alt="Membro da Equipe chamado: Vitor">
                </a>
                <h3>Vitor Delduca</h3>
                <p>Analista de Banco de Dados</p>
            </div>
        </div>
    </section>

    <br><br><br><br>
    <!--End team-->
    <!-- === END NOSSA EQUIPE === -->



    <!-- === FOOTER === -->
    <!-- footer -->
    <footr>
        <div class="footer top_layer " id="contact">
            <div class="container">

                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="address">
                            <a href="#about"> <img src="<?= base_url('assets/images/logo_FARMI.png') ?>" id="logo_farmi2" alt="Logo com folhas verdes e elementos que lembram tecnologia, sugerindo agricultura sustentável e moderna" id="logo1" /></a>
                            <p>Promovendo a automação e o monitoramento rural para uma gestão mais eficiente e sustentável </p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="address">
                            <h3>Atalhos</h3>
                            <ul class="Links_footer">
                                <li><img src="<?= base_url('assets/icon/3.png') ?>" id="seta1" alt="Símbolo de seta para a direita" /> <a href="#">Início </a> </li>
                                <li><img src="<?= base_url('assets/icon/3.png') ?>" id="seta2" alt="Símbolo de seta para a direita" /> <a href="#about">Sobre </a> </li>
                                <li><img src="<?= base_url('assets/icon/3.png') ?>" id="seta3" alt="Símbolo de seta para a direita" /> <a href="#identidade">Identidade </a> </li>
                                <li><img src="<?= base_url('assets/icon/3.png') ?>" id="seta4" alt="Símbolo de seta para a direita" /> <a href="#offer">Sensores </a> </li>
                                <li><img src="<?= base_url('assets/icon/3.png') ?>" id="seta5" alt="Símbolo de seta para a direita" /> <a href="#product">Serviços </a> </li>
                                <li><img src="<?= base_url('assets/icon/3.png') ?>" id="seta6" alt="Símbolo de seta para a direita" /> <a href="#equipe-container">Equipe </a> </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="address">
                            <h3>Redes Sociais</h3>
                            <p>Acesse nossas redes sociais para saber mais </p>
                            <ul class="icone_redes">
                                <li>
                                    <a href="https://www.instagram.com/farmi.tech/"><img src="<?= base_url('assets/icon/instagram.png') ?>" alt="Símbolo do Instagram" /></a>
                                </li>
                                <li>
                                    <a href="https://tiktok.com/@_farmi.370"><img src="<?= base_url('assets/icon/tiktok.png') ?>" alt="Símbolo do TikTok" /></a>
                                </li>
                                <li>
                                    <a href="https://github.com/2IDS-A-TAMB-2026/FARMI"><img src="<?= base_url('assets/icon/github.png') ?>" alt="Símbolo do GitHub" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="address">
                            <h3>Nosso Contato</h3>
                            <p>Entre em contato conosco para realizar o cadastro da sua fazenda </p>

                            <ul class="loca">
                                <li>
                                    <a href="#"><img src="<?= base_url('assets/icon/loc.png') ?>" alt="ícone de localização" /></a>SESI CE 370
                                    <br>Joelmir Beting </li>
                                <li>
                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=fami.tcc2026@gmail.com"><img src="<?= base_url('assets/icon/email.png') ?>" alt="ícone de carta" /></a>farmi.tcc2026@gmail.com</li>
                                <li>
                                    <a href="#"><img src="<?= base_url('assets/icon/call.png') ?>" alt="ícone de telefone" /></a>+55 (19) 99112-6878 </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        <div class="copyright">
            <div class="container">
                <p>© 2026 Todos os direitos reservados. TCC Farmi.</p>
            </div>
        </div>
    </footr>
    <!-- end footer -->
    <!-- === END FOOTER === -->



    <!-- === JAVA SCRIPT === -->

    <!-- VLibras -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>


    <!--JS MENU ACESSÍVEL-->
    <script>
        const BASE_URL = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url('assets/js/menu_acessivel.js') ?>"></script>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery-3.0.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugin.js') ?>"></script>
    <!-- sidebar -->
    <script src="<?= base_url('assets/js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
    <!-- javascript -->
    <script src="<?= base_url('assets/js/owl.carousel.js') ?>"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>
    <script>
        // This example adds a marker to indicate the position of Bondi Beach in Sydney,
        // Australia.
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: {
                    lat: 40.645037,
                    lng: -73.880224
                },
            });

            var image = '<?= base_url('assets/images/maps-and-flags.png') ?>';
            var beachMarker = new google.maps.Marker({
                position: {
                    lat: 40.645037,
                    lng: -73.880224
                },
                map: map,
                icon: image
            });
        }
    </script>
    <!-- google map js -->
    <script src="https://www.google.com/maps/place/Servi%C3%A7o+Social+da+Ind%C3%BAstria-SESI/@-21.7110061,-47.279045,17z/data=!3m1!4b1!4m6!3m5!1s0x94b7efc1347e3265:0x53eb3a234374dc72!8m2!3d-21.7110061!4d-47.2764701!16s%2Fg%2F1q5hrr5y8?entry=ttu&g_ep=EgoyMDI2MDEyOC4wIKXMDSoASAFQAw%3D%3D"></script>
    <!-- end google map js -->
</body>

</html>