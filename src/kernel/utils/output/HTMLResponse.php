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

        protected string $contentType = "html";

        /**
         * Getter
         *
         * @return mixed returns the http-body for the response as HTML.
         */
        public function getBody() {
            $dir = ROOT_DIR . "/src/kernel/utils/output/";

            $content = file_get_contents($dir . "header.html") . $this->body . file_get_contents($dir . "footer.html");

            // Replace name placeholder with configured value from .env
            $content = str_replace("[APP_NAME]", ConfigLoader::get("APP_NAME") ?? "PhRe-API", $content);

            return $content;
        }
    }
?>
