<?php
/**
 * dashboard.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 10:57:55
 */

return [
    // Original translations
    'customer_new'  => 'Aggiungi utente',
    'customer_view' => 'visite degli utenti',
    'day_before'    => 'un giorno prima',
    'latest_month'  => 'mese',
    'latest_week'   => 'settimana',
    'latest_year'   => 'un anno',
    'order_amount'  => 'Vendite',
    'order_report'  => 'statistiche degli ordini',
    'order_total'   => 'importo dell\'ordine',
    'product_total' => 'Nuovo prodotto',
    'today'         => 'Oggi',
    'yesterday'     => 'Ieri',

    // Dashboard new translations
    'page_title' => 'Monitoraggio in tempo reale degli indicatori chiave della piattaforma e-commerce e delle prestazioni commerciali',
    'visitor_count' => 'Visitatori',
    'cart_count' => 'Aggiunte al carrello',
    'purchase_count' => 'Acquisti',
    'conversion_rate' => 'Tasso di conversione',
    'vs_yesterday' => 'vs Ieri',
    'export_report' => 'Esporta report',
    'refresh_data' => 'Aggiorna dati',
    'visitor_trend' => 'Tendenza visitatori',
    'customer_source_analysis' => 'Analisi fonti clienti',
    'loading_source_data' => 'Caricamento dati fonti clienti...',
    'loading' => 'Caricamento...',
    'order_funnel' => 'Imbuto ordini',
    'refresh_funnel_data' => 'Aggiorna dati imbuto',
    'hot_products' => 'Prodotti popolari',
    'slow_products' => 'Prodotti lenti',
    'sort_options' => 'Opzioni di ordinamento',
    'sort_by_sales_desc' => 'Per vendite (Decrescente)',
    'sort_by_sales_asc' => 'Per vendite (Crescente)',
    'sort_by_price_desc' => 'Per prezzo (Decrescente)',
    'sort_by_price_asc' => 'Per prezzo (Crescente)',
    'loading_hot_products' => 'Caricamento dati prodotti popolari...',
    'loading_slow_products' => 'Caricamento dati prodotti lenti...',
    'near_7_days' => 'Ultimi 7 giorni',

    // Conversion rate options
    'visitor_to_purchase' => 'Conversione visitatore ad acquisto',
    'visitor_to_cart' => 'Conversione visitatore a carrello',
    'cart_to_purchase' => 'Conversione carrello ad acquisto',

    // Error messages
    'invalid_time_range' => 'Intervallo di tempo non valido: :timeRange. Intervalli supportati: :validRanges',
    'invalid_product_type' => 'Tipo di prodotto non valido: :type. Tipi supportati: :validTypes',
    'invalid_export_format' => 'Formato di esportazione non valido: :format. Formati supportati: :validFormats',
    'get_stats_failed' => 'Errore nel recupero delle statistiche: :message',
    'get_trends_failed' => 'Errore nel recupero dei dati di tendenza: :message',
    'get_mini_chart_failed' => 'Errore nel recupero dei dati del mini grafico: :message',
    'get_source_analysis_failed' => 'Errore nel recupero dei dati di analisi delle fonti: :message',
    'get_funnel_failed' => 'Errore nel recupero dei dati dell\'imbuto: :message',
    'get_product_ranking_failed' => 'Errore nel recupero dei dati di ranking dei prodotti: :message',
    'export_report_failed' => 'Errore nell\'esportazione del report: :message',
    'please_login_first' => 'Effettua prima l\'accesso',
    'no_export_permission' => 'Non hai i permessi per esportare i report',
    'export_rate_limit' => 'Limite di tasso di esportazione superato, riprova più tardi',
    'get_cache_status_failed' => 'Errore nel recupero dello stato della cache: :message',
    'cache_clear_success' => 'Cache pulita con successo',
    'cache_clear_failed' => 'Errore nella pulizia della cache: :message',

    // Customer sources
    'direct_access' => 'Accesso diretto',
    'google' => 'Google',
    'baidu' => 'Baidu',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => 'Altro',
    'no_data' => 'Nessun dato',

    // Funnel data
    'product_views' => 'Visualizzazioni prodotti',
    'unique_visitors' => 'Visitatori unici',
    'cart_additions' => 'Aggiunte al carrello',
    'orders' => 'Ordini',
    'successful_payments' => 'Pagamenti riusciti',

    // Export report related
    'ranking' => 'Classifica',
    'product_name' => 'Nome prodotto',
    'price' => 'Prezzo',
    'sales' => 'Vendite',
    'percentage' => 'Percentuale',
    'sales_amount' => 'Importo vendite',

    // Esportazione report correlata
    'report_title' => 'Rapporto dashboard dati BeikeShop',
    'export_time' => 'Ora di esportazione',
    'time_range' => 'Intervallo di tempo',
    'basic_stats' => 'Dati statistici di base',
    'conversion_data' => 'Dati tasso di conversione',
    'conversion_funnel' => 'Imbuto di conversione',
    'hot_products_ranking' => 'Classifica prodotti popolari',
    'slow_products_ranking' => 'Classifica prodotti lenti',
    'trend_data' => 'Dati di tendenza',

    // Indicatori statistici
    'visitor_count' => 'Numero di visitatori',
    'cart_count' => 'Numero di aggiunte al carrello',
    'purchase_count' => 'Numero di acquisti',
    'current_value' => 'Valore attuale',
    'previous_value' => 'Valore precedente',
    'change_percentage' => 'Percentuale di cambiamento',
    'trend' => 'Tendenza',
    'up' => 'Su',
    'down' => 'Giù',

    // Tasso di conversione correlato
    'conversion_type' => 'Tipo di conversione',
    'current_conversion_rate' => 'Tasso di conversione attuale',
    'previous_conversion_rate' => 'Tasso di conversione precedente',
    'change' => 'Cambiamento',

    // Analisi fonte correlata
    'source' => 'Fonte',
    'visits' => 'Visite',
    'source_type' => 'Tipo di fonte',
    'rank' => 'Rango',
    'total' => 'Totale',

    // Imbuto correlato
    'stage' => 'Fase',
    'quantity' => 'Quantità',
    'conversion_rate' => 'Tasso di conversione',
    'width' => 'Larghezza',
    'conversion_stage' => 'Fase di conversione',
    'user_count' => 'Numero di utenti',
    'loss_rate' => 'Tasso di perdita',
    'funnel_width' => 'Larghezza imbuto',

    // Tendenza correlata
    'time' => 'Tempo',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'Rapporto PV/UV',
    'summary' => 'Riepilogo',
    'page_views' => 'Visualizzazioni pagina',
    'unique_visitors' => 'Visitatori unici',

    // Classifica prodotti correlata
    'hot_products_summary' => 'Riepilogo prodotti popolari',
    'slow_products_summary' => 'Riepilogo prodotti lenti',
];
