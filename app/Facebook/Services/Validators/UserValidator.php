<?php


namespace Facebook\Services\Validators;


use Crhayes\Validation\ContextualValidator;

class UserValidator extends ContextualValidator{

    protected $rules = [
        'register' => [
            'first_name'    => 'required|alpha',
            'last_name'     => 'required|alpha',
            'email'      => 'required|email|unique:users,email',
            'password'      => 'required|',
            'day'           => 'required|min:1|max:31',
            'month'         => 'required|',
            'year'          => 'required|',
            'gender'        => 'required|in:male,female'
        ],
        'activate' => [
            'email'  => 'required|email|exists:users,email',
            'code'   => 'required|'
        ]
    ];
} 