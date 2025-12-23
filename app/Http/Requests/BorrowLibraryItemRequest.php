<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Borrowing;

class BorrowLibraryItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust based on your auth logic
    }

    public function rules(): array
    {
        $rules = [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'cnic_number' => [
                'required',
                'digits:13',
                'regex:/^\d{13}$/',
                Rule::exists('users', 'cnic')->where('id', $this->user_id),
            ],

            'return_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ];

        // Rules for library_item_id (different for store vs update)
        if ($this->isMethod('post')) {
            // Creating new borrowing
            $rules['library_item_id'] = [
                'required',
                'integer',
                'exists:library_items,id',
                // Custom rule: item must not have an active (borrowed) borrowing
                function ($attribute, $value, $fail) {
                    $activeBorrowing = Borrowing::where('library_item_id', $value)
                        ->where('status', 'borrowed')
                        ->exists();

                    if ($activeBorrowing) {
                        $fail('This item is already borrowed and not available.');
                    }
                },
                // Prevent same user from borrowing same item twice without return
                Rule::unique('borrowings', 'library_item_id')
                    ->where('user_id', $this->user_id)
                    ->where('status', 'borrowed'),
            ];
        } else {
            // Updating existing borrowing (e.g., marking as returned)
            $rules['library_item_id'] = [
                'sometimes',
                'integer',
                'exists:library_items,id',
            ];

            // Optional: allow updating status
            $rules['status'] = [
                'sometimes',
                'in:borrowed,returned',
            ];
        }

        // ID is only needed for update
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['id'] = ['required', 'integer', 'exists:borrowings,id'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'library_item_id.required' => 'Please select a library item.',
            'library_item_id.exists'   => 'The selected item does not exist.',

            'user_id.required' => 'User ID is required.',
            'user_id.exists'   => 'The selected user does not exist.',

            'cnic_number.required' => 'CNIC number is required.',
            'cnic_number.digits'   => 'CNIC must be exactly 13 digits.',
            'cnic_number.regex'    => 'CNIC must contain only digits.',
            'cnic_number.exists'   => 'The provided CNIC does not match the user\'s registered CNIC.',

            'return_date.required'      => 'Expected return date is required.',
            'return_date.date'          => 'Return date must be a valid date.',
            'return_date.after_or_equal'=> 'Return date cannot be in the past.',

            'status.in' => 'Status must be either borrowed or returned.',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('cnic_number')) {
            $this->merge([
                'cnic_number' => preg_replace('/\D/', '', $this->cnic_number),
            ]);
        }
    }
}