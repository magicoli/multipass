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
    }
});
