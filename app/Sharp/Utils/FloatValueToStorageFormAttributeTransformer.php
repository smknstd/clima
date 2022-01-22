<?php

namespace App\Sharp\Utils;

use Code16\Sharp\Utils\Transformers\SharpAttributeTransformer;

class FloatValueToStorageFormAttributeTransformer implements SharpAttributeTransformer
{
    public function applyIfAttributeIsMissing()
    {
        return false;
    }

    public function apply($value, $instance = null, $attribute = null)
    {
        $value = (float) str_replace(",", ".", $value);

        return (int) round($value * 100, 0);
    }
}
