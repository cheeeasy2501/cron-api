<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'currency_id';

    protected $fillable = ['currency_name', 'currency_symbol', 'buy', 'sell'];
}
