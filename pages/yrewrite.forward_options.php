<?php
$form = rex_config_form::factory($this->getProperty('package'));

$field = $form->addSelectField('force_trailing_slash');
$field->setLabel("Trailing Slash forcieren");
$select = $field->getSelect();
$select->setSize(1);
$select->addOption("ja", '1');
$select->addOption("nein", '0');
$field->setNotice("Aktivieren, um URLs ohne Slash am Ende auf die URL mit Slash am Ende weiterzuleiten. Gilt nur im Frontend und bei Artikeln.");

$field = $form->addSelectField('force_forward');
$field->setLabel("Weiterleitungen priorisieren");
$select = $field->getSelect();
$select->setSize(1);
$select->addOption("ja", '1');
$select->addOption("nein", '0');
$field->setNotice("Aktivieren, um Weiterleitungen in YRewrite zu priorisieren. Möglicherweise vorhandene URLs in Artikel und Schemen werden ignoriert.");

$fragment = new rex_fragment();
$fragment->setVar('class', 'edit', false);
$fragment->setVar('title', "Pflichtangaben", false);
$fragment->setVar('body', $form->get(), false);
echo $fragment->parse('core/page/section.php');