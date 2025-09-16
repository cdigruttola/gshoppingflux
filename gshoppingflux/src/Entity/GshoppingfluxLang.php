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
 * @ORM\Entity(repositoryClass="cdigruttola\GShoppingFlux\Repository\GshoppingfluxLangRepository")
 * @ORM\Table()
 */
class GshoppingfluxLang
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_gcategory", type="integer", options={"unsigned":true})
     */
    private int $idGcategory;

    /**
     * @ORM\Id
     * @ORM\Column(name="id_lang", type="integer", options={"unsigned":true})
     */
    private int $idLang;

    /**
     * @ORM\Id
     * @ORM\Column(name="id_shop", type="integer", options={"unsigned":true})
     */
    private int $idShop;

    /** @ORM\Column(type="string", length=255) */
    private string $gcategory;

    /**
     * @ORM\ManyToOne(targetEntity="Gshoppingflux", inversedBy="translations")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="id_gcategory", referencedColumnName="id_gcategory"),
     *     @ORM\JoinColumn(name="id_shop", referencedColumnName="id_shop")
     * })
     */
    private ?Gshoppingflux $gshoppingflux = null;

    public function getIdGcategory(): int
    {
        return $this->idGcategory;
    }

    public function setIdGcategory(int $idGcategory): self
    {
        $this->idGcategory = $idGcategory;
        return $this;
    }

    public function getIdLang(): int
    {
        return $this->idLang;
    }

    public function setIdLang(int $idLang): self
    {
        $this->idLang = $idLang;
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

    public function getGcategory(): string
    {
        return $this->gcategory;
    }

    public function setGcategory(string $gcategory): self
    {
        $this->gcategory = $gcategory;
        return $this;
    }

    public function getGshoppingflux(): ?Gshoppingflux
    {
        return $this->gshoppingflux;
    }

    public function setGshoppingflux(?Gshoppingflux $gshoppingflux): self
    {
        $this->gshoppingflux = $gshoppingflux;
        return $this;
    }
}
