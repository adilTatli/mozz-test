<?php

namespace App\Models;

use App\Http\Requests\PostRequest;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'category_id',
        'image',
        'is_published'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getIsPublishedAttribute()
    {
        return $this->attributes['is_published'];
    }

    public function setIsPublishedAttribute($value)
    {
        $this->attributes['is_published'] = (bool)$value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function uploadImage(PostRequest $request, $currentImage = null)
    {
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');

            $allowedTypes = ['jpeg', 'png', 'jpg', 'gif'];
            $extension = $uploadedFile->getClientOriginalExtension();
            if (!in_array($extension, $allowedTypes)) {
                throw new \InvalidArgumentException('Недопустимый тип файла. Поддерживаемые форматы: jpeg, png, jpg, gif');
            }

            $maxSize = 2048;
            if ($uploadedFile->getSize() > $maxSize * 1024) {
                throw new \InvalidArgumentException('Размер файла превышает максимально допустимый размер 2MB');
            }

            if ($currentImage && Storage::exists($currentImage)) {
                Storage::delete($currentImage);
            }

            $folder = date('Y-m-d');
            $filename = uniqid() . '_' . $uploadedFile->getClientOriginalName();
            $path = $uploadedFile->store("/images/{$folder}", 'public');

            return $path;
        }

        return $currentImage;
    }

    public function getImage()
    {
        if (!$this->image) {
            return Storage::url('no-image-icon.png');
        }

        $storageUrl = Storage::url("{$this->image}");

        return asset($storageUrl);
    }
}
