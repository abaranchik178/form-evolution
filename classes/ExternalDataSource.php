<?php


namespace classes;


trait ExternalDataSource
{
    public function isValidCsrfSecret($inputCsrfSecret): bool
    {
        if ($_SESSION['csrfSecret'] = $inputCsrfSecret) {
            return true;
        }
        return false;
    }
    public function getFields(): array
    {
        return [];
    }

    /**
     * @param string $text
     * @return string
     */

    public function sanitizeText(string $text): string
    {
        return htmlspecialchars( trim($text) );
    }

    public function sanitizeData(array $data): array
    {
        $sanitizedData = [];
        $fields = $this->getFields();
        foreach ($data as $fieldName => $fieldValue) {
            if ( ! isset($fields[$fieldName]) ) {
                error_log("Remove not allowed field: $fieldName");
                continue;
            }
            $sanitizedValue = $fieldValue;

            if ( ! is_array($fields[$fieldName]) ) {
                throw new \LogicException('Sanitize field value must be array of methods names');
            }

            foreach ($fields[$fieldName] as $sanitizeMethodName) {
                if ( !method_exists($this, $sanitizeMethodName)) {
                    throw new \BadFunctionCallException("Unknown method $sanitizeMethodName");
                }
                $sanitizedValue = $this->{$sanitizeMethodName}($sanitizedValue);
            }
            $sanitizedData[$fieldName] = $sanitizedValue;
        }
        return $sanitizedData;
    }
}