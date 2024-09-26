<?php

namespace App\UseCases\Register;

use App\PatternDesigns\Register\TemplateMethod\RegisterLanguages;


class GetRegisterMainUseCase
{
    private RegisterLanguages $registerLanguages;

    public function __construct(
        RegisterLanguages $registerLanguages,
    ) {
        $this->registerLanguages = $registerLanguages;
    }

    public function __invoke($registers)
    {
        $register = array();
        foreach ($registers->register as $reg) {
            $name = strtolower($reg['name']);
            switch ($name) {
                case "languages":
                    $register[$name] = $this->registerLanguages->getRegister();
                break;
            }
        }
        return $register;
    }
}
