
<?php

use CodeIgniter\Test\CIUnitTestCase;

final class LoginTeste extends CIUnitTestCase
{
    public function testLoginPageReturnsView(): void
    {
        $controller = new \App\Controllers\AuthController();

        $resultado = $controller->login();

        $this->assertNotEmpty($resultado);
    }
}
