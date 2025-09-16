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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="cdigruttola\GShoppingFlux\Repository\GshoppingfluxRepository")
 * @ORM\Table()
 */
class Gshoppingflux
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id_gcategory", type="integer", options={"unsigned":true})
     */
    private int $idGcategory;

    /**
     * @ORM\Id
     * @ORM\Column(name="id_shop", type="integer", options={"unsigned":true})
     */
    private int $idShop;

    /** @ORM\Column(type="boolean", options={"default":0}) */
    private bool $export = false;

    /** @ORM\Column(type="string", length=12) */
    private string $condition;

    /** @ORM\Column(type="string", length=12) */
    private string $availability;

    /** @ORM\Column(type="string", length=8) */
    private string $gender;

    /** @ORM\Column(type="string", length=8, name="age_group") */
    private string $ageGroup;

    /** @ORM\Column(type="string", length=64) */
    private string $color;

    /** @ORM\Column(type="string", length=64) */
    private string $material;

    /** @ORM\Column(type="string", length=64) */
    private string $pattern;

    /** @ORM\Column(type="string", length=64) */
    private string $size;

    /**
     * @ORM\OneToMany(targetEntity="GshoppingfluxLang", mappedBy="gshoppingflux", cascade={"persist", "remove"})
     */
    private Collection $translations;

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    public function getIdGcategory(): int
    {
        return $this->idGcategory;
    }

    public function setIdGcategory(int $idGcategory): self
    {
        $this->idGcategory = $idGcategory;
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

    public function isExport(): bool
    {
        return $this->export;
    }

    public function setExport(bool $export): self
    {
        $this->export = $export;
        return $this;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function setCondition(string $condition): self
    {
        $this->condition = $condition;
        return $this;
    }

    public function getAvailability(): string
    {
        return $this->availability;
    }

    public function setAvailability(string $availability): self
    {
        $this->availability = $availability;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getAgeGroup(): string
    {
        return $this->ageGroup;
    }

    public function setAgeGroup(string $ageGroup): self
    {
        $this->ageGroup = $ageGroup;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function getMaterial(): string
    {
        return $this->material;
    }

    public function setMaterial(string $material): self
    {
        $this->material = $material;
        return $this;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function setPattern(string $pattern): self
    {
        $this->pattern = $pattern;
        return $this;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    /** @return Collection|GshoppingfluxLang[] */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(GshoppingfluxLang $translation): self
    {
        if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $translation->setGshoppingflux($this);
        }
        return $this;
    }

    public function removeTranslation(GshoppingfluxLang $translation): self
    {
        if ($this->translations->removeElement($translation)) {
            if ($translation->getGshoppingflux() === $this) {
                $translation->setGshoppingflux(null);
            }
        }
        return $this;
    }
}
