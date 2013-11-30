<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
	    
	    new FOS\UserBundle\FOSUserBundle(),
            new Liip\UrlAutoConverterBundle\LiipUrlAutoConverterBundle(),
	    
            new HROM\CoreBundle\HROMCoreBundle(),
            new HROM\NewsBundle\HROMNewsBundle(),
            new HROM\UserBundle\HROMUserBundle(),
            new HROM\GalleryBundle\HROMGalleryBundle(),
            new HROM\AdminBundle\HROMAdminBundle(),
            new HROM\WebmasterBundle\HROMWebmasterBundle(),
            new HROM\EventsBundle\HROMEventsBundle(),
            new HROM\ContactsBundle\HROMContactsBundle(),
            new HROM\CursusBundle\HROMCursusBundle(),
            new HROM\PartnerBundle\HROMPartnerBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
