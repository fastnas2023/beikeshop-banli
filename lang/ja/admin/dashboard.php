<?php
/**
 * dashboard.php
 *
 * @copyright  2022 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2022-08-02 14:22:41
 * @modified   2022-08-02 14:22:41
 */

return [
    // Original translations
    'product_total' => '新商品',
    'customer_view' => 'ユーザーの訪問',
    'order_total'   => '注文金額',
    'customer_new'  => 'ユーザーを追加',
    'order_amount'  => '売上',
    'today'         => '今日',
    'yesterday'     => '昨日',
    'day_before'    => '前日',
    'order_report'  => '注文統計',
    'latest_month'  => '月',
    'latest_week'   => '週',
    'latest_year'   => '1 年',

    // Dashboard new translations
    'page_title' => 'Eコマースプラットフォームの主要指標とビジネスパフォーマンスのリアルタイム監視',
    'visitor_count' => '訪問者数',
    'cart_count' => 'カート追加数',
    'purchase_count' => '購入数',
    'conversion_rate' => 'コンバージョン率',
    'vs_yesterday' => 'vs 昨日',
    'export_report' => 'レポートをエクスポート',
    'refresh_data' => 'データを更新',
    'visitor_trend' => '訪問者トレンド',
    'customer_source_analysis' => '顧客ソース分析',
    'loading_source_data' => '顧客ソースデータを読み込み中...',
    'loading' => '読み込み中...',
    'order_funnel' => '注文ファネル',
    'refresh_funnel_data' => 'ファネルデータを更新',
    'hot_products' => '人気商品',
    'slow_products' => '売れ行きの悪い商品',
    'sort_options' => '並び替えオプション',
    'sort_by_sales_desc' => '売上順（降順）',
    'sort_by_sales_asc' => '売上順（昇順）',
    'sort_by_price_desc' => '価格順（降順）',
    'sort_by_price_asc' => '価格順（昇順）',
    'loading_hot_products' => '人気商品データを読み込み中...',
    'loading_slow_products' => '売れ行きの悪い商品データを読み込み中...',
    'near_7_days' => '過去7日間',

    // Conversion rate options
    'visitor_to_purchase' => '訪問者から購入へのコンバージョン',
    'visitor_to_cart' => '訪問者からカートへのコンバージョン',
    'cart_to_purchase' => 'カートから購入へのコンバージョン',

    // Error messages
    'invalid_time_range' => '無効な時間範囲: :timeRange。サポートされている範囲: :validRanges',
    'invalid_product_type' => '無効な商品タイプ: :type。サポートされているタイプ: :validTypes',
    'invalid_export_format' => '無効なエクスポート形式: :format。サポートされている形式: :validFormats',
    'get_stats_failed' => '統計データの取得に失敗しました: :message',
    'get_trends_failed' => 'トレンドデータの取得に失敗しました: :message',
    'get_mini_chart_failed' => 'ミニチャートデータの取得に失敗しました: :message',
    'get_source_analysis_failed' => 'ソース分析データの取得に失敗しました: :message',
    'get_funnel_failed' => 'ファネルデータの取得に失敗しました: :message',
    'get_product_ranking_failed' => '商品ランキングデータの取得に失敗しました: :message',
    'export_report_failed' => 'レポートのエクスポートに失敗しました: :message',
    'please_login_first' => 'まずログインしてください',
    'no_export_permission' => 'レポートをエクスポートする権限がありません',
    'export_rate_limit' => 'エクスポートレート制限を超えました。後でもう一度お試しください',
    'get_cache_status_failed' => 'キャッシュステータスの取得に失敗しました: :message',
    'cache_clear_success' => 'キャッシュが正常にクリアされました',
    'cache_clear_failed' => 'キャッシュのクリアに失敗しました: :message',

    // Customer sources
    'direct_access' => '直接アクセス',
    'google' => 'Google',
    'baidu' => '百度',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => 'その他',
    'no_data' => 'データなし',

    // Funnel data
    'product_views' => '商品閲覧数',
    'unique_visitors' => 'ユニーク訪問者数',
    'cart_additions' => 'カート追加数',
    'orders' => '注文数',
    'successful_payments' => '成功した支払い数',

    // Export report related
    'ranking' => 'ランキング',
    'product_name' => '商品名',
    'price' => '価格',
    'sales' => '売上',
    'percentage' => '割合',
    'sales_amount' => '売上金額',

    // レポートエクスポート関連
    'report_title' => 'BeikeShop データダッシュボードレポート',
    'export_time' => 'エクスポート時間',
    'time_range' => '時間範囲',
    'basic_stats' => '基本統計データ',
    'conversion_data' => 'コンバージョン率データ',
    'conversion_funnel' => 'コンバージョンファネル',
    'hot_products_ranking' => '人気商品ランキング',
    'slow_products_ranking' => '売れ行きの悪い商品ランキング',
    'trend_data' => 'トレンドデータ',

    // 統計指標
    'visitor_count' => '訪問者数',
    'cart_count' => 'カート追加数',
    'purchase_count' => '購入数',
    'current_value' => '現在値',
    'previous_value' => '前回値',
    'change_percentage' => '変化率',
    'trend' => 'トレンド',
    'up' => '上昇',
    'down' => '下降',

    // コンバージョン率関連
    'conversion_type' => 'コンバージョンタイプ',
    'current_conversion_rate' => '現在のコンバージョン率',
    'previous_conversion_rate' => '前回のコンバージョン率',
    'change' => '変化',

    // ソース分析関連
    'source' => 'ソース',
    'visits' => '訪問数',
    'source_type' => 'ソースタイプ',
    'rank' => 'ランク',
    'total' => '合計',

    // ファネル関連
    'stage' => '段階',
    'quantity' => '数量',
    'conversion_rate' => 'コンバージョン率',
    'width' => '幅',
    'conversion_stage' => 'コンバージョン段階',
    'user_count' => 'ユーザー数',
    'loss_rate' => '離脱率',
    'funnel_width' => 'ファネル幅',

    // トレンド関連
    'time' => '時間',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'PV/UV比率',
    'summary' => 'サマリー',
    'page_views' => 'ページビュー',
    'unique_visitors' => 'ユニーク訪問者',

    // 商品ランキング関連
    'hot_products_summary' => '人気商品サマリー',
    'slow_products_summary' => '売れ行きの悪い商品サマリー',
];
