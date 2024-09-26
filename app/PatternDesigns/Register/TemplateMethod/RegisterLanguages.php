<?php
namespace App\PatternDesigns\Register\TemplateMethod;

use App\UseCases\Register\Languages\Find\FindLanguagesAllUseCase;

class RegisterLanguages extends Register
{
    private FindLanguagesAllUseCase $findLanguagesAllUseCase; 

    public function __construct( FindLanguagesAllUseCase $findLanguagesAllUseCase ) {
        $this->findLanguagesAllUseCase = $findLanguagesAllUseCase; 
    }

    public function getRegister() {
        return $this->findLanguagesAllUseCase->__invoke();
    }

}