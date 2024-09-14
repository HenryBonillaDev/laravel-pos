<?php

namespace Src\Customer\Domain;

use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class Customer implements \Stringable
{
    private string $id;
    private string $name;
    private string $lastName;
    private string $docType;
    private string $dni;
    private string $email;

    public function __construct(
        string $id,
        string $name,
        string $lastName,
        string $docType,
        string $dni,
        string $email
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->docType = $docType;
        $this->dni = $dni;
        $this->email = $email;
    }

    public static function create(
        string $name,
        string $lastName,
        string $docType,
        string $dni,
        string $email
    ): self
    {
        $id = Uuid::uuid4()->toString();
//        self::validate($name, $lastName, $docType, $dni, $email);
        return new self($id, $name, $lastName, $docType, $dni, $email);
    }

    public function updateDetails(
        string $name,
        string $lastName,
        string $docType,
        string $dni,
        string $email
    ): void
    {
//        self::validate($name, $lastName, $docType, $dni, $email);
        $this->name = $name;
        $this->lastName = $lastName;
        $this->docType = $docType;
        $this->dni = $dni;
        $this->email = $email;
    }

    private static function validate(
        string $name,
        string $lastName,
        string $docType,
        string $dni,
        string $email
    ): void
    {
        if (empty($name) || empty($lastName) || empty($docType) || empty($dni) || empty($email)) {
            throw new \InvalidArgumentException('Todos los campos son obligatorios.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('El correo electrónico no es válido.');
        }

    }

    // Getters
    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function docType(): string
    {
        return $this->docType;
    }

    public function dni(): string
    {
        return $this->dni;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'docType' => $this->docType,
            'dni' => $this->dni,
            'email' => $this->email
        ];
    }

    public function __toString()
    {
        return sprintf(
            'Customer { id: %s, name: %s, lastName: %s, docType: %s, dni: %s, email: %s }',
            $this->id,
            $this->name,
            $this->lastName,
            $this->docType,
            $this->dni,
            $this->email
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'docType' => $this->docType,
            'dni' => $this->dni,
            'email' => $this->email
        ];
    }
}
