<?php
# subtitle-converter.php - chriskempson.com
#
# Creates two SRT files (one Japanese one in language of the supplied file) 
# from erin.ne.jp's XML subtitle files
# NOTE: on Ubuntu you may need to install php-xml
#
#     php subtitle-converter.php basic-01.en.xml
#

$input_file = $argv[1];
$min_display_seconds = '3';

if (strstr($input_file, '.en.')) $lang = 'eng'; // Why not 'en'?
if (strstr($input_file, '.es.')) $lang = 'es';
if (strstr($input_file, '.pt.')) $lang = 'pt';
if (strstr($input_file, '.zh.')) $lang = 'zh';
if (strstr($input_file, '.ko.')) $lang = 'ko';
if (strstr($input_file, '.fr.')) $lang = 'fr';
if (strstr($input_file, '.id.')) $lang = 'id';
if (strstr($input_file, '.th.')) $lang = 'eng'; // Yes they did...

if (file_exists($input_file)) {
    $xml = (array) simplexml_load_file($input_file);
    $subtitles = (array) $xml['scene'];

    $i = 0;
    $output_ja = '';
    $output_native = '';

    foreach ($subtitles as $subtitle) {
        if ($subtitle->attributes()->sid > 0) {
            $i++;
            $output = '';

            $start_time = $subtitle->attributes()->starttime;
            $end_time = (float) $subtitle->attributes()->starttime + $min_display_seconds;
            
            if (isset($subtitles[$i + 1])) {
                $next_start_time = $subtitles[$i + 1]->attributes()->starttime;
            }
            else {
                $next_start_time = '0.000';
            }
            
            $start_timestamp_seconds = (int) $start_time;
            $start_timestamp_milliseconds = @explode('.', $start_time)[1] * 1000;
            
            $end_timestamp_seconds = (int) $end_time;
            $end_timestamp_milliseconds = @explode('.', $end_time)[1] * 1000;
            
            $next_start_timestamp_seconds = (int) $next_start_time;
            $next_start_timestamp_milliseconds = @explode('.', $next_start_time)[1] * 1000;
            
            $output .= $subtitle->attributes()->sid . "\n";
            
            $output .= gmdate('H:i:s,', $start_timestamp_seconds) . substr($start_timestamp_milliseconds, 0, 3);
            $output .= ' --> ';

            if ($end_time > $next_start_time) {
                $output .= gmdate('H:i:s,', $next_start_timestamp_seconds) . substr($next_start_timestamp_milliseconds, 0, 3) . "\n";
            } else {
                $output .= gmdate('H:i:s,', $end_timestamp_seconds) . substr($end_timestamp_milliseconds, 0, 3) . "\n";
            }

            $output_ja .= $output . $subtitle->kanji . "\n\n";
            $output_native .= $output . $subtitle->{$lang} . "\n\n";
        }
    }

    $path = dirname($input_file);
    $file = pathinfo($input_file, PATHINFO_BASENAME);
    $out_file = explode('.', $file);
    
    $out_file_ja = $path . '/' . $out_file[0] . '.ja.srt';
    $out_file_native = $path . '/' . $out_file[0] . '.' . $out_file[1] . '.srt';

    file_put_contents($out_file_ja, $output_ja);
    echo "Written $out_file_ja\n";

    file_put_contents($out_file_native, $output_native);
    echo "Written $out_file_native\n";

} else {
    exit('Failed to open ' . $file . "\n");
}