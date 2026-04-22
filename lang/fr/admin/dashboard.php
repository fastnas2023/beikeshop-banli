<?php
/**
 * dashboard.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 10:57:54
 */

return [
    // Original translations
    'customer_new'  => 'Ajouter un utilisateur',
    'customer_view' => 'visites des utilisateurs',
    'day_before'    => 'un jour avant',
    'latest_month'  => 'mois',
    'latest_week'   => 'semaine',
    'latest_year'   => 'un an',
    'order_amount'  => 'Ventes',
    'order_report'  => 'statistiques de commande',
    'order_total'   => 'montant de la commande',
    'product_total' => 'Nouveau produit',
    'today'         => 'Aujourd\'hui',
    'yesterday'     => 'Hier',

    // Dashboard new translations
    'page_title' => 'Surveillance en temps réel des indicateurs clés de la plateforme e-commerce et des performances commerciales',
    'visitor_count' => 'Visiteurs',
    'cart_count' => 'Ajouts au panier',
    'purchase_count' => 'Achats',
    'conversion_rate' => 'Taux de conversion',
    'vs_yesterday' => 'vs Hier',
    'export_report' => 'Exporter le rapport',
    'refresh_data' => 'Actualiser les données',
    'visitor_trend' => 'Tendance des visiteurs',
    'customer_source_analysis' => 'Analyse des sources clients',
    'loading_source_data' => 'Chargement des données de sources clients...',
    'loading' => 'Chargement...',
    'order_funnel' => 'Entonnoir de commande',
    'refresh_funnel_data' => 'Actualiser les données de l\'entonnoir',
    'hot_products' => 'Produits populaires',
    'slow_products' => 'Produits lents',
    'sort_options' => 'Options de tri',
    'sort_by_sales_desc' => 'Par ventes (Décroissant)',
    'sort_by_sales_asc' => 'Par ventes (Croissant)',
    'sort_by_price_desc' => 'Par prix (Décroissant)',
    'sort_by_price_asc' => 'Par prix (Croissant)',
    'loading_hot_products' => 'Chargement des données de produits populaires...',
    'loading_slow_products' => 'Chargement des données de produits lents...',
    'near_7_days' => '7 derniers jours',

    // Conversion rate options
    'visitor_to_purchase' => 'Conversion visiteur vers achat',
    'visitor_to_cart' => 'Conversion visiteur vers panier',
    'cart_to_purchase' => 'Conversion panier vers achat',

    // Error messages
    'invalid_time_range' => 'Plage de temps invalide: :timeRange. Plages supportées: :validRanges',
    'invalid_product_type' => 'Type de produit invalide: :type. Types supportés: :validTypes',
    'invalid_export_format' => 'Format d\'exportation invalide: :format. Formats supportés: :validFormats',
    'get_stats_failed' => 'Échec de récupération des statistiques: :message',
    'get_trends_failed' => 'Échec de récupération des données de tendance: :message',
    'get_mini_chart_failed' => 'Échec de récupération des données de mini-graphique: :message',
    'get_source_analysis_failed' => 'Échec de récupération des données d\'analyse de source: :message',
    'get_funnel_failed' => 'Échec de récupération des données d\'entonnoir: :message',
    'get_product_ranking_failed' => 'Échec de récupération des données de classement des produits: :message',
    'export_report_failed' => 'Échec de l\'exportation du rapport: :message',
    'please_login_first' => 'Veuillez d\'abord vous connecter',
    'no_export_permission' => 'Vous n\'avez pas la permission d\'exporter des rapports',
    'export_rate_limit' => 'Limite de taux d\'exportation dépassée, veuillez réessayer plus tard',
    'get_cache_status_failed' => 'Échec de récupération du statut du cache: :message',
    'cache_clear_success' => 'Cache vidé avec succès',
    'cache_clear_failed' => 'Échec du vidage du cache: :message',

    // Customer sources
    'direct_access' => 'Accès direct',
    'google' => 'Google',
    'baidu' => 'Baidu',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => 'Autre',
    'no_data' => 'Aucune donnée',

    // Funnel data
    'product_views' => 'Vues de produits',
    'unique_visitors' => 'Visiteurs uniques',
    'cart_additions' => 'Ajouts au panier',
    'orders' => 'Commandes',
    'successful_payments' => 'Paiements réussis',

    // Export report related
    'ranking' => 'Classement',
    'product_name' => 'Nom du produit',
    'price' => 'Prix',
    'sales' => 'Ventes',
    'percentage' => 'Pourcentage',
    'sales_amount' => 'Montant des ventes',

    // Export de rapport lié
    'report_title' => 'Rapport de tableau de bord de données BeikeShop',
    'export_time' => 'Heure d\'exportation',
    'time_range' => 'Plage de temps',
    'basic_stats' => 'Données statistiques de base',
    'conversion_data' => 'Données de taux de conversion',
    'conversion_funnel' => 'Entonnoir de conversion',
    'hot_products_ranking' => 'Classement des produits populaires',
    'slow_products_ranking' => 'Classement des produits lents',
    'trend_data' => 'Données de tendance',

    // Indicateurs statistiques
    'visitor_count' => 'Nombre de visiteurs',
    'cart_count' => 'Nombre d\'ajouts au panier',
    'purchase_count' => 'Nombre d\'achats',
    'current_value' => 'Valeur actuelle',
    'previous_value' => 'Valeur précédente',
    'change_percentage' => 'Pourcentage de changement',
    'trend' => 'Tendance',
    'up' => 'Hausse',
    'down' => 'Baisse',

    // Taux de conversion lié
    'conversion_type' => 'Type de conversion',
    'current_conversion_rate' => 'Taux de conversion actuel',
    'previous_conversion_rate' => 'Taux de conversion précédent',
    'change' => 'Changement',

    // Analyse de source liée
    'source' => 'Source',
    'visits' => 'Visites',
    'source_type' => 'Type de source',
    'rank' => 'Rang',
    'total' => 'Total',

    // Entonnoir lié
    'stage' => 'Étape',
    'quantity' => 'Quantité',
    'conversion_rate' => 'Taux de conversion',
    'width' => 'Largeur',
    'conversion_stage' => 'Étape de conversion',
    'user_count' => 'Nombre d\'utilisateurs',
    'loss_rate' => 'Taux de perte',
    'funnel_width' => 'Largeur de l\'entonnoir',

    // Tendance liée
    'time' => 'Temps',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'Ratio PV/UV',
    'summary' => 'Résumé',
    'page_views' => 'Pages vues',
    'unique_visitors' => 'Visiteurs uniques',

    // Classement des produits lié
    'hot_products_summary' => 'Résumé des produits populaires',
    'slow_products_summary' => 'Résumé des produits lents',
];
