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
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\DefaultLanguage;
use PrestaShopBundle\Form\Admin\Type\MultistoreConfigurationType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

if (!defined('_PS_VERSION_')) {
    exit;
}

class GShoppingFluxConfigurationType extends TranslatorAwareType
{
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
