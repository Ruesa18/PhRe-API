<?php
    namespace PHREAPI\kernel\utils\output;

    /**
     * Class AbstractResponse
     * @package PHREAPI\kernel\utils\output
     */
    abstract class AbstractResponse {
        protected $code;
        protected $body;

        public function __construct($code, $body) {
            $this->code = $code;
            $this->body = $body;
        }

        public function getCode() {
            return $this->code;
        }

        public function getBody() {
            return $this->body;
        }

        public function setHttpHeaders() {}
    }

?>
