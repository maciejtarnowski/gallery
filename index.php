<?php

require __DIR__ . '/vendor/autoload.php';

use Slim\Exception\NotFoundException;
use UseCase\UseCaseException;

$container = new Slim\Container([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);
$gallery = new Slim\App($container);

(new Service\Manager($container))->registerServices();

$gallery->get('/', function ($request, $response) {
    $galleryList = $this->get('UseCaseFactory')->getGalleryList()->execute();

    return $this->get('Twig')->render($response, 'gallery/listing.html', [
        'galleries' => $galleryList['galleries']
    ]);
});

$gallery->get('/gallery/{slug}', function ($request, $response, $arguments) {
    try {
        $galleryShow = $this->get('UseCaseFactory')->getGalleryShow($arguments['slug'])->execute();
    } catch (UseCaseException $ex) {
        throw new NotFoundException($request, $response);
    }

    return $this->get('Twig')->render($response, 'gallery/show.html', [
        'gallery' => $galleryShow['gallery'],
        'images' => $galleryShow['images']
    ]);
});

$gallery->get('/image/{hash}', function ($request, $response, $arguments) {
    try {
        $imageShow = $this->get('UseCaseFactory')->getImageShow($arguments['hash'])->execute();
    } catch (UseCaseException $ex) {
        throw new NotFoundException($request, $response);
    }

    return $this->get('Twig')->render($response, 'image/show.html', [
        'image' => $imageShow['image']
    ]);
});

$gallery->run();
