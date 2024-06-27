<?php
namespace Nurdin\Mind\Domain;

class Chat
{
    public string $id;
    public string $admin_email;
    public string $user_email;
    public string $message;
    public string $sender;
}