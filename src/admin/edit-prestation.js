jQuery(document).ready(function($) {
    // Vérifier si le corps de la page contient les classes nécessaires
    if ($('body').hasClass('post-type-mltp_prestation') || $('body').hasClass('post-type-mltp_detail')) {
        // Lorsque la date de début change
        $('#dates_from').change(function() {
            // Récupérer la date de début
            var startDate = $(this).val();

            // Mettre à jour la date minimale pour la date de fin
            $('#dates_to').datepicker('option', 'minDate', startDate);

            // Déplacer le focus vers le champ date_to après un court délai
            setTimeout(function() {
                $('#dates_to').datepicker('show');
            }, 100);
        });

        // Attacher l'événement change aux champs from et to même s'ils sont ajoutés après le chargement de la page
        $(document).on('change', 'input[id^="manual_items_from"]', function() {
            var i = $('input[id^="manual_items_from"]').index(this);
            // Récupérer la date de début
            var startDate = $(this).val();

            // Mettre à jour la date minimale pour la date de fin
            $('input[id^="manual_items_to"]').eq(i).datepicker('option', 'minDate', startDate);

            // Déplacer le focus vers le champ date_to après un court délai
            setTimeout(function() {
                $('input[id^="manual_items_to"]').eq(i).datepicker('show');
            }, 100);
        });

        // Écouter les modifications sur #mltp_details et mettre à jour les actions en conséquence
        $('#mltp_details').change(function() {
            // Mettre à jour les actions ici
        });
    }
});
