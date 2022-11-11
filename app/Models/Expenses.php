<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $primaryKey = 'id';

    // protected $fillable = [
    //     'expensetype_id',
    //     'branch_id',
    //     'amount',
    //     'description'
    // ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function expensetype()
    {
        return $this->belongsTo(Expensetype::class);
    }
}
