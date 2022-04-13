<?php

    namespace PHREAPI\kernel\utils\output;

    /**
     * This class will be used to output any content as plain text.
     *
     * @class Response
     * @package PHREAPI\kernel\utils\output
     */
    class Response extends AbstractResponse {
        protected string $contentType = "text";
    }
?>
