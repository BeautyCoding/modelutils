<?php

namespace BeautyCoding\ModelUtils\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Ramsey\Uuid\Uuid;

trait UuidModel
{
    /**
     * Registering uuid listeners
     */
    public static function bootUuidModel()
    {
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid5(Uuid::NAMESPACE_DNS, sprintf('%s.%s.%s.%s', rand(0, time()), time(), static::class, config('modelutils.namespace')))->toString();
        });

        static::saving(function ($model) {
            $originalUuid = $model->getOriginal('uuid');

            // Preventing lateral modifying uuid
            if ($originalUuid !== $model->uuid) {
                $model->uuid = $originalUuid;
            }
        });
    }

    /**
     * Method searching model by uuid
     * @param  QueryBuilder $query
     * @param  String       $uuid
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeUuid($query, $uuid)
    {
        if (!Uuid::isValid($uuid)) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        return $query->where('uuid', '=', $uuid);
    }

    /**
     * Method for searching model by Id or Uuid
     * @param  QueryBuilder $query
     * @param  Int|Uuid $value
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeIdOrUuid($query, $value)
    {
        if (!Uuid::isValid($value) && !is_numeric($value)) {
            throw (new ModelNotFoundException)->setModel(get_class($this));
        }

        return $query->where($this->primaryKey, '=', $value)->orWhere('uuid', '=', $value);
    }

    /**
     * Method returns models geted by uuid
     * @param  Builder $query
     * @param  array|tring $uuid  uuid or list of uuids
     * @return Collection|Model Single model or collection of models
     */
    public function scopeFindByUuid($query, $uuid)
    {
        if (!is_array($uuid)) {
            if (!Uuid::isValid($uuid)) {
                throw (new ModelNotFoundException)->setModel(get_class($this));
            }

            return $query->where('uuid', $uuid)->first();

        } elseif (is_array($uuid)) {
            array_map(function ($element) {
                if (!Uuid::isValid($element)) {
                    throw (new ModelNotFoundException)->setModel(get_class($this));
                }
            }, $uuid);

            return $query->whereIn('uuid', $uuid)->get();
        }

    }
}
