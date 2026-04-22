<?php
/**
 * dashboard.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 10:57:57
 */

return [
    // Original translations
    'customer_new'  => 'Добавить пользователя',
    'customer_view' => 'посещения пользователей',
    'day_before'    => 'за день до',
    'latest_month'  => 'месяц',
    'latest_week'   => 'неделя',
    'latest_year'   => 'один год',
    'order_amount'  => 'Продажи',
    'order_report'  => 'статистика заказов',
    'order_total'   => 'сумма заказа',
    'product_total' => 'Новый продукт',
    'today'         => 'Сегодня',
    'yesterday'     => 'Вчера',

    // Dashboard new translations
    'page_title' => 'Мониторинг в реальном времени ключевых показателей платформы электронной коммерции и бизнес-производительности',
    'visitor_count' => 'Посетители',
    'cart_count' => 'Добавления в корзину',
    'purchase_count' => 'Покупки',
    'conversion_rate' => 'Коэффициент конверсии',
    'vs_yesterday' => 'vs Вчера',
    'export_report' => 'Экспорт отчета',
    'refresh_data' => 'Обновить данные',
    'visitor_trend' => 'Тренд посетителей',
    'customer_source_analysis' => 'Анализ источников клиентов',
    'loading_source_data' => 'Загрузка данных источников клиентов...',
    'loading' => 'Загрузка...',
    'order_funnel' => 'Воронка заказов',
    'refresh_funnel_data' => 'Обновить данные воронки',
    'hot_products' => 'Популярные товары',
    'slow_products' => 'Медленные товары',
    'sort_options' => 'Параметры сортировки',
    'sort_by_sales_desc' => 'По продажам (По убыванию)',
    'sort_by_sales_asc' => 'По продажам (По возрастанию)',
    'sort_by_price_desc' => 'По цене (По убыванию)',
    'sort_by_price_asc' => 'По цене (По возрастанию)',
    'loading_hot_products' => 'Загрузка данных популярных товаров...',
    'loading_slow_products' => 'Загрузка данных медленных товаров...',
    'near_7_days' => 'Последние 7 дней',

    // Conversion rate options
    'visitor_to_purchase' => 'Конверсия посетитель-покупка',
    'visitor_to_cart' => 'Конверсия посетитель-корзина',
    'cart_to_purchase' => 'Конверсия корзина-покупка',

    // Error messages
    'invalid_time_range' => 'Неверный временной диапазон: :timeRange. Поддерживаемые диапазоны: :validRanges',
    'invalid_product_type' => 'Неверный тип продукта: :type. Поддерживаемые типы: :validTypes',
    'invalid_export_format' => 'Неверный формат экспорта: :format. Поддерживаемые форматы: :validFormats',
    'get_stats_failed' => 'Ошибка получения статистики: :message',
    'get_trends_failed' => 'Ошибка получения данных тренда: :message',
    'get_mini_chart_failed' => 'Ошибка получения данных мини-графика: :message',
    'get_source_analysis_failed' => 'Ошибка получения данных анализа источников: :message',
    'get_funnel_failed' => 'Ошибка получения данных воронки: :message',
    'get_product_ranking_failed' => 'Ошибка получения данных рейтинга продуктов: :message',
    'export_report_failed' => 'Ошибка экспорта отчета: :message',
    'please_login_first' => 'Пожалуйста, сначала войдите в систему',
    'no_export_permission' => 'У вас нет разрешения на экспорт отчетов',
    'export_rate_limit' => 'Превышен лимит скорости экспорта, попробуйте позже',
    'get_cache_status_failed' => 'Ошибка получения статуса кэша: :message',
    'cache_clear_success' => 'Кэш успешно очищен',
    'cache_clear_failed' => 'Ошибка очистки кэша: :message',

    // Customer sources
    'direct_access' => 'Прямой доступ',
    'google' => 'Google',
    'baidu' => 'Baidu',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => 'Другое',
    'no_data' => 'Нет данных',

    // Funnel data
    'product_views' => 'Просмотры продуктов',
    'unique_visitors' => 'Уникальные посетители',
    'cart_additions' => 'Добавления в корзину',
    'orders' => 'Заказы',
    'successful_payments' => 'Успешные платежи',

    // Export report related
    'ranking' => 'Рейтинг',
    'product_name' => 'Название продукта',
    'price' => 'Цена',
    'sales' => 'Продажи',
    'percentage' => 'Процент',
    'sales_amount' => 'Сумма продаж',

    // Экспорт отчетов связанный
    'report_title' => 'Отчет панели данных BeikeShop',
    'export_time' => 'Время экспорта',
    'time_range' => 'Временной диапазон',
    'basic_stats' => 'Базовые статистические данные',
    'conversion_data' => 'Данные коэффициента конверсии',
    'conversion_funnel' => 'Воронка конверсии',
    'hot_products_ranking' => 'Рейтинг популярных товаров',
    'slow_products_ranking' => 'Рейтинг медленных товаров',
    'trend_data' => 'Данные тренда',

    // Статистические показатели
    'visitor_count' => 'Количество посетителей',
    'cart_count' => 'Количество добавлений в корзину',
    'purchase_count' => 'Количество покупок',
    'current_value' => 'Текущее значение',
    'previous_value' => 'Предыдущее значение',
    'change_percentage' => 'Процент изменения',
    'trend' => 'Тренд',
    'up' => 'Вверх',
    'down' => 'Вниз',

    // Коэффициент конверсии связанный
    'conversion_type' => 'Тип конверсии',
    'current_conversion_rate' => 'Текущий коэффициент конверсии',
    'previous_conversion_rate' => 'Предыдущий коэффициент конверсии',
    'change' => 'Изменение',

    // Анализ источников связанный
    'source' => 'Источник',
    'visits' => 'Визиты',
    'source_type' => 'Тип источника',
    'rank' => 'Ранг',
    'total' => 'Итого',

    // Воронка связанная
    'stage' => 'Этап',
    'quantity' => 'Количество',
    'conversion_rate' => 'Коэффициент конверсии',
    'width' => 'Ширина',
    'conversion_stage' => 'Этап конверсии',
    'user_count' => 'Количество пользователей',
    'loss_rate' => 'Коэффициент потерь',
    'funnel_width' => 'Ширина воронки',

    // Тренд связанный
    'time' => 'Время',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'Соотношение PV/UV',
    'summary' => 'Сводка',
    'page_views' => 'Просмотры страниц',
    'unique_visitors' => 'Уникальные посетители',

    // Рейтинг товаров связанный
    'hot_products_summary' => 'Сводка популярных товаров',
    'slow_products_summary' => 'Сводка медленных товаров',
];
