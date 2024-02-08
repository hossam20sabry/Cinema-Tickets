<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $guardName = $this->getGuardName();
        $userModel = Auth::guard($guardName)->user();
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(get_class($userModel))->ignore($userModel->id)],
        ];
    }

    /**
     * Get the guard name from the request.
     *
     * @return string
     */
    protected function getGuardName(): string
    {
        return explode('.', $this->route()->getName())[0] ?? 'web';
    }
}
