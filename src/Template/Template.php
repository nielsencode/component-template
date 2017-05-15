<?php
namespace Components\Template;

class Template
{
    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    public function render($template,$data=[])
    {
        $contents = file_get_contents("{$this->templatePath}/$template");

        $patterns = [
            '#(\{\{) ([A-Za-z])#',
            '#\{\{#',
            '#\}\}#',
        ];

        $replacements = [
            '$1 \$$2',
            '<?=',
            '?>'
        ];

        $replaced = preg_replace($patterns,$replacements,$contents);

        $temporaryFile = __DIR__.'/'.uniqid().'.php';

        file_put_contents($temporaryFile,$replaced);

        extract($data);

        require_once $temporaryFile;

        unlink($temporaryFile);
    }
}
