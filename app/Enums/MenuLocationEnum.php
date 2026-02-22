<?php

namespace App\Enums;

enum MenuLocationEnum: string
{
    case HEADER = 'header';
    case FOOTER = 'footer';
    case SIDEBAR = 'sidebar';

    public function label(): string
    {
        return match ($this) {
            self::HEADER => 'Header',
            self::FOOTER => 'Footer',
            self::SIDEBAR => 'Sidebar',
        };
    }
}
