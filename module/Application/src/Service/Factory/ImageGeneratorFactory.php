<?php
namespace Application\Service\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Intervention\Image\ImageManager;
use Application\Service\BotParser;
use Application\Service\ImageGenerator;

class ImageGeneratorFactory implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $config = $container->get('configuration');
        $idlerpg = $config['idlerpg'];

        $cache = $container->get('Cache');
        $cache->clearExpired();

        $parser = $container->get(BotParser::class);

        $imageManager = new ImageManager(['driver' => 'gd']);

        return new ImageGenerator($idlerpg, $cache, $parser, $imageManager);
    }
}
