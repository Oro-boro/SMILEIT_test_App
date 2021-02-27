<?php

namespace App\Entity;

use App\Entity\Devices;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ResponsesRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="responses", indexes={@ORM\Index(name="ID_Device", columns={"ID_Device"})})
 * @ORM\Entity(repositoryClass="App\Repository\ResponsesRepository")
 */
class Responses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="ID_Response", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="ResponseValue",type="integer", nullable=true)
     * @Assert\Range(min = 0, max = 2,)
     */
    private $ResponseValue;

    /**
     * @ORM\Column(name="ResponseDate", type="date", nullable=true)
     */
    private $ResponseDate;

    /**
     * @ORM\Column(name="ResponseTime", type="time", nullable=true)
     */
    private $ResponseTime;

    /**
     * @ORM\ManyToOne(targetEntity=Devices::class, inversedBy="responses")
     * @ORM\JoinColumn(name="ID_Device", referencedColumnName="ID_Device")
     */
    private $devices;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResponseValue(): ?int
    {
        return $this->ResponseValue;
    }

    public function setResponseValue(?int $ResponseValue): self
    {
        $this->ResponseValue = $ResponseValue;

        return $this;
    }

    public function getResponseDate(): ?\DateTimeInterface
    {
        return $this->ResponseDate;
    }

    public function setResponseDate(?\DateTimeInterface $ResponseDate): self
    {
        $this->ResponseDate = $ResponseDate;

        return $this;
    }

    public function getResponseTime(): ?\DateTimeInterface
    {
        return $this->ResponseTime;
    }

    public function setResponseTime(?\DateTimeInterface $ResponseTime): self
    {
        $this->ResponseTime = $ResponseTime;

        return $this;
    }

    public function getDevices(): ?Devices
    {
        return $this->devices;
    }

    public function setDevices(?Devices $devices): self
    {
        $this->devices = $devices;

        return $this;
    }
}