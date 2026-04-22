<?php
/**
 * dashboard.php
 *
 * @copyright  2023 beikeshop.com - All Rights Reserved
 * @link       https://beikeshop.com
 * @author     guangda <service@guangda.work>
 * @created    2023-09-09 09:09:09
 * @modified   2023-09-08 10:57:56
 */

return [
    // Original translations
    'customer_new'  => '신규 사용자',
    'customer_view' => '사용자 액세스',
    'day_before'    => '전날보다',
    'latest_month'  => '한 달',
    'latest_week'   => '주간',
    'latest_year'   => '1년',
    'order_amount'  => '매출액',
    'order_report'  => '주문통계',
    'order_total'   => '주문량',
    'product_total' => '신제품',
    'today'         => '오늘',
    'yesterday'     => '어제',

    // Dashboard new translations
    'page_title' => '전자상거래 플랫폼 핵심 지표 및 비즈니스 성과의 실시간 모니터링',
    'visitor_count' => '방문자',
    'cart_count' => '장바구니 추가',
    'purchase_count' => '구매',
    'conversion_rate' => '전환율',
    'vs_yesterday' => 'vs 어제',
    'export_report' => '보고서 내보내기',
    'refresh_data' => '데이터 새로고침',
    'visitor_trend' => '방문자 트렌드',
    'customer_source_analysis' => '고객 소스 분석',
    'loading_source_data' => '고객 소스 데이터 로딩 중...',
    'loading' => '로딩 중...',
    'order_funnel' => '주문 퍼널',
    'refresh_funnel_data' => '퍼널 데이터 새로고침',
    'hot_products' => '인기 상품',
    'slow_products' => '판매 부진 상품',
    'sort_options' => '정렬 옵션',
    'sort_by_sales_desc' => '판매량순 (내림차순)',
    'sort_by_sales_asc' => '판매량순 (오름차순)',
    'sort_by_price_desc' => '가격순 (내림차순)',
    'sort_by_price_asc' => '가격순 (오름차순)',
    'loading_hot_products' => '인기 상품 데이터 로딩 중...',
    'loading_slow_products' => '판매 부진 상품 데이터 로딩 중...',
    'near_7_days' => '최근 7일',

    // Conversion rate options
    'visitor_to_purchase' => '방문자-구매 전환',
    'visitor_to_cart' => '방문자-장바구니 전환',
    'cart_to_purchase' => '장바구니-구매 전환',

    // Error messages
    'invalid_time_range' => '유효하지 않은 시간 범위: :timeRange. 지원되는 범위: :validRanges',
    'invalid_product_type' => '유효하지 않은 상품 유형: :type. 지원되는 유형: :validTypes',
    'invalid_export_format' => '유효하지 않은 내보내기 형식: :format. 지원되는 형식: :validFormats',
    'get_stats_failed' => '통계 데이터 가져오기 실패: :message',
    'get_trends_failed' => '트렌드 데이터 가져오기 실패: :message',
    'get_mini_chart_failed' => '미니 차트 데이터 가져오기 실패: :message',
    'get_source_analysis_failed' => '소스 분석 데이터 가져오기 실패: :message',
    'get_funnel_failed' => '퍼널 데이터 가져오기 실패: :message',
    'get_product_ranking_failed' => '상품 순위 데이터 가져오기 실패: :message',
    'export_report_failed' => '보고서 내보내기 실패: :message',
    'please_login_first' => '먼저 로그인해주세요',
    'no_export_permission' => '보고서 내보내기 권한이 없습니다',
    'export_rate_limit' => '내보내기 속도 제한을 초과했습니다. 나중에 다시 시도해주세요',
    'get_cache_status_failed' => '캐시 상태 가져오기 실패: :message',
    'cache_clear_success' => '캐시가 성공적으로 정리되었습니다',
    'cache_clear_failed' => '캐시 정리 실패: :message',

    // Customer sources
    'direct_access' => '직접 접근',
    'google' => 'Google',
    'baidu' => 'Baidu',
    'bing' => 'Bing',
    'facebook' => 'Facebook',
    'twitter' => 'Twitter',
    'youtube' => 'YouTube',
    'linkedin' => 'LinkedIn',
    'instagram' => 'Instagram',
    'other' => '기타',
    'no_data' => '데이터 없음',

    // Funnel data
    'product_views' => '상품 조회수',
    'unique_visitors' => '고유 방문자',
    'cart_additions' => '장바구니 추가',
    'orders' => '주문',
    'successful_payments' => '성공한 결제',

    // Export report related
    'ranking' => '순위',
    'product_name' => '상품명',
    'price' => '가격',
    'sales' => '판매량',
    'percentage' => '비율',
    'sales_amount' => '매출액',

    // 보고서 내보내기 관련
    'report_title' => 'BeikeShop 데이터 대시보드 보고서',
    'export_time' => '내보내기 시간',
    'time_range' => '시간 범위',
    'basic_stats' => '기본 통계 데이터',
    'conversion_data' => '전환율 데이터',
    'conversion_funnel' => '전환 퍼널',
    'hot_products_ranking' => '인기 상품 순위',
    'slow_products_ranking' => '판매 부진 상품 순위',
    'trend_data' => '트렌드 데이터',

    // 통계 지표
    'visitor_count' => '방문자 수',
    'cart_count' => '장바구니 추가 수',
    'purchase_count' => '구매 수',
    'current_value' => '현재 값',
    'previous_value' => '이전 값',
    'change_percentage' => '변화율',
    'trend' => '트렌드',
    'up' => '상승',
    'down' => '하락',

    // 전환율 관련
    'conversion_type' => '전환 유형',
    'current_conversion_rate' => '현재 전환율',
    'previous_conversion_rate' => '이전 전환율',
    'change' => '변화',

    // 소스 분석 관련
    'source' => '소스',
    'visits' => '방문 수',
    'source_type' => '소스 유형',
    'rank' => '순위',
    'total' => '총계',

    // 퍼널 관련
    'stage' => '단계',
    'quantity' => '수량',
    'conversion_rate' => '전환율',
    'width' => '폭',
    'conversion_stage' => '전환 단계',
    'user_count' => '사용자 수',
    'loss_rate' => '이탈률',
    'funnel_width' => '퍼널 폭',

    // 트렌드 관련
    'time' => '시간',
    'pv' => 'PV',
    'uv' => 'UV',
    'pv_uv_ratio' => 'PV/UV 비율',
    'summary' => '요약',
    'page_views' => '페이지 뷰',
    'unique_visitors' => '고유 방문자',

    // 상품 순위 관련
    'hot_products_summary' => '인기 상품 요약',
    'slow_products_summary' => '판매 부진 상품 요약',
];
