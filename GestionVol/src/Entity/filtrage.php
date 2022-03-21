<?php
namespace App\Entity;

class filtrage{

    /**
     * @var int|null
     */
    private $maxetoiles;
    /**
     * @var string|null
     */
    private $adresseS;

    /**
     * @return int|null
     */
    public function getMaxetoiles(): ?int
    {
        return $this->maxetoiles;
    }

    /**
     * @param int|null $maxetoiles
     * @return filtrage
     */
    public function setMaxetoiles(int $maxetoiles): filtrage
    {
        $this->maxetoiles = $maxetoiles;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresseS(): ?string
    {
        return $this->adresseS;
    }

    /**
     * @param string|null $adresseS
     * @return filtrage
     */
    public function setAdresseS(string $adresseS): filtrage
    {
        $this->adresseS = $adresseS;
        return $this;
    }



}