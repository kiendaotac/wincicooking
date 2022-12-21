<?php

namespace App\Enums;

final class SettingsEnum
{
    public const LOGO = 'LOGO';
    public const TEXT = 'TEXT';
    public const IMAGE = 'IMAGE';
    public const FILE = 'FILE';

    const TYPE = [
        self::LOGO => 'Logo',
    ];
    const DATA_TYPE = [
        self::TEXT => 'Chữ',
        self::IMAGE => 'Hình ảnh',
    ];
}