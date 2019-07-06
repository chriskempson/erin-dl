#!/bin/bash
# download-all-media.sh - chriskempson.com

declare -a Types=(
    "Basic" "Advanced" "Explanation" "LetsSee" "LetsTry"
)

declare -a Languages=(
    "en" "es" "pt" "zh" "ko" "fr" "id" "th"
)
 
for type in ${Types[@]}; do

    for language in ${Languages[@]}; do
        ./media-downloader.sh $type $language
    done

done