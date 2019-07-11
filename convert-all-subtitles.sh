#!/bin/bash
# convert-all-subtitles.sh - chriskempson.com

for file in ./media/*/*.xml; do
    php ./subtitle-converter.php $file
done