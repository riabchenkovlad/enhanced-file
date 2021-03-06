<?php

namespace VRia\Bundle\EnhancedFileBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class VRiaEnhancedFileExtension
 * @package VRia\Bundle\EnhancedFileBundle\DependencyInjection
 * @author Vladyslav Riabchenko <contact@vria.eu>
 */
class VRiaEnhancedFileExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $formThemes = $container->getParameter('twig.form.resources');
        $formThemes[] = 'VRiaEnhancedFileBundle:Form:' . $mergedConfig['theme'] . '_layout.html.twig';
        $container->setParameter('twig.form.resources', $formThemes);

        $fileTypeDefinition = new Definition('VRia\Bundle\EnhancedFileBundle\Form\EnhancedFileType');
        $fileTypeDefinition->addTag('form.type', array('alias' => 'enhanced_file'));
        $container->setDefinition('vria.form.type.enhanced_file', $fileTypeDefinition);
    }
}
