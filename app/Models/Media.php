<?php

namespace App\Models;

use Code16\Sharp\Form\Eloquent\Uploads\SharpUploadModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends SharpUploadModel
{
    use HasFactory;

    protected $table = 'medias';

    public function thumbnailFit(int $width, int $height): ?string
    {
        return $this->thumbnail($width, $height, ["fit" => ["w"=>$width, "h"=>$height]]);
    }
}
