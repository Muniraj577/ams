<?php

namespace App\Enum;

enum RoleEnum: string
{
    case SUPER_ADMIN = 'super_admin';
    case ARTIST_MANAGER = 'artist_manager';
    case ARTIST = 'artist';
}