<?php

namespace App\Api\Domain\BrandAggregate;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "marcas";
    protected $fillable = [
        'nome',
        'imagem'
    ];

    public function __construct()
    {
        $numberOfArguments = func_num_args();

        if ($numberOfArguments > 0) {
            $arguments = func_get_args();
            call_user_func(array($this, 'builder'), $arguments);
        }
    }

    public function builder(String $name, String $image)
    {
        $this->nome = $name;
        $this->imagem = $image;
    }
}
