<?php

/*
 * This file is part of persian validation package
 *
 * (c) Farhad Zand <farhad.pd@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Iamfarhad\Validation\Contracts;


use Iamfarhad\Validation\Exception\ValidationRuleEmptyException;
use Illuminate\Support\ServiceProvider;
use Validator;
use App;

abstract class AbstractValidationRule
{
    public $validationRule = null;

    /**
     * Set validation Rule name
     *
     * @param string $name
     */
    public function setValidationRule(string $name): void
    {
        $this->validationRule = $name;
    }

    /**
     * Get validation Rule name
     *
     * @return string
     */
    public function getValidationRule(): string
    {
        return $this->validationRule;
    }

    /**
     * Register laravel validation extension
     */
    public function register(): void
    {
        \Validator::extend($this->getValidationRule(), function ($attribute, $value, $parameters, $validator) {
            return $this->rule($attribute, $value, $parameters, $validator);
        });
        \Validator::replacer($this->getValidationRule(), 'ValidationMessages@message');
    }
}