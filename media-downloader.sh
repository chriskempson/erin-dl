#!/bin/bash
# media-downloader.sh - chriskempson.com


# The type of media you wish to download. Either "Basic", "Advanced", 
# "Explanation", "LetsSee" or "LetsTry"
TYPE_ARG=$1
TYPE=${1,,} # Lowercase
DIR="./media/$TYPE"

# The subtitle langauge you wish to download. Either "en", "es", "pt", "zh", 
# "ko", "fr", "id" or "th". Note: "jp" also exists but is pointless as all
# language subs contain Japanese subs in the XML file.
LANGUAGE=$2

# Make directories if they don't exist
if [ ! -e $DIR ]; then
    mkdir --parents $DIR
fi

# Loop 00 to 25 for each lesson 
for i in $(seq -f "%02g" 1 25) ; do
    
    # Download video
    wget https://www.erin.ne.jp/media/mpeg/${i}/${TYPE_ARG}.mp4 --no-clobber --output-document=$DIR/$TYPE-${i}.mp4

    # Download subtitles
    wget https://www.erin.ne.jp/$LANGUAGE/lesson${i}/$TYPE/parts/text.xml --no-clobber --output-document=$DIR/$TYPE-${i}.$LANGUAGE.xml # English
done