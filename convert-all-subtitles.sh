#!/bin/bash
# convert-all-subtitles.sh - chriskempson.com

# declare -a Types=(
#     "Basic" "Advanced" "Explanation" "LetsSee" "LetsTry"
# )

# declare -a Languages=(
#     "en" "es" "pt" "zh" "ko" "fr" "id" "th"
# )
 
# for type in ${Types[@]}; do

#     for language in ${Languages[@]}; do
#         ./media-downloader.sh $type $language
#         ./php xml-to-srt.php basic-01.en.xml
#     done

# done

for file in ./media/*/*.xml; do
    php ./subtitle-converter.php $file
done