<?php
    namespace PHREAPI\kernel\utils\output;

    /**
     * Class AbstractResponse
     * @package PHREAPI\kernel\utils\output
     */
    abstract class AbstractResponse {
        protected int $code;
        protected mixed $body;
        protected string $contentType = "text";

        public function __construct(int $code, mixed $body) {
            $this->code = $code;
            $this->body = $body;
        }

        public function getCode() {
            return $this->code;
        }

        public function getBody() {
            return $this->body;
        }

        public function setHttpHeaders() {
            switch($this->contentType) {
                case "json":
                    header('Content-Type: application/json');
                    break;
                case "html":
                    header('Content-Type: text/html');
                    break;
                default:
                    header('Content-Type: text/plain');
            }
        }
    }

?>
