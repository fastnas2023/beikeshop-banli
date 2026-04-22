<?php
/**
 * dashboard.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 10:57:52
 */

return [
    // Original translations
    'customer_new'  => 'Benutzer hinzufügen',
    'customer_view' => 'Benutzerbesuche',
    'day_before'    => 'einen Tag vorher',
    'latest_month'  => 'Monat',
    'latest_week'   => 'Woche',
    'latest_year'   => 'ein Jahr',
    'order_amount'  => 'Umsatz',
    'order_report'  => 'Bestellstatistik',
    'order_total'   => 'Bestellmenge',
    'product_total' => 'Neues Produkt',
    'today'         => 'Heute',
    'yesterday'     => 'Gestern',

    // Dashboard new translations
    'page_title' => 'Echtzeitüberwachung der wichtigsten E-Commerce-Plattform-Indikatoren und Geschäftsleistung',
    'visitor_count' => 'Besucher',
    'cart_count' => 'Warenkorb-Zugänge',
    'purchase_count' => 'Käufe',
    'conversion_rate' => 'Konversionsrate',
    'vs_yesterday' => 'vs Gestern',
    'export_report' => 'Bericht exportieren',
    'refresh_data' => 'Daten aktualisieren',
    'visitor_trend' => 'Besuchertrend',
    'customer_source_analysis' => 'Kundenquellenanalyse',
    'loading_source_data' => 'Kundenquellendaten werden geladen...',
    'loading' => 'Laden...',
    'order_funnel' => 'Bestelltrichter',
    'refresh_funnel_data' => 'Trichterdaten aktualisieren',
    'hot_products' => 'Beliebte Produkte',
    'slow_products' => 'Langsame Produkte',
    'sort_options' => 'Sortieroptionen',
    'sort_by_sales_desc' => 'Nach Verkäufen (Absteigend)',
    'sort_by_sales_asc' => 'Nach Verkäufen (Aufsteigend)',
    'sort_by_price_desc' => 'Nach Preis (Absteigend)',
    'sort_by_price_asc' => 'Nach Preis (Aufsteigend)',
    'loading_hot_products' => 'Beliebte Produktedaten werden geladen...',
    'loading_slow_products' => 'Langsame Produktedaten werden geladen...',
    'near_7_days' => 'Letzte 7 Tage',

    // Conversion rate options
    'visitor_to_purchase' => 'Besucher-zu-Kauf-Konversion',
    'visitor_to_cart' => 'Besucher-zu-Warenkorb-Konversion',
    'cart_to_purchase' => 'Warenkorb-zu-Kauf-Konversion',

    // Error messages
    'invalid_time_range' => 'Ungültiger Zeitbereich: :timeRange. Unterstützte Bereiche: :validRanges',
    'invalid_product_type' => 'Ungültiger Produkttyp: :type. Unterstützte Typen: :validTypes',
    'invalid_export_format' => 'Ungültiges Exportformat: :format. Unterstützte Formate: :validFormats',
    'get_stats_failed' => 'Statistiken konnten nicht abgerufen werden: :message',
    'get_trends_failed' => 'Trenddaten konnten nicht abgerufen werden: :message',
    'get_mini_chart_failed' => 'Mini-Chart-Daten konnten nicht abgerufen werden: :message',
    'get_source_analysis_failed' => 'Quellenanalysedaten konnten nicht abgerufen werden: :message',
    'get_funnel_failed' => 'Trichterdaten konnten nicht abgerufen werden: :message',
    'get_product_ranking_failed' => 'Produktranking-Daten konnten nicht abgerufen werden: :message',
    'export_report_failed' => 'Bericht konnte nicht exportiert werden: :message',
    'please_login_first' => 'Bitte zuerst anmelden',
    'no_export_permission' => 'Sie haben keine Berechtigung, Berichte zu exportieren',
    'export_rate_limit' => 'Export-Ratenlimit überschritten, bitte versuchen Sie es später erneut',
    'get_cache_status_failed' => 'Cache-Status konnte nicht abgerufen werden: :message',
    'cache_clear_success' => 'Cache erfolgreich geleert',
    'cache_clear_failed' => 'Cache konnte nicht geleert werden: :message',

    // Customer sources
    'direct_access' => 'Direkter Zugriff',
    'google' => 'Google',
    'baidu' => 'Baidu',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => 'Andere',
    'no_data' => 'Keine Daten',

    // Funnel data
    'product_views' => 'Produktansichten',
    'unique_visitors' => 'Eindeutige Besucher',
    'cart_additions' => 'Warenkorb-Zugänge',
    'orders' => 'Bestellungen',
    'successful_payments' => 'Erfolgreiche Zahlungen',

    // Export report related
    'ranking' => 'Rang',
    'product_name' => 'Produktname',
    'price' => 'Preis',
    'sales' => 'Verkäufe',
    'percentage' => 'Prozentsatz',
    'sales_amount' => 'Umsatz',

    // Berichtsexport bezogen
    'report_title' => 'BeikeShop Daten-Dashboard-Bericht',
    'export_time' => 'Exportzeit',
    'time_range' => 'Zeitbereich',
    'basic_stats' => 'Grundlegende Statistiken',
    'conversion_data' => 'Konversionsraten-Daten',
    'conversion_funnel' => 'Konversions-Trichter',
    'hot_products_ranking' => 'Beliebte Produkte Ranking',
    'slow_products_ranking' => 'Langsame Produkte Ranking',
    'trend_data' => 'Trend-Daten',

    // Statistik-Indikatoren
    'visitor_count' => 'Besucheranzahl',
    'cart_count' => 'Warenkorb-Anzahl',
    'purchase_count' => 'Kauf-Anzahl',
    'current_value' => 'Aktueller Wert',
    'previous_value' => 'Vorheriger Wert',
    'change_percentage' => 'Änderungsprozentsatz',
    'trend' => 'Trend',
    'up' => 'Aufwärts',
    'down' => 'Abwärts',

    // Konversionsrate bezogen
    'conversion_type' => 'Konversionstyp',
    'current_conversion_rate' => 'Aktuelle Konversionsrate',
    'previous_conversion_rate' => 'Vorherige Konversionsrate',
    'change' => 'Änderung',

    // Quellenanalyse bezogen
    'source' => 'Quelle',
    'visits' => 'Besuche',
    'source_type' => 'Quellentyp',
    'rank' => 'Rang',
    'total' => 'Gesamt',

    // Trichter bezogen
    'stage' => 'Stufe',
    'quantity' => 'Menge',
    'conversion_rate' => 'Konversionsrate',
    'width' => 'Breite',
    'conversion_stage' => 'Konversionsstufe',
    'user_count' => 'Benutzeranzahl',
    'loss_rate' => 'Verlustrate',
    'funnel_width' => 'Trichterbreite',

    // Trend bezogen
    'time' => 'Zeit',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'PV/UV-Verhältnis',
    'summary' => 'Zusammenfassung',
    'page_views' => 'Seitenaufrufe',
    'unique_visitors' => 'Eindeutige Besucher',

    // Produktranking bezogen
    'hot_products_summary' => 'Beliebte Produkte Zusammenfassung',
    'slow_products_summary' => 'Langsame Produkte Zusammenfassung',
];
