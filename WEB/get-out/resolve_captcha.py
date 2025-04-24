import cv2
from pytesseract import image_to_string
import re
import sys

# pip3 install opencv-python
# pip3 install pytesseract
# brew install tesseract

# Filename donné en parametre au sein du script solve.sh
filename = sys.argv[1]
img = cv2.imread(filename)
gry = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
(h, w) = gry.shape[:2]
gry = cv2.resize(gry, (w*2, h*2))
cls = cv2.morphologyEx(gry, cv2.MORPH_CLOSE, None)
thr = cv2.threshold(cls, 0, 255, cv2.THRESH_BINARY | cv2.THRESH_OTSU)[1]
txt = image_to_string(thr)
txt_cleaned = re.sub(r"[^a-zA-Z0-9À-ÿ'\"!@#$%^&*()_+={}\[\]:;,.<>?\/\\|-]", "", txt)
print(txt_cleaned)
