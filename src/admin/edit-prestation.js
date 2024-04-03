jQuery(document).ready(function($) {
    var userTriggered = false;

    // Vérifier si le corps de la page contient les classes nécessaires
    if ($('body').hasClass('post-type-mltp_prestation') || $('body').hasClass('post-type-mltp_detail')) {
        // Lorsque la date de début change
        $('#dates_from').change(function() {
            // Récupérer la date de début
            var startDate = $(this).val();
            // Mettre à jour la date minimale pour la date de fin
            $('#dates_to').datepicker('option', 'minDate', startDate);

            // Créer un objet URLSearchParams à partir de l'URL actuelle
            var urlParams = new URLSearchParams(window.location.search);

            // Vérifier si l'URL contient le paramètre dates_from
            if (!urlParams.has('dates_from')) {
                setTimeout(function() {
                    $('#dates_from').datepicker('hide');
                    // $('#dates_from').blur();
                    $('#dates_to').datepicker('show');
                }, 100);
            }
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

    if ($('body').hasClass('post-type-mltp_prestation')) {
        // Lorsque le lien "Ajouter nouveau" est cliqué
        $(document).on('click', '.rwmb-modal-add-button', function() {
            // Obtenez les valeurs que vous voulez passer à l'iframe
            var dates_from = $('#dates_from').val();
            var dates_to = $('#dates_to').val();
            // var prestation_id = wp.data.select("core/editor").getCurrentPostId();
            var prestation_id = $('#post_ID').val();

            // Attendez que l'iframe soit ajoutée au DOM
            var checkExist = setInterval(function() {
                userTriggered = false;

                if ($('#rwmb-modal-iframe').length) {
                    // L'iframe existe, arrêtez l'intervalle
                    clearInterval(checkExist);

                    // Modifiez l'URL de l'iframe pour inclure les valeurs en tant que paramètres de requête
                    var iframe = $('#rwmb-modal-iframe')[0];
                    iframe.src = iframe.src 
                    + '&dates_from=' + encodeURIComponent(dates_from) 
                    + '&dates_to=' + encodeURIComponent(dates_to)
                    + '&prestation_id=' + encodeURIComponent(prestation_id);
                }
                userTriggered = true;
            }, 100); // vérifiez toutes les 100ms
        });
    }

    if ($('body').hasClass('post-type-mltp_detail')) {
        // Lorsque la page est chargée
        $(window).on('load', function() {
            // Obtenez les paramètres de l'URL
            var urlParams = new URLSearchParams(window.location.search);

            // Vérifiez si 'dates_from' et 'dates_to' sont dans l'URL
            if (urlParams.has('dates_from') && urlParams.has('dates_to')) {
                // Obtenez les valeurs de 'dates_from' et 'dates_to' à partir de l'URL
                var dates_from = urlParams.get('dates_from');
                var dates_to = urlParams.get('dates_to');
                var prestation_id = urlParams.get('prestation_id');

                // Attendez que les champs du formulaire soient ajoutés au DOM
                var checkExist = setInterval(function() {
                    userTriggered = false;
                    if ($('#dates_from').length) {
                        // Les champs du formulaire existent, arrêtez l'intervalle
                        clearInterval(checkExist);

                        // Utilisez les objets Date pour remplir les champs du formulaire
                        $('#dates_from').val(dates_from).focus();
                        $('#dates_to').val(dates_to).focus();

                        $('#prestation_id').val(prestation_id).trigger('change');
                        $('#prestation-task_from').val(prestation_id).trigger('change');

                        $('#dates_to').datepicker('hide');
                        $('#resource_id').focus();
                    }
                    userTriggered = true;
                }, 100); // vérifiez toutes les 100ms
            }
        });
    }
});
