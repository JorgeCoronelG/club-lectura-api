<?php

namespace App\Http\Requests\Navigation;

use App\Core\Contracts\ReturnDataInterface;
use Illuminate\Foundation\Http\FormRequest;

class SyncNavigationRequest extends FormRequest implements ReturnDataInterface
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
            'menus' => ['required', 'array'],
            'menus.*' => ['numeric'],
            'submenus' => ['required', 'array'],
            'submenus.*' => ['numeric']
        ];
    }

    public function attributes(): array
    {
        return [
            'menus' => 'Menús',
            'menus.*' => 'Menú :position',
            'submenus' => 'Submenús',
            'submenus.*' => 'Submenú :position'
        ];
    }

    /**
     * @return array
     */
    public function toData(): array
    {
        return [
            'menus' => $this->menus,
            'submenus' => $this->submenus,
        ];
    }
}
