<?php

namespace Laravel\Scout\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SearchableModelWithSensitiveAttributes extends Model
{
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'remember_token', 'password'];

    /**
     * When updating a model, this method determines if we
     * should perform a search engine update or not.
     *
     * @return bool
     */
    public function searchShouldUpdate(): bool
    {
        $sensitiveAttributeKeys = ['first_name', 'last_name'];

        return collect($this->getDirty())->keys()
            ->intersect($sensitiveAttributeKeys)
            ->isNotEmpty();
    }
}
