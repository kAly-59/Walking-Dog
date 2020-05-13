// ----------------EASY BTN-----------------
L.easyButton('fas fa-location-arrow', function () {
    carte.setView([46.603354, 1.8883335], 7);
}).addTo(carte);


//AFFICHER MDP
$(document).ready(function () {

    $('#show-password').click(function () {
        if ($(this).prev('input').prop('type') == 'password') {
            //Si c'est un input type password
            $(this).prev('input').prop('type', 'text');
            $(this).text('');
        } else {
            //Sinon
            $(this).prev('input').prop('type', 'password');
            $(this).text('');
        }
    });

});

// ----------------RECHERCHE DANS MAP-----------------
// On récupère les champs de la page
let champVille = document.getElementById('champ-ville')

// On écoute l'évènement "change" sur le champ ville
champVille.addEventListener("change", function () {
    // On envoie la requête ajax vers nominatim et on traite la réponse
    ajaxGet(`https://nominatim.openstreetmap.org/search?q=${this.value}&format=json&addressdetails=1&limit=1&polygon_geojson=1`).then(reponse => {

        // On convertit la réponse en objet Javascript
        let data = JSON.parse(reponse)
        console.log(reponse)
        // On stocke la latitude et la longitude dans la variable ville
        ville = [data[0].lat, data[0].lon]

        // On centre la carte sur la ville
        carte.panTo(ville)
    })
})

/**
 * Cette fonction effectue un appel Ajax vers une url et retourne une promesse
 * @param {string} url 
 */
function ajaxGet(url) {
    return new Promise(function (resolve, reject) {
        // Nous allons gérer la promesse
        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            // Si le traitement est terminé
            if (xmlhttp.readyState == 4) {
                // Si le traitement est un succès
                if (xmlhttp.status == 200) {
                    // On résoud la promesse et on renvoie la réponse
                    resolve(xmlhttp.responseText);
                } else {
                    // On résoud la promesse et on envoie l'erreur
                    reject(xmlhttp);
                }
            }
        }

        // Si une erreur est survenue
        xmlhttp.onerror = function (error) {
            // On résoud la promesse et on envoie l'erreur
            reject(error);
        }

        // On ouvre la requête
        xmlhttp.open('GET', url, true);

        // On envoie la requête
        xmlhttp.send(null);
    })
}


