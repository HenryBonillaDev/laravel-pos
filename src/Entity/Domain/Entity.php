<?php

namespace Src\Entity\Domain;

class Entity
{
    private string $id;
    private string $name;
    private string $type;
    private string $description;
    private string $url;
    private string $image;
    private int $nit;
    private string $social_reason;

    public function __construct()
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getNit(): int
    {
        return $this->nit;
    }

    public function setNit(int $nit): void
    {
        $this->nit = $nit;
    }

    public function getSocialReason(): string
    {
        return $this->social_reason;
    }

    public function setSocialReason(string $social_reason): void
    {
        $this->social_reason = $social_reason;
    }


}
