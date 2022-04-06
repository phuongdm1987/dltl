<?php

class ImageController extends \BaseController {
    public function upload()
    {
        $image = new Image();
        try {
            $resultUpload  = $image->upload('upload', PATH_UPLOAD_IMAGES, [], 'no-resize');
        } catch (\Exception $e) {
            return Response::json(array('errors' => ['message' => $e->getMessage()]), 500);
        }

        $url = PATH_IMAGES . $resultUpload['filename'];

        return Response::json(array('urls' => ['default' => $url]), 200);
    }
}
