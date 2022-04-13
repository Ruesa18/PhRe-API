<?php

    namespace PHREAPI\kernel\utils\output;

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
            return file_get_contents($dir . "header.html") . $this->body . file_get_contents($dir . "footer.html");
        }
    }
?>
