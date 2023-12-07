<?php

namespace App\Api\Domain\BrandAggregate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    
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
            call_user_func_array([$this, 'builder'], $arguments);
        }
    }

    public function builder(string $name, string $image)
    {
        $this->nome = $name;
        $this->imagem = $image;
    }
}
