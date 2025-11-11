<?php
class FileHandler
{
    public function saveImage(array $fileData, string $fileExt): string|false
    {
        $newFileName = uniqid('', true) . '.' . $fileExt;
        $destination = 'upload/' . $newFileName;

        if (move_uploaded_file($fileData['tmp_name'], $destination)) {
            return $destination;
        }

        return false;
    }
}
