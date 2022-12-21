@if($getRecord()['data_type'] == \App\Enums\SettingsEnum::IMAGE)
    <img width="50px" height="50px" src="{{ asset(\Illuminate\Support\Facades\Storage::url($getRecord()['value'])) }}" alt="{{ $getRecord()['name'] }}">
@else
    {{ $getRecord()['value'] }}
@endif