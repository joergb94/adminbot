<?php
namespace App\UseCases\Register\Languages\Find;

use App\Repositories\LanguageRepository;

final class FindLanguagesAllUseCase
{
    private LanguageRepository $LanguageRepository;

    public function __construct( LanguageRepository $LanguageRepository ){
        $this->LanguageRepository = $LanguageRepository; 
    }

    public function __invoke(){
        return $this->LanguageRepository->findAll();
    }

}