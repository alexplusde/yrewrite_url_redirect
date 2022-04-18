# YRewrite URL Redirect (Entwicklung eingestellt)

Ändert das Standard-Verhalten von YRewrite und des URL-Addons in Bezug auf Weiterleitungen und Erreichbarkeit von URLs mit und ohne Trailing Slash.

> **Hinweis:** Die Installation wird nur empfohlen, wenn man keine widersprüchlichen Einstellungen aktiviert hat, z.B. via YRewrite-Scheme-Addon die Endung `.html` möchte, statt `/`.

## Installation

Via Installer installieren. Nach der Installation befindet sich eine Seite mit Einstellungen unter `YRewrite` > `Optionen zur Weiterleitung`.

## Einstellungen

### Trailing Slash forcieren	

Aktivieren, um URLs ohne Slash am Ende auf die URL mit Slash am Ende weiterzuleiten. Gilt nur im Frontend und bei Artikeln. Aus

`example.org/article?foo=bar` wird `example.org/article/?foo=bar`

Behebt des Weiteren das Problem, dass URLs, die durch das URL-Addon generiert wurden, nur unter der Variante mit / erreichbar sind. 

### Weiterleitungen priorisieren	

Aktivieren, um Weiterleitungen in YRewrite zu priorisieren. Möglicherweise vorhandene URLs in Artikel und Schemen werden ignoriert. Das Standard-Verhalten von YRewrite ist, Weiterleitungen nicht auszuführen, wenn ein passender Artikel gefunden wurde.

## Credits

Alexander Walther: https://www.alexplus.de

Danke an @rotzek für die Beauftragung
