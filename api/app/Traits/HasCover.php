<?php

namespace App\Traits;

trait HasCover
{
    public function coverUrl(string $folder, string $default = 'default.png'): string
    {
        if ($this->cover) {
            return asset('storage/' .  $folder . '/'. $this->cover);
        }

        return asset('storage/defaults/' . $default);
    }
}
