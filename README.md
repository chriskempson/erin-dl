# erin-dl
Download videos with subtitles from https://www.erin.ne.jp in Japanese, English, Spanish, Portuguese, Chinese, Korean, French, Indonesian and Thai. Videos are left in their original (low bitrate ;_;) mp4 format. The subtitles will be converted to SRT format.

## Why
The video content at Erin has great potential as a source for beginner students of Japanese but is locked away, unloved, in an aging flash website. 

To unlock it's true potential one must first gain the ability to mine this content. This means having the videos and subtitles files on your own computer and feeding it to [Voracious](https://voracious.app/) (preferred) or [subs2srs](http://subs2srs.sourceforge.net/).

Mining terms and sentences for your Anki deck with pictures and audio is pure win. However, there's not really any low-level content for people who are just starting out but now Erin can hopefully fix this problem.

## How
First you might want to open `download-all-media.sh` and delete the languages and types of videos you're not interested in otherwise expect to download over 700MB of media.

Next you'll want to grab some media:

    ./download-all-media.sh
    
Now you'll want to convert the odd XML subs into SRT:

    ./convert-all-subtitles.sh
    
## Caveats
The bizarre XML subtitle format only has a start time but no end time for subtitles. To get around this is `subtitle-converter.php` sets the end time as start time plus 3 seconds. Occasionally subtitles might stay around a little longer than wanted or every disappear a little soon but generally are fine.
