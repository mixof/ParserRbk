<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Модель новости
 */
class Feed extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "url",
        "image_url"
    ];

    /**
     * Получить краткое содержание новости (200 символов)
     * @return string
     */
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->description),200);
    }
}
