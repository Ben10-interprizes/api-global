function genererIdentifiant() {
  const caracteresLettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  const caracteresChiffres = '0123456789';
  let identifiant = '';

  // Générer les deux premières lettres majuscules
  for (let i = 0; i < 2; i++) {
    const indexAleatoire = Math.floor(Math.random() * caracteresLettres.length);
    identifiant += caracteresLettres.charAt(indexAleatoire);
  }

  // Générer les quatre chiffres suivants
  for (let i = 0; i < 4; i++) {
    const indexAleatoire = Math.floor(Math.random() * caracteresChiffres.length);
    identifiant += caracteresChiffres.charAt(indexAleatoire);
  }

  return identifiant;
}

// Exemple d'utilisation :
const nouvelIdentifiant = genererIdentifiant();
console.log(nouvelIdentifiant);
