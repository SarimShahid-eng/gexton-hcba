<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LibraryItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // For update: id is required; for store: id should not be present
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch') || $this->filled('id');

        return [
            'id' => [$isUpdate ? 'required' : 'prohibited', 'integer', 'exists:library_items,id'],

            'title' => ['required', 'string', 'max:200'],
            'type' => ['required', 'in:book,journal,e-journal'],
            'author_name' => ['required'],
            // author name 
            'status' => ['sometimes', 'required', 'in:available,borrowed'],
            'rfid_tag' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('library_items', 'rfid_tag')->ignore($this->input('id')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'The library item ID is required for updating.',
            'id.exists' => 'The selected library item does not exist.',
            'id.prohibited' => 'ID should not be provided when creating a new item.',

            'title.required' => 'The title is required.',
            'title.max' => 'The title may not exceed 200 characters.',

            'type.required' => 'Please select an item type.',
            'type.in' => 'The type must be Book, Journal, or E-Journal.',

            'rfid_tag.unique' => 'This RFID tag is already assigned to another library item.',
        ];
    }
}
