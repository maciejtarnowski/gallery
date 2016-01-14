<?php

require __DIR__ . '/vendor/autoload.php';

$container = new Slim\Container([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);
$gallery = new Slim\App($container);

(new Service\Manager($container))->registerServices();

$gallery->get('/', function ($request, $response) {
    return $response->getBody()->write('<pre>' . print_r(iterator_to_array($this->get('UseCaseFactory')->getGalleryList()->execute()['galleries']), true) . '</pre>');
});

$gallery->get('/gallery/{slug}', function ($request, $response, $arguments) {
    $result = $this->get('UseCaseFactory')->getGalleryShow($arguments['slug'])->execute();

    return $response->getBody()->write(
        '<pre>' .
        print_r($result['gallery'], true) .
        print_r(iterator_to_array($result['images']), true) .
        '</pre>'
    );
});

$gallery->get('/image/{hash}', function ($request, $response, $arguments) {
    return $response->getBody()->write(
        '<pre>' .
        print_r($this->get('UseCaseFactory')->getImageShow($arguments['hash'])->execute(), true) .
        '</pre>'
    );
});

$gallery->run();
