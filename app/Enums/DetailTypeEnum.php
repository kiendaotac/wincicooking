<?php

namespace App\Enums;

final class DetailTypeEnum
{
    public const DETAIL      = 'DETAIL';
    public const INGREDIENTS = 'INGREDIENTS';
    public const NUTRITIONAL = 'NUTRITIONAL';
    public const INGREDIENTS_NUTRITIONAL = 'INGREDIENTS_NUTRITIONAL';

    const VALUE = [
        self::DETAIL                  => 'Chi tiết',
        self::INGREDIENTS             => 'Thành Phần',
        self::NUTRITIONAL             => 'Dinh dưỡng',
        self::INGREDIENTS_NUTRITIONAL => 'Thành phần dinh dưỡng'
    ];

    const DETAIL_VALUE = [
        'TYPE' => 'Loại công thức',
        'RATION' => 'Khẩu phần',
        'PREPARATION' => 'Thời gian chuẩn bị',
        'SPEND' => 'Thời gian nấu',
        'ACCESSORY' => 'Phụ kiện'
    ];
}