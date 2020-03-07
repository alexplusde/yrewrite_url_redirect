<?php

if (rex::isFrontend()) {
    $site_adress = (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    $parts = explode('?', $_SERVER['REQUEST_URI'], 2);

    // Bei Artikeln ohne Trailing Slash diese zunächst dorthin weiterleiten.
    if (rex_config::get("yrewrite_url_redirect", "force_trailing_slash") && rex_article::getCurrent() instanceof rex_article && substr($parts[0], -1) !== "/") {
        $target = $site_adress . $parts[0].'/'. (isset($parts[1]) ? '?'.$parts[1] : '');
        header('HTTP/1.1 '.rex_yrewrite_forward::$movetypes[301]);
        header('Location: '.$target);
        exit;
    }

    // Weiterleitungen in YRewrite immer ausführen, auch wenn Artikel / Medium vorhanden
    if (rex_config::get("yrewrite_url_redirect", "force_forward")) {
        $forward = rex_sql::factory()->getArray("SELECT * FROM rex_yrewrite_forward WHERE `url` = ? LIMIT 1", [trim($_SERVER['REQUEST_URI'], "/")]);
        
        if ($forward !== []) {
            header('HTTP/1.1 '.rex_yrewrite_forward::$movetypes[$forward[0]['movetype']]);
            if ($forward[0]['type'] == "article") {
                header('Location: ' . rex_getUrl($forward[0]['article_id'], $forward[0]['clang']));
                exit;
            } elseif ($forward[0]['type'] == "extern") {
                header('Location: ' . $forward[0]['extern']);
                exit;
            } elseif ($forward[0]['type'] == "media") {
                header('Location: ' . rex_url::media($forward[0]['media']));
                exit;
            }
        }
   }
}