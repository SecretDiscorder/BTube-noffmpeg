<?php
require_once('./assets/init.php');
$process_queue = $db->get(T_QUEUE, $pt->config->queue_count, '*');

if (count($process_queue) > 0) {
    foreach ($process_queue as $key => $value) {
        try {
            if ($value->processing == 0) {
                $video = $db->where('id', $value->video_id)->getOne(T_VIDEOS);
                if (!$video) continue;

                $video_id = $video->id;

                // Tandai sedang diproses
                $db->where('video_id', $video_id)->update(T_QUEUE, ['processing' => 1]);

                // Buat file path
                $filepath = explode('.', $video->video_location)[0];
                $video_output = $filepath . "_240p_converted.mp4";

                // Tandai video sudah dikonversi manual
                $db->where('id', $video_id)->update(T_VIDEOS, [
                    'converted' => 1,
                    '240p' => 1,
                    'video_location' => $video_output
                ]);

                // Upload ke S3 jika diperlukan
                PT_UploadToS3($video_output);

                // Hapus dari antrean
                $db->where('video_id', $video_id)->delete(T_QUEUE);

                // Kirim notifikasi
                pt_push_channel_notifiations($video_id);
            }
        } catch (Exception $e) {
            $db->where('video_id', $value->video_id)->delete(T_QUEUE);
        }
    }
}
