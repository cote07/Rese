<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $today = Carbon::today()->toDateString();
        $currentTime = Carbon::now()->format('H:i');

        return [
            'date' => ['required', 'after_or_equal:' . $today],
            'time' => ['required', 'after_or_equal:' . ($this->date == $today ? $currentTime : '00:00')],
            'number' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付は必須です',
            'date.after_or_equal' => '日付は今日以降を選択してください',
            'time.required' => '時間は必須です',
            'time.after_or_equal' => '時間は現在時刻以降を選択してください',
            'number.required' => '人数は必須です',
        ];
    }
}