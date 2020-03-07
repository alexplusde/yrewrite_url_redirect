<?php

$addon = rex_addon::get('yrewrite_url_redirect');

echo rex_view::title($addon->i18n('title'));

rex_be_controller::includeCurrentPageSubPath();