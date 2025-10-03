<?php
/**
 * Copyright since 2007 Carmine Di Gruttola
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    cdigruttola <c.digruttola@hotmail.it>
 *  @copyright Copyright since 2007 Carmine Di Gruttola
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
declare(strict_types=1);

namespace cdigruttola\GShoppingFlux\Form;

use cdigruttola\GShoppingFlux\Configuration\GShoppingFluxDataConfiguration;
use ImageType;
use PrestaShop\PrestaShop\Core\Form\ChoiceProvider\ImageTypeChoiceProvider;
use PrestaShopBundle\Entity\Repository\ImageTypeRepository;
use PrestaShopBundle\Form\Admin\Type\FeatureChoiceType;
use PrestaShopBundle\Form\Admin\Type\MultistoreConfigurationType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use PrestaShopBundle\Form\FormHelper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

if (!defined('_PS_VERSION_')) {
    exit;
}

class GShoppingFluxConfigurationType extends TranslatorAwareType
{
    /**
     * @var array
     */
    private $countryChoices;
    /**
     * @var array
     */
    private $carriers;

    public function __construct(
        TranslatorInterface $translator,
        array $locales,
        array $countryChoices,
        array $carriers,
        private readonly ImageTypeRepository $imageTypeRepository
    ) {
        parent::__construct($translator, $locales);

        $this->countryChoices = [$this->trans('All', 'Modules.Gshoppingflux.Admin') => 'all'] + $countryChoices;
        $this->carriers = [$this->trans('No', 'Modules.Gshoppingflux.Admin') => 'no'] + $carriers ;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $descriptions = [
            $this->trans('Short description', 'Modules.Gshoppingflux.Admin') => 'short',
            $this->trans('Long description', 'Modules.Gshoppingflux.Admin') => 'long',
            $this->trans('Short and long description', 'Modules.Gshoppingflux.Admin') => 'short+long',
            $this->trans('Meta description', 'Modules.Gshoppingflux.Admin') => 'meta',
        ];

        $shipping_modes = [
            $this->trans('No shipping method', 'Modules.Gshoppingflux.Admin') => 'none',
            $this->trans('Price fixed', 'Modules.Gshoppingflux.Admin') => 'fixed',
            $this->trans('Generate shipping costs in several countries [EXPERIMENTAL]', 'Modules.Gshoppingflux.Admin') => 'full',
        ];

        $mpn_types = [
            $this->trans('Reference', 'Modules.Gshoppingflux.Admin') => 'reference',
            $this->trans('Supplier Reference', 'Modules.Gshoppingflux.Admin') => 'supplier_reference',
        ];

        $imageTypes = [];
        $dbImageTypes = $this->imageTypeRepository->findBy(['products' => true]);

        foreach ($dbImageTypes as $dbImageType) {
            $imageTypes[$dbImageType->getName()] = $dbImageType->getId();
        }

        $builder
            ->add('product_type', TranslatableType::class, [
                'type' => TextType::class,
                'label' => $this->trans('Default product type', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('Your shop\'s default product type, ie: if you sell pants and shirts, and your main categories are "Men", "Women", "Kids", enter "Clothing" here. That will be exported as your shop main category. This setting is optional and can be left empty. Besides the module requires that at least main category of your shop is correctly linked to a Google product category.', 'Modules.Gshoppingflux.Admin'),
                'required' => false,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_PRODUCT_TYPE,
            ])
            ->add('description', ChoiceType::class, [
                'label' => $this->trans('Description type', 'Modules.Gshoppingflux.Admin'),
                'choices' => $descriptions,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_DESCRIPTION,
            ])
            ->add('shipping_mode', ChoiceType::class, [
                'label' => $this->trans('Shipping Methods', 'Modules.Gshoppingflux.Admin'),
                'choices' => $shipping_modes,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_SHIPPING_MODE,
            ])
            ->add('shipping_price', MoneyType::class, [
                'label' => $this->trans('Shipping price', 'Modules.Gshoppingflux.Admin'),
                'attr' => ['data-display-price-precision' => FormHelper::DEFAULT_PRICE_PRECISION],
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_SHIPPING_PRICE,
            ])
            ->add('shipping_country', TextType::class, [
                'label' => $this->trans('Shipping country', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('This field is used for "Price fixed".', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_SHIPPING_COUNTRY,
            ])
            ->add('shipping_countries', ChoiceType::class, [
                'label' => $this->trans('Shipping countries', 'Modules.Gshoppingflux.Admin'),
                'choices' => $this->countryChoices,
                'multiple' => true,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_SHIPPING_COUNTRIES,
            ])
            ->add('carriers_excluded', ChoiceType::class, [
                'label' => $this->trans('Carriers to exclude', 'Modules.Gshoppingflux.Admin'),
                'choices' => $this->carriers,
                'multiple' => true,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_CARRIERS_EXCLUDED,
            ])
            ->add('img_type', ChoiceType::class, [
                'label' => $this->trans('Images type', 'Modules.Gshoppingflux.Admin'),
                'choices' => $imageTypes,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_IMG_TYPE,
            ])
            ->add('mpn_type', ChoiceType::class, [
                'label' => $this->trans('Manufacturers References type (MPN)', 'Modules.Gshoppingflux.Admin'),
                'choices' => $mpn_types,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_MPN_TYPE,
            ])
            ->add('export_min_price', MoneyType::class, [
                'label' => $this->trans('Minimum product price', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('Products at lower price are not exported. Enter 0.00 for no use.', 'Modules.Gshoppingflux.Admin'),
                'attr' => ['data-display-price-precision' => FormHelper::DEFAULT_PRICE_PRECISION],
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_EXPORT_MIN_PRICE,
            ])
            ->add('gender', FeatureChoiceType::class, [
                'label' => $this->trans('Products gender feature', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_GENDER,
                'required' => false,
            ])
            ->add('age_group', FeatureChoiceType::class, [
                'label' => $this->trans('Products age group feature', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_AGE_GROUP,
                'required' => false,
            ])
            ->add('colors', FeatureChoiceType::class, [
                'label' => $this->trans('Products color feature', 'Modules.Gshoppingflux.Admin'),
                'multiple' => true,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_COLOR,
                'required' => false,
            ])
            ->add('materials', FeatureChoiceType::class, [
                'label' => $this->trans('Products material feature', 'Modules.Gshoppingflux.Admin'),
                'multiple' => true,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_MATERIAL,
                'required' => false,
            ])
            ->add('patterns', FeatureChoiceType::class, [
                'label' => $this->trans('Products pattern feature', 'Modules.Gshoppingflux.Admin'),
                'multiple' => true,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_PATTERN,
                'required' => false,
            ])
            ->add('sizes', FeatureChoiceType::class, [
                'label' => $this->trans('Products size feature', 'Modules.Gshoppingflux.Admin'),
                'multiple' => true,
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_SIZE,
                'required' => false,
            ])
            ->add('export_attributes', SwitchType::class, [
                'label' => $this->trans('Export attributes combinations', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('If checked, one product is exported for each attributes combination. Products should have at least one attribute filled in order to be exported as combinations.', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_ATTRIBUTES,
            ])
            ->add('no_gtin', SwitchType::class, [
                'label' => $this->trans('Export products with no GTIN code', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('Allow export of products, that no not have a GTIN code (EAN13/UPC)', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_NO_GTIN,
            ])
            ->add('shipping_dimension', SwitchType::class, [
                'label' => $this->trans('Export products shipping dimensions', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('Allow export of dimension for each products, if typed in product details', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_SHIPPING_DIMENSION,
            ])
            ->add('no_brand', SwitchType::class, [
                'label' => $this->trans('Export products with no brand', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('Allow export of products, that no not have a brand (Manufacturer)', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_NO_BRAND,
            ])
            ->add('id_exists_tag', SwitchType::class, [
                'label' => $this->trans('Set <identifier_exists> tag to FALSE', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('If your product is new (which you submit through the condition attribute) and it doesn’t have a gtin and brand or mpn and brand.', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_ID_EXISTS_TAG,
            ])
            ->add('export_nap', SwitchType::class, [
                'label' => $this->trans('Export non-available products', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_EXPORT_NAP,
            ])
            ->add('quantity', SwitchType::class, [
                'label' => $this->trans('Export product quantity', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_QUANTITY,
            ])
            ->add('featured_products', SwitchType::class, [
                'label' => $this->trans('Export "On Sale" indication', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_FEATURED_PRODUCTS,
            ])
            ->add('gen_file_in_root', SwitchType::class, [
                'label' => $this->trans('Generate the files to the root of the site', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_GEN_FILE_IN_ROOT,
            ])
            ->add('file_prefix', TextType::class, [
                'label' => $this->trans('Prefix for output filename', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('Allows you to prefix feed filename. Makes it a little harder for other to guess your feed names', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_FILE_PREFIX,
            ])
            ->add('autoexport_on_save', SwitchType::class, [
                'label' => $this->trans('Automatic export on saves?', 'Modules.Gshoppingflux.Admin'),
                'help' => $this->trans('When disabled, you have to "Save & Export" manually or run the CRON job, to generate new files.', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_AUTOEXPORT_ON_SAVE,
                'required' => false,
            ])
            ->add('store_code', TextType::class, [
                'label' => $this->trans('Your store code', 'Modules.Gshoppingflux.Admin'),
                'multistore_configuration_key' => GShoppingFluxDataConfiguration::GS_LOCAL_SHOP_CODE,
            ]);
    }

    /**
     * {@inheritdoc}
     *
     * @see MultistoreConfigurationTypeExtension
     */
    public function getParent(): string
    {
        return MultistoreConfigurationType::class;
    }
}
