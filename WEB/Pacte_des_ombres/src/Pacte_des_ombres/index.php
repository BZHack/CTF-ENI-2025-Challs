<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CTF Challenge - Pacte des Ombres</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">
  <style>
    body {
      background: url('https://source.unsplash.com/1600x900/?dark,horror') no-repeat center center fixed;
      background-size: cover;
      color: #e2e2e2;
      font-family: 'Creepster', cursive;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
    }
    .overlay {
      background: rgba(0, 0, 0, 0.7);
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
    .container {
      position: relative;
      z-index: 2;
      text-align: center;
    }
    .header {
      margin-top: 50px;
      animation: flicker 1.5s infinite alternate;
    }
    @keyframes flicker {
      0% { opacity: 1; }
      100% { opacity: 0.8; }
    }
    .glitch {
      font-size: 2rem;
      position: relative;
      display: inline-block;
      color: #ff0000;
      animation: glitch 1s infinite;
    }
    @keyframes glitch {
      0% { transform: translate(0); }
      20% { transform: translate(-2px, 2px); }
      40% { transform: translate(2px, -2px); }
      60% { transform: translate(-2px, 2px); }
      80% { transform: translate(2px, -2px); }
      100% { transform: translate(0); }
    }
    .upload-area {
      background: rgba(30, 30, 30, 0.9);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(255, 0, 0, 0.7);
    }
    .btn-danger {
      background-color: #990000;
      border: none;
      transition: 0.3s;
    }
    .btn-danger:hover {
      background-color: #ff0000;
      box-shadow: 0 0 15px red;
    }
  </style>
  <script>
    function validateFile(input) {
      const allowedExtensions = /\.png$/i;
      if (!allowedExtensions.exec(input.value)) {
        alert("Erreur : Seuls les fichiers .png sont autorisés pour accomplir le rituel.");
        input.value = "";
        return false;
      }
      return true;
    }

    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById("uploadForm");
      form.addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        fetch('upload.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          document.getElementById("serverResponse").innerHTML = `<p class='mt-3 text-warning'>${data}</p>`;
        })
        .catch(error => {
          document.getElementById("serverResponse").innerHTML = "<p class='mt-3 text-danger'>Erreur de communication avec l'obscurité...</p>";
        });
      });
    });
  </script>
</head>
<body>
  <div class="overlay"></div>
  <div class="container mt-5">
    <header class="header">
      <h1 class="glitch">Le pacte des Ombres</h1>
      <p class="lead">Offrez votre essence numérique... ou disparaissez.</p>
    </header>
    <section class="mt-4">
      <div class="upload-area">
        <p>
          Les Anciens murmurent qu'une offrande visuelle est nécessaire pour ouvrir la porte interdite. 
          Seule une image marquée du sceau occulte sera acceptée...
        </p>
        <form id="uploadForm" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="uploadFile" class="form-label">Déposez votre marque (.png uniquement)</label>
            <input type="file" name="uploadFile" id="uploadFile" class="form-control" accept=".png" onchange="validateFile(this)" required>
          </div>
          <button type="submit" class="btn btn-danger">Accomplir le rituel</button>
        </form>
        <div id="serverResponse" class="mt-3"></div>
      </div>
    </section>
  </div>
</body>
</html>
