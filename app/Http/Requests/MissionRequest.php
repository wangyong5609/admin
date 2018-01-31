<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissionRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'post_id' => 'required',
            'status' => 'required',
            'description' => 'string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'complete_time' => 'date',
            'amount' => 'required|numeric',
            'staff_id' => 'integer',
            'upper' => 'required|numeric'
        ];
    }

    public $attributes = [
        'name' => '任务名称',
        'start_time' => '起始时间',
        'end_time' => '结束时间',
        'amount' => '任务量',
        'upper' => '上限'
    ];
}
