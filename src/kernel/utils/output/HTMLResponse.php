<?php

    namespace PHREAPI\kernel\utils\output;

    /**
     * This class will be used to output a given response as JSON.
     *
     * @class HTMLResponse
     * @package PHREAPI\kernel\utils\output
     */
    class HTMLResponse extends AbstractResponse {

        public function setHttpHeaders() {
            header('Content-Type: application/json');
        }

        /**
         * Getter
         *
         * @return mixed returns the http-body for the response as JSON.
         */
        public function getBody() {
            $dir = ROOT_DIR . "/src/kernel/utils/output/";
            return file_get_contents($dir . "header.html") . $this->body . file_get_contents($dir . "footer.html");
        }
    }
?>
