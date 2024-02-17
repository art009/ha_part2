<?php

namespace app\mappers;

use app\entities\Theme;

class ThemeHydrator {
    public function hydrate(array $data): Theme
    {
        return new Theme(
            (int) $data['theme_id'],
            (string) $data['theme_name']
        );
    }

    public function extract(Theme $theme): array
    {
        return [
            'theme_id' => $theme->getId(),
            'theme_name' => $theme->getName()
        ];
    }
}
