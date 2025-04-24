from flask import Flask, request, send_from_directory, make_response
from PIL import Image, ImageDraw, ImageFont, ImageFilter
import random, string, os, threading, time

app = Flask(__name__)
app.config['CAPTCHA_FOLDER'] = 'website/static/captchas'

# Assurez-vous que le dossier existe
def ensure_captcha_folder_exists():
    if not os.path.exists(app.config['CAPTCHA_FOLDER']):
        os.makedirs(app.config['CAPTCHA_FOLDER'])
        print(f"Dossier {app.config['CAPTCHA_FOLDER']} créé avec succès.")

# Génération d'une chaîne aléatoire
def generate_random_string(length):
    return ''.join(random.choices(string.ascii_letters + string.digits, k=length))

# Suppression du CAPTCHA et de l'image associée après un délai
def remove_captcha_after_timeout(session_id, captcha_text, timeout=5):
    time.sleep(timeout)
    if session_id in sessions:
        # Supprimer l'image associée
        file_path = sessions[session_id]["file_path"]
        if os.path.exists(file_path):
            os.remove(file_path)
            print(f"Image supprimée : {file_path}")
        # Supprimer la session
        del sessions[session_id]
        deleted_sessions[session_id] = {"text": captcha_text}
        print(f"CAPTCHA pour la session {session_id} supprimé après {timeout} secondes.")

# Stockage des sessions utilisateur
sessions = {}
deleted_sessions = {}

# Générer une image CAPTCHA avec typographie et effet de flou
def generate_captcha_image(captcha_text, file_path):
    width, height = 300, 100
    image = Image.new('RGB', (width, height), 'white')
    draw = ImageDraw.Draw(image)
    
    # Charger une police
    try:
        font = ImageFont.truetype("website/assets/arial.ttf", 40)
    except IOError:
        font = ImageFont.load_default()

    # Dessiner le texte
    draw.text((10, 30), captcha_text, font=font, fill='black')

    # Ajouter des lignes de bruit
    for _ in range(3):
        start_point = (random.randint(0, width), random.randint(0, height))
        end_point = (random.randint(0, width), random.randint(0, height))
        draw.line([start_point, end_point], fill='gray', width=3)

    # Appliquer un effet de flou
    blurred_image = image.filter(ImageFilter.GaussianBlur(radius=2))

    # Sauvegarder l'image
    blurred_image.save(file_path)

@app.route('/generate-captcha', methods=['GET'])
def generate_captcha():
    try:
        # Vérifier que le dossier CAPTCHA existe
        ensure_captcha_folder_exists()

        # Générer le texte et le fichier CAPTCHA
        captcha_text = generate_random_string(11)
        file_name = generate_random_string(5) + ".png"
        file_path = os.path.join(app.config['CAPTCHA_FOLDER'], file_name)

        # Générer l'image CAPTCHA
        generate_captcha_image(captcha_text, file_path)

        # Générer une session unique
        session_id = generate_random_string(64)
        sessions[session_id] = {"text": captcha_text, "file_path": file_path}

        # Planifier la suppression du CAPTCHA et de l'image après 5 secondes
        threading.Thread(target=remove_captcha_after_timeout, args=(session_id, captcha_text)).start()

        # Retourner la session ID et le nom du fichier via un cookie
        response = make_response(file_name)
        response.set_cookie('session_id', session_id)
        return response
    except Exception as e:
        print(f"Error generating CAPTCHA: {e}")
        return "Error generating CAPTCHA", 500

@app.route('/validate-captcha', methods=['POST'])
def validate_captcha():
    """Validation du CAPTCHA."""
    session_id = request.cookies.get('session_id')
    user_input = request.form.get('captcha')
    
    if not session_id:
        return "<h1>Le cookie 'session_id' est manquant.</h1>"
    if session_id not in sessions:
    	if session_id in deleted_sessions:
            if deleted_sessions[session_id]["text"] == user_input:
                return "<h1>Bien tenté, mais il faudra réellement faire en moins de 5 secondes ! ;)</h1><br><img src='./troll.gif'>"
            else:
                return "<h1>Session expirée.</h1>"
    	return "<h1>Session invalide.</h1>"
    if sessions[session_id]["text"] == user_input:
        # Supprimer l'image associée
        file_path = sessions[session_id]["file_path"]
        if os.path.exists(file_path):
            os.remove(file_path)
            print(f"Image supprimée : {file_path}")
        # Supprimer le CAPTCHA après validation
        del sessions[session_id]
        print(f"CAPTCHA pour la session {session_id} supprimé après validation.")
        return "<h1>Congratulations! ENI{Y0u_SuCce$$fu1ly_eSc4p4d_Br0!}</h1>"
    else:
        return "<h1>CAPTCHA saisie incorrect<br>Essayes encore !</h1>"

@app.route('/static/<path:path>')
def serve_static(path):
    """Servir les fichiers statiques (images CAPTCHA)."""
    return send_from_directory('static', path)

@app.route('/')
def index():
    return send_from_directory('website', 'index.html')

@app.route('/captchas/<path:path>')
def serve_captchas(path):
    return send_from_directory('website/static/captchas', path)


if __name__ == "__main__":
    ensure_captcha_folder_exists()
    app.run(host='0.0.0.0',debug=True)

