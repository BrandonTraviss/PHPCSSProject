<?php
class FileHandler
{
    // Save an image
    public function saveImage(array $fileData, string $fileExt)
    {
        // Creates filename
        $newFileName = uniqid('', true) . '.' . $fileExt;
        $destination = 'upload/' . $newFileName;
        // returns the link to the file to be used as imgLink
        if (move_uploaded_file($fileData['tmp_name'], $destination)) {
            return $destination;
        }

        return false;
    }
    // Delete an image
        public function deleteImage(string $imgLink)
    {
            // Checks if the file exists and deletes it
            if (file_exists($imgLink)) {
                return unlink($imgLink);
            }
        return false;
    }
}
