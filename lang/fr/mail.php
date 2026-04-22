<?php
/**
 * Lang.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 07:19:24
 */

return [
    'btn_buy_now'             => 'acheter maintenant',
    'customer_name'           => 'Cher :name utilisateur, bonjour! ',
    'not_oneself'             => 'Les opérations non personnelles peuvent être ignorées. ',
    'order_success'           => 'commande envoyée avec succès',
    'order_success_info'      => 'Votre commande a été soumise avec succès, voici les détails de la commande',
    'order_update'            => 'mise à jour de l\'état de la commande',
    'order_update_status'     => 'Le statut de votre commande :number est mis à jour',
    'register_end'            => 'Terminez l\'inscription, veuillez cliquer sur le bouton ci-dessous pour retourner au centre commercial. ',
    'retrieve_password_btn'   => 'Cliquez ici pour vérifier l\'e-mail',
    'retrieve_password_text'  => 'Vous récupérez votre mot de passe, veuillez cliquer sur le bouton ci-dessous pour terminer l\'opération. ',
    'retrieve_password_title' => 'récupérer le mot de passe',
    'sincerely'               => 'Vous êtes',
    'team'                    => 'l\'équipe',
    'welcome_register'        => 'bienvenue pour vous inscrire',

    // Messages d'erreur de transport de courrier SendCloud
    'sendcloud_invalid_message_type'      => 'Le message doit être une instance de Symfony\Component\Mime\Email',
    'sendcloud_send_failed'               => 'Échec de l\'envoi de courrier SendCloud',
    'sendcloud_from_address_empty'        => 'L\'adresse de l\'expéditeur SendCloud ne peut pas être vide',
    'sendcloud_from_address_invalid'      => 'Le format de l\'adresse de l\'expéditeur SendCloud est invalide: :address',
    'sendcloud_example_domain_not_supported' => 'SendCloud ne prend pas en charge les adresses de domaine d\'exemple: :address. Veuillez configurer une adresse e-mail d\'expéditeur réelle dans les paramètres du backend.',
    'sendcloud_to_address_empty'          => 'L\'adresse du destinataire SendCloud ne peut pas être vide',
    'sendcloud_to_address_invalid'        => 'Le format de l\'adresse du destinataire SendCloud est invalide: :address',
    'sendcloud_api_call_failed'           => 'Échec de l\'appel API SendCloud',
    'sendcloud_api_error'                 => 'Erreur SendCloud [:status_code]: :message',
    'sendcloud_send_success'              => 'Courrier SendCloud envoyé avec succès',
];
