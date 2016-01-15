<?php

namespace Service;

use Closure;

use Database\MySql;
use Gallery\Gallery\Factory as GalleryFactory;
use Gallery\Gallery\MySqlRepository as GalleryRepository;
use Gallery\Image\Factory as ImageFactory;
use Gallery\Image\MySqlRepository as ImageRepository;
use Gallery\Image\GalleryConstrainedRepositoryFactory;
use UseCase\Factory as UseCaseFactory;

use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class Manager
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function registerServices()
    {
        $this->registerTwig();
        $this->registerUseCaseFactory();
    }

    private function registerTwig()
    {
        $this->registerService('Twig', function ($container) {
            $view = new Twig('views', [
                'cache' => false
            ]);
            $view->addExtension(new TwigExtension(
                $container->get('router'),
                $container->get('request')->getUri()
            ));

            return $view;
        });
    }

    private function registerUseCaseFactory()
    {
        $this->registerImageRepository();
        $this->registerGalleryRepository();

        $this->registerService('UseCaseFactory', function ($container) {
            return new UseCaseFactory($container->get('GalleryRepository'), $container->get('ImageRepository'));
        });
    }

    private function registerDatabaseDriver()
    {
        $this->registerService('Database', function ($container) {
            return new MySql('mysql:host=localhost;dbname=gallery', 'root', '');
        });
    }

    private function registerImageFactory()
    {
        $this->registerService('ImageFactory', function ($container) {
            return new ImageFactory();
        });
    }

    private function registerImageRepository()
    {
        $this->registerDatabaseDriver();
        $this->registerImageFactory();

        $this->registerService('ImageRepository', function ($container) {
            return new ImageRepository($container->get('Database'), $container->get('ImageFactory'));
        });
    }

    private function registerGalleryConstrainedRepositoryFactory()
    {
        $this->registerDatabaseDriver();
        $this->registerImageFactory();

        $this->registerService('GalleryConstrainedRepositoryFactory', function ($container) {
            return new GalleryConstrainedRepositoryFactory($container->get('Database'), $container->get('ImageFactory'));
        });
    }

    private function registerGalleryRepository()
    {
        $this->registerDatabaseDriver();
        $this->registerGalleryFactory();

        $this->registerService('GalleryRepository', function ($container) {
            return new GalleryRepository($container->get('Database'), $container->get('GalleryFactory'));
        });
    }

    private function registerGalleryFactory()
    {
        $this->registerGalleryConstrainedRepositoryFactory();

        $this->registerService('GalleryFactory', function ($container) {
            return new GalleryFactory($container->get('GalleryConstrainedRepositoryFactory'));
        });
    }

    private function registerService($name, Closure $definition)
    {
        if (isset($this->container[$name])) {
            return;
        }
        $this->container[$name] = $definition;
    }
}
