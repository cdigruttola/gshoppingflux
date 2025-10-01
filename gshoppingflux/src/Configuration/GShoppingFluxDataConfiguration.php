<?php

namespace cdigruttola\GShoppingFlux\Configuration;

use PrestaShop\PrestaShop\Core\Configuration\AbstractMultistoreConfiguration;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GShoppingFluxDataConfiguration extends AbstractMultistoreConfiguration
{

    private const CONFIGURATION_FIELDS = [
        'CONFIG_KEY',
    ];

    /**
     * @return OptionsResolver
     */
    protected function buildResolver(): OptionsResolver
    {
        return (new OptionsResolver())
            ->setDefined(self::CONFIGURATION_FIELDS)
            ->setAllowedTypes('CONFIG_KEY', 'bool');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        $return = [];
        $shopConstraint = $this->getShopConstraint();

        //$return['wrap'] = $this->configuration->get('CONFIG_KEY', null, $shopConstraint);

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration): array
    {
        $shopConstraint = $this->getShopConstraint();
        //$this->updateConfigurationValue('CONFIG_KEY', 'wrap', $configuration, $shopConstraint);

        return [];
    }
}