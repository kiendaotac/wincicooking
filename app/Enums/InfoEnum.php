<?php

namespace App\Enums;

final class InfoEnum
{
    public const TYPE        = 'TYPE';
    public const RATION      = 'RATION';
    public const PREPARATION = 'PREPARATION';
    public const SPEND       = 'SPEND';
    public const ACCESSORY   = 'ACCESSORY';

    public const VALUE = [
        self::TYPE        => 'Loại công thức',
        self::RATION      => 'Khẩu phần',
        self::PREPARATION => 'Chuẩn bị',
        self::SPEND       => 'Nấu ăn',
        self::ACCESSORY   => 'Phụ kiện'
    ];
}