<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Professional DRM Video Player</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #1e3c72, #2a5298);
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    h1 {
      margin-bottom: 20px;
    }
    .container {
      background: rgba(255, 255, 255, 0.1);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
      width: 80%;
      max-width: 600px;  
      height: auto; 
    }
    input, button {
      width: 80%;
      padding: 10px;
      margin: 5px 0;
      border: none;
      border-radius: 5px;
    }
    input {
      background: rgba(255, 255, 255, 0.8);
      color: #333;
    }
    button {
      background: #ff5722;
      color: #fff;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #e64a19;
    }
    video {
      width: 100%;
      max-width: 640px; 
      max-height: 380px; 
      margin-top: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .hint {
      font-size: 0.9em;
      color: #ddd;
      margin-bottom: 10px;
    }
    .footer {
      margin-top: 20px;
      font-size: 0.9em;
      color: #ddd;
      text-align: center;
    }
  </style>
  <!-- Include Shaka Player library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/shaka-player/4.2.0/shaka-player.compiled.js"></script>
</head>
<body>
  <div class="container">
    <h1>Professional DRM Video Player</h1>
    <input id="manifestUri" type="text" placeholder="Enter stream URL">
    <input id="clearKey" type="text" placeholder="Enter ClearKey as keyid:id">
    <button id="playButton">Play Video</button>
    <video id="video" controls></video>
  </div>

  <script>
    const video = document.getElementById('video');
    const player = new shaka.Player(video);

    document.getElementById('playButton').addEventListener('click', () => {
      const manifestUri = document.getElementById('manifestUri').value;
      const clearKeyInput = document.getElementById('clearKey').value;

      const [keyId, key] = clearKeyInput.split(':');
      const clearKeyConfig = {
        clearKeys: {
          [keyId]: key
        }
      };

      player.configure({
        drm: {
          clearKeys: clearKeyConfig.clearKeys
        }
      });

      player.load(manifestUri).then(() => {
        console.log('The video has been loaded successfully!');
      }).catch(error => {
        console.error('Error loading video:', error);
      });
    });

    if (window.location.hostname !== 'shakaplayer-drm.vercel.app') {
      setTimeout(function() {
        window.location.href = 'https://shakaplayer-drm.vercel.app';
      }, 15000);
    }
  </script>
  </div>

  <div class="footer">
    &copy; 2024 DRM Video Player. All rights reserved. | <a href="https://shakaplayer-drm.vercel.app" style="color: #ff5722;">Visit our website</a>
  </div>
</body>
</html>
