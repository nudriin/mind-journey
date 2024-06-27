<?php
namespace Nurdin\Mind\Model\Diary;

class EditDiaryRequest
{
    public ?string $id = null;
    public ?string $user_email = null;
    public ?string $title = null;
    public ?string $paragraph = null;
    public ?string $mood = null;
}