<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'kursus';

    protected $fillable = [
        'id_kategori', 'id_tutor', 'nama_kursus', 'slug', 'gambar_kursus', 'biaya_kursus', 'diskon_kursus', 'lama_kursus',
        'latitude', 'longitude', 'keterangan'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public $appends = [
        'coordinate', 'map_popup_content',
    ];

    /**
     * Get outlet name_link attribute.
     *
     * @return string
     */

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->nama_kursus, 'type' => 'kursus',
        ]);
        $link = '<a href="' . route('front.detail', $this->slug) . '"';
        $link .= ' title="' . $title . '">';
        $link .= $this->nama_kursus;
        $link .= '</a>';

        return $link;
    }

    /**
     * Outlet belongs to User model relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function creator()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Get outlet coordinate attribute.
     *
     * @return string|null
     */
    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude . ', ' . $this->longitude;
        }
    }

    /**
     * Get outlet map_popup_content attribute.
     *
     * @return string
     */
    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2"><strong>Nama Kursus:</strong><br>' . $this->name_link . '</div>';
        $mapPopupContent .= '<div class="my-2"><strong>' . __('outlet.coordinate') . ':</strong><br>' . $this->coordinate . '</div>';

        return $mapPopupContent;
    }
}
