<?php
namespace Nurdin\Mind\Model\User;

class UserPasswordRequest
{
    public ?string $email = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}