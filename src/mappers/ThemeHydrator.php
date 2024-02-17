<?php

namespace app\mappers;

use app\entities\Theme;
use app\dto\Theme as ThemeDTO;

class ThemeHydrator {
    public function hydrate(array $data): Theme
    {
        return new Theme(
            (int) $data['theme_id'],
            (string) $data['theme_name']
        );
    }

    public function extract(ThemeDTO $theme): array
    {
        return [
            'theme_name' => $theme->getName()
        ];
    }
}
