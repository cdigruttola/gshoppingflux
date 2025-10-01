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
namespace cdigruttola\GShoppingFlux\Controller;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Form\Handler;
use PrestaShopBundle\Controller\Admin\PrestaShopAdminController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;

class GShoppingFluxController extends PrestaShopAdminController
{
    public function configAction(
        Request $request,
        #[Autowire(service: 'cdigruttola.gshoppingflux.configuration.handler.configuration_data_handler')]
        Handler $handler,
    ) {
        $textForm = $handler->getForm();
        $textForm->handleRequest($request);

        if ($textForm->isSubmitted() && $textForm->isValid()) {
            /** You can return array of errors in form handler and they can be displayed to user with flashErrors */
            $errors = $handler->save($textForm->getData());

            empty($errors) ?
                $this->addFlash('success', $this->trans('Successful update.', [], 'Admin.Notifications.Success')) :
                $this->addFlashErrors($errors);
        }

        return $this->render('@Modules/gshoppingflux/views/templates/admin/configuration.html.twig',
            [
                'form' => $textForm->createView(),
            ]
        );
    }
}
