<?php

namespace App\Entity;

use App\Entity\Responses;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\DevicesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="devices")
 * @ORM\Entity(repositoryClass="App\Repository\DevicesRepository")
 */
class Devices
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="ID_Device", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="DeviceName", type="string", length=50, nullable=false)
     */
    private $DeviceName;

    /**
     * @ORM\Column(name="DeviceMac", type="string", length=17, nullable=true)
     */
    private $DeviceMac;

    /**
     * @ORM\OneToMany(targetEntity=Responses::class, mappedBy="devices", orphanRemoval=true)
     */
    private $responses;

    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceName(): ?string
    {
        return $this->DeviceName;
    }

    public function setDeviceName(string $DeviceName): self
    {
        $this->DeviceName = $DeviceName;

        return $this;
    }

    public function getDeviceMac(): ?string
    {
        return $this->DeviceMac;
    }

    public function setDeviceMac(?string $DeviceMac): self
    {
        $this->DeviceMac = $DeviceMac;

        return $this;
    }

    /**
     * @return Collection|Responses[]
     */
    public function getResponses(): Collection
    {
        return $this->responses;
    }

    public function addResponse(Responses $response): self
    {
        if (!$this->responses->contains($response)) {
            $this->responses[] = $response;
            $response->setDevices($this);
        }

        return $this;
    }

    public function removeResponse(Responses $response): self
    {
        if ($this->responses->removeElement($response)) {
            // set the owning side to null (unless already changed)
            if ($response->getDevices() === $this) {
                $response->setDevices(null);
            }
        }

        return $this;
    }
}
