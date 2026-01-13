<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embed Video: {{ $video->name }}</title>
    <style>
        body, html { margin: 0; padding: 0; height: 100%; overflow: hidden; }
        video { width: 100%; height: 100%; object-fit: contain; background-color: #000; }
    </style>
</head>
<body>
    <video controls autoplay src="{{ Storage::disk('media_videos')->url($video->file_path) }}"></video>
</body>
</html>
