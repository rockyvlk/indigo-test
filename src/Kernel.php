<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{modules}/**/{services,parameters}.yaml');
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');
        $container->import('../config/services.yaml');
        $container->import('../config/{services}_'.$this->environment.'.yaml');
    }
}
