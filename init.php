<?php

fwrite(\STDOUT, "Enter an extension name:\n");
$fh = fopen('php://stdin', 'r');
$name = trim(fgets($fh));
fclose($fh);

$nameLabel = $name;

$name = ucfirst($name);

$name = str_replace(' ', '', ucwords(preg_replace('/^a-z0-9]+/', ' ', $name)));
$nameHyphen = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $name));

fwrite(\STDOUT, "Enter a description text:\n");
$fh = fopen('php://stdin', 'r');
$description = trim(fgets($fh));
fclose($fh);

if (substr($description, -1) !== '.') $description .= '.';

$year = date('Y');
$today = date('Y-m-d');

$replacePlaceholders = function (string $file) use ($name, $nameHyphen, $nameLabel, $description, $year, $today)
{
    $content = file_get_contents($file);

    $content = str_replace('{@name}', $name, $content);
    $content = str_replace('{@nameHyphen}', $nameHyphen, $content);
    $content = str_replace('{@nameLabel}', $nameLabel, $content);
    $content = str_replace('{@description}', $description, $content);
    $content = str_replace('{@year}', $year, $content);
    $content = str_replace('{@today}', $today, $content);

    file_put_contents($file, $content);
};

$replacePlaceholders('.vscode/settings.json');
$replacePlaceholders('.eslintrc.json');
$replacePlaceholders('package.json');
$replacePlaceholders('extension.json');
$replacePlaceholders('config-default.json');
$replacePlaceholders('README.md');
$replacePlaceholders('CHANGELOG.md');
$replacePlaceholders('composer.json');

rename('src/files/application/Espo/Modules/MyModuleName', 'src/files/application/Espo/Modules/'. $name);
rename('src/files/client/modules/my-module-name', 'src/files/client/modules/'. $nameHyphen);

rename('tests/unit/Espo/Modules/MyModuleName', 'tests/unit/Espo/Modules/'. $name);
rename('tests/integration/Espo/Modules/MyModuleName', 'tests/integration/Espo/Modules/'. $name);

echo "Ready. Now you need to run 'npm install'.\n";
