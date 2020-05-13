if (typeof jQuery !== 'undefined') {
    console.log('jQuery Loaded');
}
else {
    console.log('not loaded yet');
}
(jQuery);

// INPUT CODE POSTAL
$("#cp").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "https://api-adresse.data.gouv.fr/search/?postcode=" + $("input[name='hotel[codePostal]']").val(),
            data: {
                q: request.term
            },
            dataType: "json",
            success: function (data) {
                var postcodes = [];
                response($.map(data.features, function (item) { // Ici on est obligé d'ajouter les CP dans un array pour ne pas avoir plusieurs fois le même
                    if ($.inArray(item.properties.postcode, postcodes) == -1) {
                        postcodes.push(item.properties.postcode);
                        return {
                            label: item.properties.postcode + " - " + item.properties.city,
                            city: item.properties.city,
                            value: item.properties.postcode
                        };
                    }
                }));
            }
        });
    },
    // On remplit aussi la ville
    select: function (event, ui) {
        $('#ville').val(ui.item.city);
    }
});
// INPUT VILLE
$("#ville").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "https://api-adresse.data.gouv.fr/search/?city=" + $("input[name='hotel[ville]']").val(),
            data: {
                q: request.term
            },
            dataType: "json",
            success: function (data) {
                var cities = [];
                response($.map(data.features, function (item) { // Ici on est obligé d'ajouter les villes dans un array pour ne pas avoir plusieurs fois la même
                    if ($.inArray(item.properties.postcode, cities) == -1) {
                        cities.push(item.properties.postcode);
                        return {
                            label: item.properties.postcode + " - " + item.properties.city,
                            postcode: item.properties.postcode,
                            value: item.properties.city
                        };
                    }
                }));
            }
        });
    },
    // On remplit aussi le CP
    select: function (event, ui) {
        $('#cp').val(ui.item.postcode);
    }
});
// INPUT ADRESSE
$("#adresse").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "https://api-adresse.data.gouv.fr/search/?name=" + $("input[name='hotel[codePostal]']").val(),
            data: {
                q: request.term
            },
            dataType: "json",
            success: function (data) {
                var adresse = [];
                response($.map(data.features, function (item) {
                    if ($.inArray(item.properties.name, adresse) == -1) {
                        adresse.push(item.properties.name);
                        return {
                            label: item.properties.name + " " + item.properties.postcode + " " + item.properties.city,
                            city: item.properties.city,
                            postcode: item.properties.postcode,
                            coordinates: item.geometry.coordinates[0],
                            coordinates2: item.geometry.coordinates[1],
                            value: item.properties.name
                        };
                    }
                }));
            }
        });
    },
    // On remplit aussi les autres champs
    select: function (event, ui) {
        $('#cp').val(ui.item.postcode);
        $('#ville').val(ui.item.city);
        $('#lat').val(ui.item.coordinates2);
        $('#lon').val(ui.item.coordinates);
    }
});

