<?php

namespace App\Enums;

final class StatusEnum
{
    public const ACTIVE = 'ACTIVE';
    public const INACTIVE = 'INACTIVE';

    const VALUE = [
        self::ACTIVE => 'Kích hoạt',
        self::INACTIVE => 'Không kích hoạt'
    ];
}