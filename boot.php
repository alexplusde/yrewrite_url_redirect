<?php

if (rex::isFrontend()) {
    $https = (rex_server('HTTPS', 'string', '') === 'on') || (rex_server('HTTP_X_FORWARDED_PROTO', 'string', '') === 'https');
    $site_address = ($https ? 'https' : 'http') . '://' . rex_server('HTTP_HOST', 'string', '');
    $request_uri = rex_server('REQUEST_URI', 'string', '');
    $parts = explode('?', $request_uri, 2);

    // Bei Artikeln ohne Trailing Slash diese zunächst dorthin weiterleiten.
    if (
        rex_config::get("yrewrite_url_redirect", "force_trailing_slash") &&
        rex_article::getCurrent() instanceof rex_article &&
        substr($parts[0], -1) !== "/"
    ) {
        $target = $site_address . $parts[0] . '/' . (isset($parts[1]) ? '?' . $parts[1] : '');
        rex_response::setStatus(rex_response::HTTP_MOVED_PERMANENTLY);
        rex_response::sendRedirect($target);
    }

    // Weiterleitungen in YRewrite immer ausführen, auch wenn Artikel / Medium vorhanden
    if (rex_config::get("yrewrite_url_redirect", "force_forward")) {
        $forward = rex_sql::factory()->getArray(
            "SELECT * FROM rex_yrewrite_forward WHERE `url` = ? LIMIT 1",
            [trim($request_uri, "/")]
        );

        if ($forward !== []) {
            $status = rex_yrewrite_forward::$movetypes[$forward[0]['movetype']] ?? rex_response::HTTP_MOVED_PERMANENTLY;
            rex_response::setStatus($status);

            if ($forward[0]['type'] == "article") {
                rex_response::sendRedirect(rex_getUrl($forward[0]['article_id'], $forward[0]['clang']));
            } elseif ($forward[0]['type'] == "extern") {
                rex_response::sendRedirect($forward[0]['extern']);
            } elseif ($forward[0]['type'] == "media") {
                rex_response::sendRedirect(rex_url::media($forward[0]['media']));
            }
        }
    }
}
