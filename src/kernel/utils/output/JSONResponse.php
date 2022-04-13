<?php

    namespace PHREAPI\kernel\utils\output;

    /**
     * This class will be used to output a given response as JSON.
     *
     * @class JSONResponse
     * @package PHREAPI\kernel\utils\output
     */
    class JSONResponse extends AbstractResponse {

        protected string $contentType = "json";

        /**
         * Getter
         *
         * @return mixed returns the http-body for the response as JSON.
         */
        public function getBody() {
            return json_encode($this->body);
        }
    }
?>
