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
    public const GS_AUTOEXPORT_ON_SAVE = 'GS_AUTOEXPORT_ON_SAVE';

    private const CONFIGURATION_FIELDS = [
        'product_type',
        'description',
        'shipping_mode',
        'shipping_price',
        'shipping_country',
        'shipping_countries',
        'carriers_excluded',
        'mpn_type',
        'export_min_price',
        'gender',
        'age_group',
        'colors',
        'materials',
        'patterns',
        'sizes',
        'export_attributes',
        'no_gtin',
        'shipping_dimension',
        'no_brand',
        'id_exists_tag',
        'export_nap',
        'quantity',
        'featured_products',
        'gen_file_in_root',
        'file_prefix',
        'autoexport_on_save',
    ];

    /**
     * @return OptionsResolver
     */
    protected function buildResolver(): OptionsResolver
    {
        return (new OptionsResolver())
            ->setDefined(self::CONFIGURATION_FIELDS)
            ->setAllowedTypes('product_type', 'array|string')
            ->setAllowedTypes('description', 'string')
            ->setAllowedTypes('shipping_mode', 'string')
            ->setAllowedTypes('shipping_price', 'float')
            ->setAllowedTypes('shipping_country', 'string')
            ->setAllowedTypes('shipping_countries', 'null|array')
            ->setAllowedTypes('mpn_type', 'string')
            ->setAllowedTypes('export_min_price', 'float')
            ->setAllowedTypes('gender', 'string')
            ->setAllowedTypes('age_group', 'string')
            ->setAllowedTypes('colors', 'null|array')
            ->setAllowedTypes('materials', 'null|array')
            ->setAllowedTypes('patterns', 'null|array')
            ->setAllowedTypes('sizes', 'null|array')
            ->setAllowedTypes('export_attributes', 'bool')
            ->setAllowedTypes('no_gtin',  'bool')
            ->setAllowedTypes('shipping_dimension',  'bool')
            ->setAllowedTypes('no_brand',  'bool')
            ->setAllowedTypes('id_exists_tag',  'bool')
            ->setAllowedTypes('export_nap',  'bool')
            ->setAllowedTypes('quantity',  'bool')
            ->setAllowedTypes('featured_products',  'bool')
            ->setAllowedTypes('gen_file_in_root',  'bool')
            ->setAllowedTypes('file_prefix', 'string')
            ->setAllowedTypes('autoexport_on_save',  'bool')
            ->setAllowedTypes('store_code',  'bool');
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
        $return['shipping_mode'] = $this->configuration->get(self::GS_SHIPPING_MODE, null, $shopConstraint);
        $return['shipping_price'] = $this->configuration->get(self::GS_SHIPPING_PRICE, null, $shopConstraint);
        $return['shipping_country'] = $this->configuration->get(self::GS_SHIPPING_COUNTRY, null, $shopConstraint);
        $return['shipping_countries'] = (array) $this->configuration->get(self::GS_SHIPPING_COUNTRIES, null, $shopConstraint);
        $return['carriers_excluded'] = (array) $this->configuration->get(self::GS_CARRIERS_EXCLUDED, null, $shopConstraint);
        $return['mpn_type'] = $this->configuration->get(self::GS_MPN_TYPE, null, $shopConstraint);
        $return['export_min_price'] = $this->configuration->get(self::GS_EXPORT_MIN_PRICE, null, $shopConstraint);
        $return['gender'] = $this->configuration->get(self::GS_GENDER, null, $shopConstraint);
        $return['age_group'] = $this->configuration->get(self::GS_AGE_GROUP, null, $shopConstraint);
        $return['colors'] = (array) $this->configuration->get(self::GS_COLOR, null, $shopConstraint);
        $return['materials'] = (array) $this->configuration->get(self::GS_MATERIAL, null, $shopConstraint);
        $return['patterns'] = (array) $this->configuration->get(self::GS_PATTERN, null, $shopConstraint);
        $return['sizes'] = (array) $this->configuration->get(self::GS_SIZE, null, $shopConstraint);
        $return['export_attributes'] = $this->configuration->get(self::GS_ATTRIBUTES, null, $shopConstraint);
        $return['no_gtin'] = $this->configuration->get(self::GS_NO_GTIN, null, $shopConstraint);
        $return['shipping_dimension'] = $this->configuration->get(self::GS_SHIPPING_DIMENSION, null, $shopConstraint);
        $return['no_brand'] = $this->configuration->get(self::GS_NO_BRAND, null, $shopConstraint);
        $return['id_exists_tag'] = $this->configuration->get(self::GS_ID_EXISTS_TAG, null, $shopConstraint);
        $return['export_nap'] = $this->configuration->get(self::GS_EXPORT_NAP, null, $shopConstraint);
        $return['quantity'] = $this->configuration->get(self::GS_QUANTITY, null, $shopConstraint);
        $return['featured_products'] = $this->configuration->get(self::GS_FEATURED_PRODUCTS, null, $shopConstraint);
        $return['gen_file_in_root'] = $this->configuration->get(self::GS_GEN_FILE_IN_ROOT, null, $shopConstraint);
        $return['file_prefix'] = $this->configuration->get(self::GS_FILE_PREFIX, null, $shopConstraint);
        $return['autoexport_on_save'] = $this->configuration->get(self::GS_AUTOEXPORT_ON_SAVE, null, $shopConstraint);
        $return['store_code'] = $this->configuration->get(self::GS_LOCAL_SHOP_CODE, null, $shopConstraint);

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
        $this->updateConfigurationValue(self::GS_SHIPPING_MODE, 'shipping_mode', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_SHIPPING_PRICE, 'shipping_price', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_SHIPPING_COUNTRY, 'shipping_country', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_SHIPPING_COUNTRIES, 'shipping_countries', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_CARRIERS_EXCLUDED, 'carriers_excluded', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_MPN_TYPE, 'mpn_type', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_EXPORT_MIN_PRICE, 'export_min_price', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_GENDER, 'gender', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_AGE_GROUP, 'age_group', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_COLOR, 'colors', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_MATERIAL, 'materials', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_PATTERN, 'patterns', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_SIZE, 'sizes', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_ATTRIBUTES, 'export_attributes', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_NO_GTIN, 'no_gtin', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_SHIPPING_DIMENSION, 'shipping_dimension', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_NO_BRAND, 'no_brand', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_ID_EXISTS_TAG, 'id_exists_tag', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_EXPORT_NAP, 'export_nap', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_QUANTITY, 'quantity', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_FEATURED_PRODUCTS, 'featured_products', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_GEN_FILE_IN_ROOT, 'gen_file_in_root', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_FILE_PREFIX, 'file_prefix', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_AUTOEXPORT_ON_SAVE, 'autoexport_on_save', $configuration, $shopConstraint);
        $this->updateConfigurationValue(self::GS_LOCAL_SHOP_CODE, 'store_code', $configuration, $shopConstraint);

        return [];
    }
}