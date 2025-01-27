<?php
declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\FinishController;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Twig\Environment;

/**
 * @internal
 *
 * @covers \App\Controller\FinishController
 */
class FinishControllerTest extends TestCase
{
    public function testRendersTemplate(): void
    {
        $controller = new FinishController();
        $controller->setContainer($this->getContainer());

        $response = $controller->default(new Request());

        static::assertSame('finish.html.twig', $response->getContent());
    }

    private function getContainer(): ContainerInterface
    {
        $container = new Container();

        $router = $this->createMock(Router::class);
        $router->method('generate')->willReturnArgument(0);

        $container->set('router', $router);

        $twig = $this->createMock(Environment::class);
        $twig->method('render')->willReturnArgument(0);

        $container->set('twig', $twig);

        return $container;
    }
}
