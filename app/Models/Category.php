<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $Articles
 * @property-read int|null $articles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 */
class Category extends Model
{
    use HasFactory;


    // KATEGORİYE AİT MAKALE SAYISINI GETİREN METOD
    public function Article_Count(){
        return $this->hasMany("App\Models\Article","category_id","id")->where("status","1")->count();
        // Bağlanacağımız Model, Bağlanacağımız Sütun, Bağlanacak Id
    }


    // KATEGORİYE AİT MAKALELERİ GETİREN METOD
    public function Articles(){
        return $this->hasMany(Article::class); # kategoriye ait makalelerin hepsini kolayca almak için oluşturduk. denme aşamasında.
        // laravelde tablolar arası ilişkilerde kolaylıkla kullanılır.
        // biz burada bire çok ilişkisine uygun bir tanımlama yaptık.
    }

}
