<?php

namespace cdigruttola\GShoppingFlux\Configuration;

use PrestaShop\PrestaShop\Core\Configuration\AbstractMultistoreConfiguration;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GShoppingFluxDataConfiguration extends AbstractMultistoreConfiguration
{
    public const GS_PRODUCT_TYPE = 'GS_PRODUCT_TYPE';
    public const GS_DESCRIPTION = 'GS_DESCRIPTION';
    public const GS_SHIPPING_MODE = 'GS_SHIPPING_MODE';
    public const GS_SHIPPING_PRICE_FIXED = 'GS_SHIPPING_PRICE_FIXED';
    public const GS_SHIPPING_PRICE = 'GS_SHIPPING_PRICE';
    public const GS_SHIPPING_COUNTRY = 'GS_SHIPPING_COUNTRY';
    public const GS_SHIPPING_COUNTRIES = 'GS_SHIPPING_COUNTRIES';
    public const GS_CARRIERS_EXCLUDED = 'GS_CARRIERS_EXCLUDED';
    public const GS_IMG_TYPE = 'GS_IMG_TYPE';
    public const GS_MPN_TYPE = 'GS_MPN_TYPE';
    public const GS_GENDER = 'GS_GENDER';
    public const GS_AGE_GROUP = 'GS_AGE_GROUP';
    public const GS_ATTRIBUTES = 'GS_ATTRIBUTES';
    public const GS_COLOR = 'GS_COLOR';
    public const GS_MATERIAL = 'GS_MATERIAL';
    public const GS_PATTERN = 'GS_PATTERN';
    public const GS_SIZE = 'GS_SIZE';
    public const GS_EXPORT_MIN_PRICE = 'GS_EXPORT_MIN_PRICE';
    public const GS_NO_GTIN = 'GS_NO_GTIN';
    public const GS_SHIPPING_DIMENSION = 'GS_SHIPPING_DIMENSION';
    public const GS_NO_BRAND = 'GS_NO_BRAND';
    public const GS_ID_EXISTS_TAG = 'GS_ID_EXISTS_TAG';
    public const GS_EXPORT_NAP = 'GS_EXPORT_NAP';
    public const GS_QUANTITY = 'GS_QUANTITY';
    public const GS_FEATURED_PRODUCTS = 'GS_FEATURED_PRODUCTS';
    public const GS_GEN_FILE_IN_ROOT = 'GS_GEN_FILE_IN_ROOT';
    public const GS_FILE_PREFIX = 'GS_FILE_PREFIX';
    public const GS_LOCAL_SHOP_CODE = 'GS_LOCAL_SHOP_CODE';
    public const GS_REVIEW_MODULES = 'GS_REVIEW_MODULES';

    private const CONFIGURATION_FIELDS = [
        'product_type',
        'description',
    ];

    /**
     * @return OptionsResolver
     */
    protected function buildResolver(): OptionsResolver
    {
        return (new OptionsResolver())
            ->setDefined(self::CONFIGURATION_FIELDS)
            ->setAllowedTypes('product_type', 'array|string')
            ->setAllowedTypes('description', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration(): array
    {
        $return = [];
        $shopConstraint = $this->getShopConstraint();

        $return['product_type'] = (array) $this->configuration->get(self::GS_PRODUCT_TYPE, null, $shopConstraint);
        $return['description'] = $this->configuration->get(self::GS_DESCRIPTION, null, $shopConstraint);

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration): array
    {
        $shopConstraint = $this->getShopConstraint();
        $this->updateConfigurationValue(self::GS_PRODUCT_TYPE, 'product_type', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_DESCRIPTION, 'description', $configuration, $shopConstraint);

        return [];
    }
}