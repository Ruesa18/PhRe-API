<?php

namespace PHREAPI\kernel\utils\output;

use PHREAPI\kernel\utils\ConfigLoader;

/**
 * This class will be used to output a given response as HTML.
 *
 * @class HTMLResponse
 * @package PHREAPI\kernel\utils\output
 */
class HTMLResponse extends AbstractResponse {
    protected string $contentType = 'html';

    /**
     * Getter
     *
     * @return string returns the http-body for the response as HTML.
     */
    public function getBody(): string {
        if(!defined('ROOT_DIR')) {
            throw new \RuntimeException('Could not find needed ROOT_DIR constant while building HTML Response.');
        }

        $dir = sprintf('%s/src/kernel/utils/output/', ROOT_DIR);

        $content = sprintf(
            '%s%s%s',
            file_get_contents($dir . "header.html"),
            $this->body,
            file_get_contents($dir . "footer.html")
        );

        // Replace name placeholder with configured value from .env
        return str_replace('[APP_NAME]', ConfigLoader::get('APP_NAME') ?? 'PhRe-API', $content);
    }
}
