<?php
namespace Nurdin\Mind\Model\Chat;

class SendChatRequest
{
    public ?string $admin_email = null;
    public ?string $user_email = null;
    public ?string $message = null;
    public ?string $sender = null;

}