const path = require('path');

module.exports = {
  entry: path.resolve(__dirname, 'webroot/js/', 'app.js'),
  output: {
    filename: 'bundle.js', // Le nom du fichier de sortie
    path: path.resolve(__dirname, 'webroot/js'), // Le répertoire de sortie
  },
  module: {
    rules: [
      // Les règles de traitement des fichiers JavaScript (babel-loader, etc.) vont ici
    ],
  },
  // Ajoutez la configuration des externals pour Tippy.js
  externals: {
    tippy: 'tippy', // L'import de la bibliothèque dans votre code
  },
};