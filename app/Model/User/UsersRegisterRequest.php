<?php
namespace Nurdin\Mind\Model\User;

class UsersRegisterRequest
{
    public ?string $email = null;
    public ?string $name = null;
    public ?string $password = null;
}