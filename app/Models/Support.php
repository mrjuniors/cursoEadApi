<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory, UuidTrait;

    public $incrementing = false;
    protected $KeyType = 'uuid';

    protected $fillable = ['status','description','lesson_id'];

    public $statusOptions = [
        'P'  => 'Pendente, A espera do Professor',
        'A'  => 'Agurdar resposta do Aluno',
        'C'  => 'Terminado',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }


}
