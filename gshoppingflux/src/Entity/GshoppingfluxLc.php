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
 * @author    cdigruttola <c.digruttola@hotmail.it>
 * @copyright Copyright since 2007 Carmine Di Gruttola
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
declare(strict_types=1);

namespace cdigruttola\GShoppingFlux\Entity;

if (!defined('_PS_VERSION_')) {
    exit;
}

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="cdigruttola\GShoppingFlux\Repository\GshoppingfluxLcRepository")
 * @ORM\Table()
 */
class GshoppingfluxLc
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_glang", type="integer", options={"unsigned":true})
     */
    private int $idGlang;

    /**
     * @ORM\Id
     * @ORM\Column(name="id_shop", type="integer", options={"unsigned":true})
     */
    private int $idShop;

    /** @ORM\Column(type="string", length=255, name="id_currency") */
    private string $idCurrency;

    /** @ORM\Column(type="boolean", name="tax_included", options={"default":0}) */
    private bool $taxIncluded = false;

    public function getIdGlang(): int
    {
        return $this->idGlang;
    }

    public function setIdGlang(int $idGlang): self
    {
        $this->idGlang = $idGlang;
        return $this;
    }

    public function getIdShop(): int
    {
        return $this->idShop;
    }

    public function setIdShop(int $idShop): self
    {
        $this->idShop = $idShop;
        return $this;
    }

    public function getIdCurrency(): string
    {
        return $this->idCurrency;
    }

    public function setIdCurrency(string $idCurrency): self
    {
        $this->idCurrency = $idCurrency;
        return $this;
    }

    public function isTaxIncluded(): bool
    {
        return $this->taxIncluded;
    }

    public function setTaxIncluded(bool $taxIncluded): self
    {
        $this->taxIncluded = $taxIncluded;
        return $this;
    }
}
