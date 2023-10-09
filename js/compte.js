function ajouterCouleur() {
    var newColorInput = document.getElementById('newColor');
    var newColor = newColorInput.value.trim();

    if (newColor !== '') {
        var couleurContainer = document.getElementById('couleurContainer');

        // Vérifiez d'abord si un bouton radio avec la même valeur existe
        var existingRadio = couleurContainer.querySelector('input[type="radio"][value="' + newColor + '"]');

        if (!existingRadio) {
            // S'il n'existe pas, ajoutez-le
            var div = document.createElement('div');
            div.innerHTML = `
              <label for="${newColor}">
                  <input id="${newColor}" type="radio" name="couleur" value="${newColor}" checked />
                  <span>${newColor}</span>
              </label>
          `;
            couleurContainer.appendChild(div);
        } else {
            // S'il existe déjà, sélectionnez-le
            existingRadio.checked = true;
        }

        // Effacer le champ de saisie
        newColorInput.value = '';
    } else {
        alert("Veuillez entrer une couleur valide.");
    }
}

    // Faites de même pour les fonctions ajouterEspece et ajouterTaille en utilisant les mêmes principes.

function ajouterEspece() {
    var newEspeceInput = document.getElementById('newEspece');
    var newEspece = newEspeceInput.value.trim();

    if (newEspece !== '') {
        var especeContainer = document.getElementById('especeContainer');

        // Vérifiez d'abord si un bouton radio avec la même valeur existe
        var existingRadio = especeContainer.querySelector('input[type="radio"][value="' + newEspece + '"]');

        if (!existingRadio) {
            // S'il n'existe pas, ajoutez-le
            var div = document.createElement('div');
            div.innerHTML = `
              <label for="${newEspece}">
                  <input id="${newEspece}" type="radio" name="espece" value="${newEspece}" checked />
                  <span>${newEspece}</span>
              </label>
          `;
            especeContainer.appendChild(div);
        } else {
            // S'il existe déjà, sélectionnez-le
            existingRadio.checked = true;
        }

        // Effacer le champ de saisie
        newEspeceInput.value = '';
    } else {
        alert("Veuillez entrer une espece valide.");
    }
}

    // Faites de même pour les fonctions ajouter espece et ajouter Age en utilisant les mêmes principes.

function ajouterAge() {
    var newAgeInput = document.getElementById('newAge');
    var newAge = newAgeInput.value.trim();

    if (newAge !== '') {
      var ageContainer = document.getElementById('ageContainer');

      // Vérifiez d'abord si un bouton radio avec la même valeur existe
      var existingRadio = ageContainer.querySelector('input[type="radio"][value="' + newAge + '"]');

      if (!existingRadio) {
        // S'il n'existe pas, ajoutez-le
        var div = document.createElement('div');
        div.innerHTML = `
              <label for="${newAge}">
                  <input id="${newAge}" type="radio" name="age" value="${newAge}" checked />
                  <span>${newAge}</span>
              </label>
          `;
        ageContainer.appendChild(div);
      } else {
        // S'il existe déjà, sélectionnez-le
        existingRadio.checked = true;
      }

      // Effacer le champ de saisie
      newAgeInput.value = '';
    } else {
      alert("Veuillez entrer une age valide.");
    }
  }

      // Faites de même pour les fonctions ajouter espece et ajouter Age en utilisant les mêmes principes