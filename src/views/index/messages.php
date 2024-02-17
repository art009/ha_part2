<?php
/**
 * @var Theme[] $themes
 * @var User $user
 */
use app\entities\Theme;
use app\entities\User;

?>
<div class="container mt-4">
    <div class="row">
        <div class="col-3">
            <div class="d-grid gap-2">
                <?php foreach ($themes as $theme):?>
                    <a class="btn btn-primary" href="/messages/themes?theme_id=<?=$theme->getId()?>"><?=$theme->getName()?></a>
                <?php endforeach;?>
            </div>
        </div>
        <div class="col-9">
            <h1><?=$user->getId()?>/<?=$user->getHash()?></h1>
        </div>

    </div>
</div>

