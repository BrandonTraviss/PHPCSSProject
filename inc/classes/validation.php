<?php
class Validation
{
    public function validateImage(array $fileData): string|false
    {
        if (empty($fileData['name'])) {
            return false;
        }

        $fileName = $fileData['name'];
        $fileSize = $fileData['size'];
        $fileError = $fileData['error'];

        if ($fileError !== 0) {
            return false;
        }

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt === 'svg' || !in_array($fileExt, $allowed)) {
            return false;
        }

        $maxSize = 2 * 1024 * 1024;
        if ($fileSize > $maxSize) {
            return false;
        }

        return $fileExt;
    }
}
