#!/bin/bash

# export PS1='\[\033[32m\]\u@\h\[\033[0m\]:\[\033[34m\]\W\[\033[0m\]\$ '


# URL="https://webservice.localhost/template/assets/sampleimage.svg"
# URL="http://localhost:8005/testhalaman"
# URL="https://webservice.localhost"
# curl -D - -H "webservice-debug-channel: fgta5-dev" $URL



URL="https://fgta5.localhost"

echo GET $URL
curl -D - \
     -H "webservice-debug-channel: fgta5-dev" \
	 $URL



