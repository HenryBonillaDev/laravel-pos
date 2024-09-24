<?php

namespace Src\User\Domain;

use Src\Entity\Domain\Entity;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private ?Entity $entity;
    private string $password;
    private array $roles;

    public function __construct(string $id, string $name, string $email, ?Entity $entity = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->entity = $entity;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEntity(): ?Entity
    {
        return $this->entity;
    }

    public function setEntity(?Entity $entity): void
    {
        $this->entity = $entity;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
