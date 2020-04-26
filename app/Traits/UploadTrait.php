<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait
{   /** se '$imageColumn vier nulo é a imagem do logo de store, se diferente de null 
     * é pq é o array com as fotos do produto */

    private function imageUpload($images, $imageColumn = null)
    { 
        // $images = $request->file('photos');
 
        $uploadedImages = [];

        // if(!isNull($imageColumn)) ou como abaixo que fica mais genérico 
        if(is_array($images))

        {
            foreach ($images as $image) 
            {
                    $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
            }
        } else
        {
            $uploadedImages = $images->store('logo', 'public');
        }
      
        return $uploadedImages;
    }
}
