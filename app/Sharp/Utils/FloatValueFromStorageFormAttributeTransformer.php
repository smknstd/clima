<?php

namespace App\Sharp\Utils;

use Code16\Sharp\Utils\Transformers\SharpAttributeTransformer;

class FloatValueFromStorageFormAttributeTransformer implements SharpAttributeTransformer
{
    public function apply($value, $instance = null, $attribute = null)
    {
        return number_format($value/100, 2, ".", "");
    }
}
