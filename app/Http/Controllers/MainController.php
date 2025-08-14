<?php
namespace App\Http\Controllers;

use App\Http\Requests\MainRequest;

use App\Service\CifrasJump;

class MainController extends Controller
{
    private string $texto = '';
    private    int $fator = 0;

    public function __construct(MainRequest $request)
    {
        $this->texto = $request->get('texto');
        $this->fator = $request->get('fator');
    }

    public function main()
    {
        $response = (new CifrasJump)->converter($this->texto, $this->fator);
        
        dd('END');
    }

    
}
