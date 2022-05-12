<?php

namespace PTC\Classes;

use PTC\Classes\Validator\Validator;
use Somnambulist\Components\Validation\Validation;

class Request
{

    private array $validated = [];

    private bool $isValidatorError = false;

    private bool $isValidated = false;

    private array $errors = [];

    private array $invalidData = [];

    public function __construct(private Validator $validator)
    {
    }

    /**
     * @return array
     */
    public function allPost(): array
    {
        return $_POST + $_FILES;
    }


    /**
     * @param string $name
     * @return Validation
     * @throws Exception\ValidatorNotFoundException
     * @throws \Exception
     */
    public function validatePostsAndFiles(string $name): Validation
    {
        $preparer = $this->validator->makeFromValidator($this->allPost(), $name);
        $validateResult = $preparer->validate();
        $this->isValidated = true;
        if ($validateResult->fails()) {
            $this->isValidatorError = true;
            $this->errors = $validateResult->errors()->firstOfAll();
            $this->validated = $validateResult->getValidData();
            $this->invalidData = $validateResult->getInvalidData();
            return $validateResult;
        }
        $this->validated = $validateResult->getValidData();
        $this->invalidData = $validateResult->getInvalidData();
        $this->errors = $validateResult->errors()->firstOfAll();
        return $validateResult;
    }

    /**
     * @return array
     */
    public function getValidated(): array
    {
        return $this->validated;
    }

    /**
     * @return bool
     */
    public function isValidatorError(): bool
    {
        return $this->isValidatorError;
    }

    /**
     * @return bool
     */
    public function isValidated(): bool
    {
        return $this->isValidated;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getInvalidData(): array
    {
        return $this->invalidData;
    }


}