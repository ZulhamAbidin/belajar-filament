<?php

namespace App\Filament\Resources\PostinganResource\Pages;

use App\Filament\Resources\PostinganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePostingan extends CreateRecord
{
    protected static string $resource = PostinganResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
