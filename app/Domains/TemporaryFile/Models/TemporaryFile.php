<?php

declare(strict_types=1);

namespace Domains\TemporaryFile\Models;

final class TemporaryFile extends \Illuminate\Database\Eloquent\Model
{

    protected $fillable = ['filename', 'folder'];
}
