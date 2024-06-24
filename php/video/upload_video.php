<?php
if (isset($_POST['upload_video'])) {
    $video_name = $_FILES['video']['name'];
    $video_tmp_name = $_FILES['video']['tmp_name'];
    $video_error = $_FILES['video']['error'];

    $preview_video_name = $_FILES['preview']['name'];
    $preview_tmp_name = $_FILES['preview']['tmp_name'];
    $preview_error = $_FILES['preview']['error'];

    if ($video_error === 0 && $preview_error === 0) {
        $video_extension = pathinfo($video_name, PATHINFO_EXTENSION);
        $video_extension_lc = strtolower($video_extension);

        $preview_extension = pathinfo($preview_video_name, PATHINFO_EXTENSION);
        $preview_extension_lc = strtolower($preview_extension);

        if (in_array($video_extension_lc, array("mp4", 'avi'))) {
            if (in_array($preview_extension_lc, array("jpeg", 'png', 'jpg'))) {
                $new_video_name = uniqid("video-", true) . '.' . $video_extension_lc;
                $video_upload_path = 'tmp/videos/' . $new_video_name;
                move_uploaded_file($video_tmp_name, $video_upload_path);

                $new_preview_name = uniqid("preview-", true) . '.' . $preview_extension_lc;
                $preview_upload_path = 'tmp/previews/' . $new_preview_name;
                move_uploaded_file($preview_tmp_name, $preview_upload_path);

                $title = mysqli_real_escape_string($db, $_POST['title']);
                $description = mysqli_real_escape_string($db, $_POST['description']);
                $category = mysqli_real_escape_string($db, $_POST['category']);
                $username = mysqli_real_escape_string($db, $_SESSION['username']);
                $sql = "INSERT INTO videos(video_url, preview_url, title, description, category, creator) 
                    VALUES('$video_upload_path', '$preview_upload_path', '$title', '$description', '$category', '$username')";
                mysqli_query($db, $sql);
            } else {
                array_push($errors, "You can't thumbnail files of this type");
            }
        } else {
            array_push($errors, "You can't videos file of this type");
        }
    } else {
        array_push($errors, $video_error);
        array_push($errors, $preview_error);
    }
    header('location: index.php');
}
