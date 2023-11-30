<?php

namespace App\Api\Domain\ModelAggregate;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends EloquentModel
{
    use SoftDeletes;
    
    protected $table = "modelos";
    protected $filable = [
        'marca_id',
        'nome',
        'imagem',
        'numero_portas',
        'lugares',
        'air_bag',
        'abs'
    ];

    public function __construct()
    {
        $numberOfArguments = func_num_args();
        if ($numberOfArguments > 0) {
            $arguments = func_get_args();
            call_user_func_array([$this, 'builder'], $arguments);
        }
    }

    public function builder(
        int $marca_id,
        string $nome,
        string $imagem,
        int $numero_portas,
        int $lugares,
        bool $air_bag,
        bool $abs
    ) {
        $this->marca_id = $marca_id;
        $this->nome = $nome;
        $this->imagem = $imagem;
        $this->numero_portas = $numero_portas;
        $this->lugares = $lugares;
        $this->air_bag = $air_bag;
        $this->abs = $abs;
    }
}
