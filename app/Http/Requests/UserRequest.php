<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'role_id' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'username' => 'required|unique:users,username,' . $this->id,
        ];

        if ( ! $this->id) {
            $rules['password'] = 'required|min:8';
        }

        return $rules;
    }
}