<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

use Slim\Exception\NotFoundException;
use UseCase\UseCaseException;
use UseCase\Gallery\UnauthorizedException;

$container = new Slim\Container([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);
$gallery = new Slim\App($container);

(new Service\Manager($container))->registerServices();

$gallery->get('/', function ($request, $response) {
    $galleryList = $this->get('UseCaseFactory')->getGalleryList()->execute();

    return $this->get('Twig')->render($response, 'gallery/listing.html', $galleryList);
})->setName('GalleryList');

$gallery->get('/gallery/{slug}', function ($request, $response, $arguments) {
    try {
        $password = $this->get('PasswordStorage')->getForGallerySlug($arguments['slug']);
        $galleryShow = $this->get('UseCaseFactory')->getGalleryShow($arguments['slug'], $password)->execute();
    } catch (UseCaseException $ex) {
        throw new NotFoundException($request, $response);
    } catch (UnauthorizedException $ex) {
        return $response->withStatus(302)->withHeader('Location', '/gallery/' . $arguments['slug'] . '/password');
    }

    return $this->get('Twig')->render($response, 'gallery/show.html', $galleryShow);
})->setName('GalleryShow');

$gallery->get('/gallery/{slug}/password', function ($request, $response, $arguments) {
    try {
        $galleryPassword = $this->get('UseCaseFactory')->getGalleryPassword($arguments['slug'])->execute();
    } catch (UseCaseException $ex) {
        throw new NotFoundException($request, $response);
    }

    return $this->get('Twig')->render($response, 'gallery/password.html', $galleryPassword);
})->setName('GalleryPassword');

$gallery->post('/gallery/{slug}/password', function ($request, $response, $arguments) {
    try {
        $galleryPassword = $this->get('UseCaseFactory')->getGalleryPassword($arguments['slug'])->execute();
    } catch (UseCaseException $ex) {
        throw new NotFoundException($request, $response);
    }

    $postParams = $request->getParsedBody();

    $destinationUrl = '/gallery/' . $arguments['slug'];

    if (isset($postParams['password']) && $galleryPassword['gallery']->isPasswordCorrect($postParams['password'])) {
        $this->get('PasswordStorage')->setForGallerySlug($arguments['slug'], $postParams['password']);
    } else {
        $destinationUrl .= '/password';
    }

    return $response->withStatus(302)->withHeader('Location', $destinationUrl);
});

$gallery->get('/image/{hash}', function ($request, $response, $arguments) {
    try {
        $imageShow = $this->get('UseCaseFactory')->getImageShow($arguments['hash'])->execute();
    } catch (UseCaseException $ex) {
        throw new NotFoundException($request, $response);
    }

    return $this->get('Twig')->render($response, 'image/show.html', $imageShow);
})->setName('ImageShow');

$gallery->run();
