<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable',
            'product_code' => 'required',
            'unit_code' => 'required',
            'category_code' => 'required',
            'product_transaction_id' => 'required',
            'transaction_date' => 'nullable|date_format:Y-m-d H:i:s',
            'transaction_type' => 'nullable',
            'qty_in' => 'nullable',
            'qty_out' => 'nullable',
            'qty_on_hand' => 'nullable',
            'description' => 'nullable',
            'created_at' => 'nullable|date_format:Y-m-d H:i:s',
            'updated_at' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
