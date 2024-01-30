<?php

namespace App\Api\Domain\CarAggregate;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $table = "carros";
    protected $filalbe = [
        'modelo_id',
        'placa',
        'disponivel',
        'km'
    ];

    public function __construct()
    {

        $numberOfArguments = func_num_args();

        if ($numberOfArguments > 0) {
            $arguments = func_get_args();
            call_user_func_array([$this, 'builder'], $arguments);
        }
    }

    protected function builder(int $modelo_id, string $placa, bool $disponivel, float $km)
    {
        $this->modelo_id = $modelo_id;
        $this->placa = $placa;
        $this->disponivel = $disponivel;
        $this->km = $km;
    }
}
