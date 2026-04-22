<?php
/**
 * dashboard.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 10:57:53
 */

return [
    // Original translations
    'customer_new'  => 'Usuarios nuevos',
    'customer_view' => 'Visitas de usuarios',
    'day_before'    => 'que el día anterior',
    'latest_month'  => 'un mes',
    'latest_week'   => 'una semana',
    'latest_year'   => 'un año',
    'order_amount'  => 'Ventas',
    'order_report'  => 'Estadísticas de pedidos',
    'order_total'   => 'Volumen de pedidos',
    'product_total' => 'Producto nuevo',
    'today'         => 'Hoy',
    'yesterday'     => 'Ayer',

    // Dashboard new translations
    'page_title' => 'Monitoreo en tiempo real de indicadores clave de la plataforma de comercio electrónico y rendimiento comercial',
    'visitor_count' => 'Visitantes',
    'cart_count' => 'Agregados al carrito',
    'purchase_count' => 'Compras',
    'conversion_rate' => 'Tasa de conversión',
    'vs_yesterday' => 'vs Ayer',
    'export_report' => 'Exportar informe',
    'refresh_data' => 'Actualizar datos',
    'visitor_trend' => 'Tendencia de visitantes',
    'customer_source_analysis' => 'Análisis de fuentes de clientes',
    'loading_source_data' => 'Cargando datos de fuentes de clientes...',
    'loading' => 'Cargando...',
    'order_funnel' => 'Embudo de pedidos',
    'refresh_funnel_data' => 'Actualizar datos del embudo',
    'hot_products' => 'Productos populares',
    'slow_products' => 'Productos lentos',
    'sort_options' => 'Opciones de ordenamiento',
    'sort_by_sales_desc' => 'Por ventas (Descendente)',
    'sort_by_sales_asc' => 'Por ventas (Ascendente)',
    'sort_by_price_desc' => 'Por precio (Descendente)',
    'sort_by_price_asc' => 'Por precio (Ascendente)',
    'loading_hot_products' => 'Cargando datos de productos populares...',
    'loading_slow_products' => 'Cargando datos de productos lentos...',
    'near_7_days' => 'Últimos 7 días',

    // Conversion rate options
    'visitor_to_purchase' => 'Conversión de visitante a compra',
    'visitor_to_cart' => 'Conversión de visitante a carrito',
    'cart_to_purchase' => 'Conversión de carrito a compra',

    // Error messages
    'invalid_time_range' => 'Rango de tiempo inválido: :timeRange. Rangos soportados: :validRanges',
    'invalid_product_type' => 'Tipo de producto inválido: :type. Tipos soportados: :validTypes',
    'invalid_export_format' => 'Formato de exportación inválido: :format. Formatos soportados: :validFormats',
    'get_stats_failed' => 'Error al obtener estadísticas: :message',
    'get_trends_failed' => 'Error al obtener datos de tendencia: :message',
    'get_mini_chart_failed' => 'Error al obtener datos de mini gráfico: :message',
    'get_source_analysis_failed' => 'Error al obtener datos de análisis de fuente: :message',
    'get_funnel_failed' => 'Error al obtener datos del embudo: :message',
    'get_product_ranking_failed' => 'Error al obtener datos de ranking de productos: :message',
    'export_report_failed' => 'Error al exportar informe: :message',
    'please_login_first' => 'Por favor inicie sesión primero',
    'no_export_permission' => 'No tiene permisos para exportar informes',
    'export_rate_limit' => 'Límite de tasa de exportación excedido, inténtelo de nuevo más tarde',
    'get_cache_status_failed' => 'Error al obtener estado de caché: :message',
    'cache_clear_success' => 'Caché limpiado exitosamente',
    'cache_clear_failed' => 'Error al limpiar caché: :message',

    // Customer sources
    'direct_access' => 'Acceso directo',
    'google' => 'Google',
    'baidu' => 'Baidu',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => 'Otro',
    'no_data' => 'Sin datos',

    // Funnel data
    'product_views' => 'Vistas de productos',
    'unique_visitors' => 'Visitantes únicos',
    'cart_additions' => 'Agregados al carrito',
    'orders' => 'Pedidos',
    'successful_payments' => 'Pagos exitosos',

    // Export report related
    'ranking' => 'Ranking',
    'product_name' => 'Nombre del producto',
    'price' => 'Precio',
    'sales' => 'Ventas',
    'percentage' => 'Porcentaje',
    'sales_amount' => 'Monto de ventas',

    // Exportación de reportes relacionada
    'report_title' => 'Reporte de panel de datos BeikeShop',
    'export_time' => 'Hora de exportación',
    'time_range' => 'Rango de tiempo',
    'basic_stats' => 'Datos estadísticos básicos',
    'conversion_data' => 'Datos de tasa de conversión',
    'conversion_funnel' => 'Embudo de conversión',
    'hot_products_ranking' => 'Ranking de productos populares',
    'slow_products_ranking' => 'Ranking de productos lentos',
    'trend_data' => 'Datos de tendencia',

    // Indicadores estadísticos
    'visitor_count' => 'Número de visitantes',
    'cart_count' => 'Número de agregados al carrito',
    'purchase_count' => 'Número de compras',
    'current_value' => 'Valor actual',
    'previous_value' => 'Valor anterior',
    'change_percentage' => 'Porcentaje de cambio',
    'trend' => 'Tendencia',
    'up' => 'Subida',
    'down' => 'Bajada',

    // Tasa de conversión relacionada
    'conversion_type' => 'Tipo de conversión',
    'current_conversion_rate' => 'Tasa de conversión actual',
    'previous_conversion_rate' => 'Tasa de conversión anterior',
    'change' => 'Cambio',

    // Análisis de fuente relacionado
    'source' => 'Fuente',
    'visits' => 'Visitas',
    'source_type' => 'Tipo de fuente',
    'rank' => 'Rango',
    'total' => 'Total',

    // Embudo relacionado
    'stage' => 'Etapa',
    'quantity' => 'Cantidad',
    'conversion_rate' => 'Tasa de conversión',
    'width' => 'Ancho',
    'conversion_stage' => 'Etapa de conversión',
    'user_count' => 'Número de usuarios',
    'loss_rate' => 'Tasa de pérdida',
    'funnel_width' => 'Ancho del embudo',

    // Tendencia relacionada
    'time' => 'Tiempo',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'Ratio PV/UV',
    'summary' => 'Resumen',
    'page_views' => 'Vistas de página',
    'unique_visitors' => 'Visitantes únicos',

    // Ranking de productos relacionado
    'hot_products_summary' => 'Resumen de productos populares',
    'slow_products_summary' => 'Resumen de productos lentos',
];
