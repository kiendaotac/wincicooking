<?php

namespace App\Http\Controllers\Api;

use App\Enums\SettingsEnum;
use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function getLogo(): JsonResponse
    {
        $logo = Settings::where('type', SettingsEnum::LOGO)->where('data_type', SettingsEnum::IMAGE)->whereStatus(StatusEnum::ACTIVE)->first();
        return response()->json([
            'data' => $logo ? asset(Storage::url($logo->value)) : null
        ]);
    }
}
