<?php
namespace Nurdin\Mind\Model\Admin;

class AdminPasswordRequest
{
    public ?string $email = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}