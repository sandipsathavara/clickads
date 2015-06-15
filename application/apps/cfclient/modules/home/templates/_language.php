<?php if ($objRs->count() > 1) : ?>
    | <div id="dd" class="wrapper-dropdown-3" tabindex="1">
        <span><?php echo $sf_user->getAttribute('language') ? $sf_user->getAttribute('language') : 'English'; ?></span>
    </div>
    <ul class="dropdown">
        <?php foreach ($objRs as $oLang) : ?>
            <li><?php echo link_to($oLang['name'], '@change_lang?sf_culture=' . $oLang['culture'] . "&language=" . $oLang['name']); ?></li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>
