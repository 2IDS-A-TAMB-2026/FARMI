<?php

// =========================
// HOME
// =========================

$routes->get('/', 'HomeController::index');


// =========================
// LOGIN
// =========================

$routes->get('/login', 'AuthController::login');
$routes->post('/login/autenticar', 'AuthController::autenticar');
$routes->get('/logout', 'AuthController::logout');


// =========================
// ESQUECEU SENHA
// =========================

$routes->get('/esqueceu-senha', 'EsqueceuSenhaController::index');
$routes->post('/enviar-recuperacao', 'EsqueceuSenhaController::enviar');


// =========================
// FILTROS PRIVADOS
// =========================

$routes->group('', ['filter' => 'auth'], function($routes) {

    // =========================
    // ROTAS FAZENDA
    // =========================

    $routes->get('/fazenda', 'FazendaController::index');
    $routes->get('/fazenda/novo', 'FazendaController::novo');
    $routes->post('/fazenda/inserir', 'FazendaController::inserir');
    $routes->get('/fazenda/editar/(:num)', 'FazendaController::editar/$1');
    $routes->post('/fazenda/atualizar/(:num)', 'FazendaController::atualizar/$1');
    $routes->get('/fazenda/excluir/(:num)', 'FazendaController::excluir/$1');


    // =========================
    // ROTAS CULTURA
    // =========================

    $routes->get('/cultura-admin', 'CulturaController::index');
    $routes->get('/cultura/novo', 'CulturaController::novo');
    $routes->post('/cultura/inserir', 'CulturaController::inserir');
    $routes->get('/cultura/editar_culturas/(:num)', 'CulturaController::editar/$1');
    $routes->post('/cultura/atualizar/(:num)', 'CulturaController::atualizar/$1');
    $routes->get('/cultura/excluir/(:num)', 'CulturaController::excluir/$1');


    // =========================
    // ROTAS SENSORES
    // =========================

    $routes->get('/sensor', 'SensorController::index');
    $routes->post('/sensor/inserir', 'SensorController::inserir');
    $routes->get('/sensor/editar/(:num)', 'SensorController::editar/$1');
    $routes->post('/sensor/atualizar/(:num)', 'SensorController::atualizar/$1');
    $routes->get('/sensor/excluir/(:num)', 'SensorController::excluir/$1');


    // =========================
    // ROTAS USUARIOS
    // =========================

    $routes->get('/usuarios-admin', 'UsuariosController::index');
    $routes->post('/usuarios/inserir', 'UsuariosController::inserir');
    $routes->post('/usuarios/atualizar/(:any)', 'UsuariosController::atualizar/$1');
    $routes->get('/usuarios/excluir/(:any)', 'UsuariosController::excluir/$1');
    $routes->get('/usuarios_editar/(:any)', 'UsuariosController::pagina_editar/$1');


    // =========================
    // ROTAS LEITURA SENSOR
    // =========================

    $routes->get('/leitura_sensor', 'LeituraSensorController::index');
    $routes->get('/leitura_sensor/novo', 'LeituraSensorController::novo');
    $routes->post('/leitura_sensor/inserir', 'LeituraSensorController::inserir');
    $routes->get('/leitura_sensor/editar/(:num)', 'LeituraSensorController::editar/$1');
    $routes->post('/leitura_sensor/atualizar/(:num)', 'LeituraSensorController::atualizar/$1');
    $routes->get('/leitura_sensor/excluir/(:num)', 'LeituraSensorController::excluir/$1');


    // ======================================
    // SISTEMA - ADMIN
    // ======================================

    $routes->get('/adicionar-fazenda', 'FazendaController::novo');
    $routes->get('/alertas-admin', 'AlertaController::index');
    $routes->get('/alterar-senha-admin', 'SistemaController::alterar_senha_admin');
    $routes->post('/alterar-senha-admin', 'SistemaController::salvar_senha_admin');
    $routes->get('/configuracoes-admin', 'SistemaController::configuracoes_admin');
    $routes->get('/dashboard-admin', 'SistemaController::dashboard_admin');
    $routes->get('/fazendas-admin', 'FazendaController::index');
    $routes->get('/recuperar-senha-admin', 'SistemaController::recuperar_senha_admin');


    // ======================================
    // SISTEMA - USUÁRIO
    // ======================================

    $routes->get('/alertas-usuario', 'AlertaController::alertas_usuario');
    $routes->get('/alterar-senha', 'UsuariosController::alterar_senha');
    $routes->post('/alterar-senha', 'SistemaController::salvar_senha_usuario');
    $routes->get('/configuracoes-usuario', 'SistemaController::configuracoes_usuario');
    $routes->get('/dashboard-usuario', 'SistemaController::dashboard_usuario');
    $routes->get('/luz', 'SistemaController::luz');
    $routes->get('/recuperar-senha', 'UsuariosController::recuperar_senha');
    $routes->get('/solo', 'SistemaController::solo');
    $routes->get('/temperatura', 'SistemaController::temperatura');
    $routes->get('/umidade', 'SistemaController::umidade');
    $routes->get('/usuario', 'UsuariosController::usuario');
    $routes->get('/usuarios_editar', 'UsuariosController::pagina_editar');

});