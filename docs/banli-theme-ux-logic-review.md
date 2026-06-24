# BanliTheme UX 与逻辑审查报告

审查范围：`plugins/BanliTheme` 前台主题、装修模块、购物车、结账、商品详情、分类/搜索、页脚订阅。

结论：主题的视觉方向明确，但现在还有一批会影响真实店铺体验和业务逻辑稳定性的问题。最优先处理的是可导致脚本注入或页面交互失效的确定 bug，其次是“演示站内容硬编码进主题”的产品化问题。

## 优先级说明

- P0：线上高概率事故或数据风险，需要立刻修。
- P1：确定 bug，影响下单、浏览、安装或安全。
- P2：明显 UX/逻辑反模式，影响转化、可维护性或多语言。
- P3：体验细节和技术债，建议排期治理。

## 工作进度 Todo

更新规则：

- 完成一项后，把 `[ ]` 改为 `[x]`。
- 如果正在做但未完成，在任务后追加 `状态：进行中`。
- 每项修完后补一句 `处理记录：...`，方便回看决策。
- 修复类任务先做 P1，再做交易路径 P2，最后做产品化与结构治理。

### P1 必修

- [x] P1-01 修复商品视频 URL 注入风险  
  涉及：`plugins/BanliTheme/Views/product/product-video.blade.php`  
  验收：商品视频地址包含单引号、换行、URL 参数时页面不报错；YouTube videoId 被白名单限制。
  处理记录：已改为 `@json($product['video'])` 输出，并对 YouTube ID 做 `[A-Za-z0-9_-]` 白名单过滤。

- [x] P1-02 修复 offcanvas backdrop 全局层级污染  
  涉及：`plugins/BanliTheme/Views/layout/master.blade.php`、`plugins/BanliTheme/Views/layout/header.blade.php`  
  验收：手机端搜索、移动菜单、右侧购物车都能打开；面板在遮罩上方；点击与关闭正常。
  处理记录：已将高层级 backdrop 限定到 `body.banli-search-open`，搜索 offcanvas 打开/关闭时自动切换该 body class。

- [x] P1-03 补齐 BanliTheme 插件安装所需静态资源  
  涉及：`plugins/BanliTheme/Static/public`、`public/banli_theme-assets`、`public/build/beike/shop/banli_theme/banli_theme`  
  验收：新环境只安装插件后，首页 CSS/JS/图片/视频无 404。
  处理记录：已同步 `banli_theme-assets`、`build/beike/shop/banli_theme/banli_theme` 和 Hero 预览 SVG 到插件 `Static/public`，并补充 `plugins/.gitignore` 例外规则，确保资源能进入版本库。

- [x] P1-04 修复商品规格禁用项仍可点击的问题  
  涉及：`plugins/BanliTheme/Views/product/product.blade.php`  
  验收：无库存/无效规格不可选；点击禁用规格不会更新 SKU，不会触发 JS 报错。
  处理记录：已在 CSS 和 Vue 方法两层阻止禁用规格点击，并给找不到 SKU 的路径加错误提示和空值兜底。

- [x] P1-05 商品详情加入购物车和立即购买增加防连点  
  涉及：`plugins/BanliTheme/Views/product/product.blade.php`、`plugins/BanliTheme/Resources/beike/shop/banli_theme/js/common.js`  
  验收：请求中按钮禁用并显示 loading；快速连点不会重复加入购物车或重复跳转。
  处理记录：已增加 `isAddingCart` 状态，商品详情按钮提交中禁用；`bk.addCart` 现在返回 Promise，并只在存在按钮时处理 loading。

- [x] P1-06 修复迷你购物车数量清空提交 0 的问题  
  涉及：`plugins/BanliTheme/Resources/beike/shop/banli_theme/js/header.js`  
  验收：清空、输入 0、输入非数字都会规范化为最小数量 1 后再提交。
  处理记录：已在提交前用 `parseInt` 规范化数量，空值、非数字、小于 1 都重置为 1。

### P2 交易路径与核心体验

- [x] P2-01 结账页提交订单增加 loading 和防重复提交  
  涉及：`plugins/BanliTheme/Views/checkout.blade.php`  
  验收：提交中按钮不可重复点击；失败后恢复；成功后只跳转一次。
  处理记录：已增加 `checkoutSubmitting` 状态，提交按钮请求中禁用并显示 loading；失败响应和异常会恢复按钮，成功路径只执行一次跳转。

- [x] P2-02 结账页动态支付/物流 HTML 渲染改为安全渲染  
  涉及：`plugins/BanliTheme/Views/checkout.blade.php`  
  验收：支付/物流名称、图标、价格不会因引号或 HTML 字符破坏结构；允许 HTML 的字段有明确白名单。
  处理记录：动态支付/物流/总计改为 DOM API 写入文本和属性；`quote.html` 仅保留少量白名单标签和 class，初始服务端渲染去掉裸 `{!! !!}`。

- [x] P2-03 搜索弹窗事件绑定去重并处理自动完成竞态  
  涉及：`plugins/BanliTheme/Resources/beike/shop/banli_theme/js/header.js`、`plugins/BanliTheme/Views/components/search-popover.blade.php`  
  验收：反复打开搜索后 Enter 只触发一次；快速输入时只展示最后一次关键词结果。
  处理记录：移除 `header.js` 内重复 Enter 绑定；搜索弹窗事件改成命名空间绑定，autocomplete 使用请求序号丢弃旧响应。

- [x] P2-04 移动菜单打开逻辑去重  
  涉及：`plugins/BanliTheme/Views/layout/header.blade.php`、`plugins/BanliTheme/Resources/beike/shop/banli_theme/js/header.js`  
  验收：保留一种 offcanvas 打开机制；backdrop、focus、关闭状态稳定。
  处理记录：保留 Bootstrap `data-bs-toggle="offcanvas"` 机制，删除手写 `new bootstrap.Offcanvas(...).show()` 的重复打开逻辑。

- [x] P2-05 移动分类筛选改成标准 offcanvas  
  涉及：`plugins/BanliTheme/Views/category.blade.php`  
  验收：有标题、关闭按钮、ESC/遮罩关闭、body scroll lock；不再使用字符串 `setTimeout`。
  处理记录：分类筛选改为同一份 DOM 的 `offcanvas-lg`，桌面保持 sticky 侧栏，手机使用 Bootstrap offcanvas；已移除自写遮罩和字符串 `setTimeout`。

- [x] P2-06 统一 header 高度与页面顶部间距  
  涉及：`plugins/BanliTheme/Views/layout/master.blade.php`、`plugins/BanliTheme/Views/search.blade.php`、`plugins/BanliTheme/Views/category.blade.php`  
  验收：桌面/手机/滚动状态/多语言 top bar 下，非首页内容都不被 header 遮挡，也没有过大空白。
  处理记录：新增全局 `--banli-header-height` 更新逻辑，搜索/分类/结账页改用真实 header 高度；首页继续保留 hero 与透明 header 叠加。

### P2 产品化与内容治理

- [x] P2-07 页脚订阅改为真实功能或后台开关  
  涉及：`plugins/BanliTheme/Views/layout/footer.blade.php`  
  验收：没有真实接口时不显示假成功；接入接口后有提交中、成功、失败、重复订阅状态。
  处理记录：默认不渲染假订阅表单；只有配置启用并提供 endpoint 时才显示，提交走真实 POST，并有 loading、成功、失败和本地重复订阅提示。

- [x] P2-08 移除或配置化硬编码 AI 峰会内容  
  涉及：`plugins/BanliTheme/Views/home.blade.php`、`plugins/BanliTheme/Views/layout/footer.blade.php`、`plugins/BanliTheme/Views/design/*.blade.php`、`plugins/BanliTheme/Bootstrap.php`、Seeder 数据  
  验收：首页 marquee、页脚订阅、Hero 和设计模块默认文案可配置或可移除；普通电商店铺不会出现 AI Summit/Tickets/Schedule 等活动文案。
  处理记录：首页 marquee 改为可配置通用电商词；页脚订阅和默认地址去演示化；Hero 前台/后台默认值、Seeder、富文本、产品模块、图文多列、套餐轮播、门店联系和文章模块 fallback 均改为通用电商/企业独立站内容。`Bootstrap` 只保留旧模板识别规则，用于把历史 AI 活动默认数据归一到通用默认值，不作为展示默认值。
  验证记录：`https://bk.test` 首页 HTML 与浏览器冒烟均未检出 AI Summit、Tickets、Schedule、San Francisco 等旧活动文案；历史装修数据里的活动模块会在运行时显示为通用电商/企业独立站内容。

- [x] P2-09 补齐多语言文案  
  涉及：分类页、页脚、搜索、按钮文案、提示文案  
  验收：切换语言后不出现硬编码中英混杂；新增文案进入 lang 文件或后台配置。
  处理记录：新增 `plugins/BanliTheme/Lang/{en,zh_cn,zh_hk}/common.php`，分类、首页 marquee、页脚订阅、富文本 fallback 等新增文案改为语言 key 或后台配置。

- [x] P2-10 产品卡片行为 props 化  
  涉及：`plugins/BanliTheme/Views/shared/product.blade.php`、分类页、搜索页、搜索弹窗  
  验收：产品卡片不直接依赖 `request('style_list')` 决定 UI；由调用方明确传入 `mode` 和 `show_actions`。
  处理记录：`shared.product` 改用 `mode` 和 `show_actions`；分类页、搜索页、搜索弹窗、autocomplete 产品片段显式传入卡片模式。

### P3 结构与可维护性

- [ ] P3-00 前端 QA 回归：移动端视觉与交互问题  
  涉及：首页 Hero、分类筛选 offcanvas、header 图标区、搜索弹窗  
  验收：390px 手机视口首屏文案清晰可读，CTA 不被裁切；分类筛选面板打开后完整进入视口；搜索弹窗桌面/手机均能打开并返回结果；console 无相关 JS error。
  审计记录：2026-05-30 使用 Playwright fallback 检查 `https://bk.test` 首页、分类、搜索、商品、购物车、登录入口。首页/分类/搜索/商品/购物车均 200，`/account` 正常 302 到 `/login`，旧 AI 活动文案未检出，移动菜单可打开。发现手机 Hero 可读性差且按钮横向裁切；手机分类筛选面板 `.show` 后仍 `transform: matrix(..., -340, 0)`，实际坐标 `left: -320/right: 20`，视觉上几乎仍在屏幕外。

- [ ] P3-01 收敛 Blade 内联 CSS/JS 到 SCSS/JS 源文件  
  涉及：`layout/header.blade.php`、`layout/master.blade.php`、`cart/mini.blade.php`、`product/product.blade.php` 等  
  验收：主题样式主要来自 `Resources/.../scss`；Blade 中只保留必要动态变量。

- [ ] P3-02 避免重复加载 Vue 和全局脚本  
  涉及：`layout/master.blade.php`、`cart/cart.blade.php`、`checkout.blade.php`  
  验收：每页 Vue 只加载一次；ElementUI 只在需要页面加载。

- [ ] P3-03 外链新窗口补安全属性  
  涉及：footer、header、desktop/mobile menu  
  验收：所有 `target="_blank"` 都带 `rel="noopener noreferrer"`。

- [ ] P3-04 行为控件语义化  
  涉及：`checkout/_address.blade.php`、header switcher、产品卡片按钮  
  验收：行为用 button，导航用 a；`javascript:void(0)` 不再作为默认交互方案。

- [ ] P3-05 建立回归测试清单  
  涉及：商品详情、购物车、结账、搜索、移动菜单、分类筛选  
  验收：每次修复后能用同一清单跑桌面和手机视口，记录通过/失败。

## P1 确定问题

### 1. 商品视频 URL 直接拼进 JS 字符串

位置：`plugins/BanliTheme/Views/product/product-video.blade.php:27`

```blade
const videoUrl = '{!! $product['video'] !!}';
```

问题：

- 后台可配置的商品视频地址只要包含单引号、换行或脚本片段，就能打断 JS 字符串。
- 轻则商品详情页脚本报错，重则形成 XSS 面。

建议：

- 改成 `const videoUrl = @json($product['video']);`
- YouTube `videoId` 再做白名单校验，例如只允许 `[A-Za-z0-9_-]`。

### 2. 搜索弹窗的 backdrop 层级污染所有 offcanvas

位置：`plugins/BanliTheme/Views/layout/master.blade.php:179`

```css
.offcanvas-backdrop {
  z-index: 2190;
}
```

问题：

- 这是全局选择器，不只影响搜索弹窗。
- 移动菜单和右侧购物车 offcanvas 没有同步提高 z-index，可能被 backdrop 盖住，表现为菜单打开但无法点击。

建议：

- 只给搜索 offcanvas 使用高层级。
- 或者在搜索打开时给 body 加专属 class，再限定 `.banli-search-open .offcanvas-backdrop`。

### 3. 插件包缺少运行时资源，换环境会 404

位置：

- `plugins/BanliTheme/Views/layout/master.blade.php:77`
- `plugins/BanliTheme/Views/layout/master.blade.php:504`
- `plugins/BanliTheme/Views/design/banli_hero.blade.php:78`

问题：

- 前台加载 `public/build/beike/shop/banli_theme/banli_theme/...`
- Hero 默认依赖 `public/banli_theme-assets/aivent/...`
- 但 `plugins/BanliTheme/Static/public` 里没有这些完整资源。当前本机能跑，是因为 public 目录里已经有资源；插件独立安装到新环境后会缺 CSS/JS/图片/视频。

建议：

- 把 `banli_theme-assets` 和 `banli_theme/css|js` 纳入 `Static/public`。
- 或者写明确的发布/复制脚本，并在安装后校验资源存在。

### 4. 商品规格禁用项仍然可点击，可能导致 JS 崩溃

位置：

- `plugins/BanliTheme/Views/product/product.blade.php:180`
- `plugins/BanliTheme/Views/product/product.blade.php:661`
- `plugins/BanliTheme/Views/product/product.blade.php:937`
- `plugins/BanliTheme/Views/product/product.blade.php:960`

问题：

- `.disabled` 只是视觉样式，没有 `pointer-events: none`，点击事件仍会执行。
- `checkedVariableValue()` 没有判断 `value.disabled`。
- `getSelectedSku()` 假设一定能找到 sku，后续直接访问 `sku.images`。如果组合不存在，就会报错。

建议：

- 点击时先 `if (value.disabled) return;`
- `getSelectedSku()` 找不到 sku 时要兜底，不更新商品数据，并提示用户选择有效组合。
- CSS 上增加 `pointer-events: none` 只能作为辅助，业务逻辑仍要防守。

### 5. 商品详情加入购物车没有 loading/防连点

位置：

- `plugins/BanliTheme/Views/product/product.blade.php:696`
- `plugins/BanliTheme/Views/product/product.blade.php:1016`
- `plugins/BanliTheme/Resources/beike/shop/banli_theme/js/common.js:47`

问题：

- 商品列表调用 `bk.addCart(..., this)`，按钮会进入 loading。
- 商品详情页调用 `bk.addCart(params, null, ...)`，没有传按钮事件，按钮不会禁用。
- 用户快速连点可能重复加入购物车或重复触发立即购买流程。

建议：

- Vue 方法接收 `$event.currentTarget`，传给 `bk.addCart`。
- 或在商品详情 Vue 内维护 `addingCart` 状态，提交中禁用两个按钮。

### 6. 迷你购物车数量清空会提交 0

位置：`plugins/BanliTheme/Resources/beike/shop/banli_theme/js/header.js:132`

问题：

- 代码先读取 `quantity`，再把空输入改成 1。
- 用户清空输入框后触发 change，提交到后端的是 0。

建议：

- 先规范化值，再提交。
- 数量统一用 `Math.max(1, parseInt(value, 10) || 1)`。

## P2 用户体验与产品逻辑问题

### 7. 页脚订阅是假提交，但总是提示成功

位置：

- `plugins/BanliTheme/Views/layout/footer.blade.php:53`
- `plugins/BanliTheme/Views/layout/footer.blade.php:152`

问题：

- 表单没有真实 API、没有存储、没有邮件订阅系统。
- 只要邮箱格式对，就提示“订阅成功”。
- 这会误导用户，也会让店主以为订阅功能可用。

建议：

- 没有后端前先隐藏订阅区，或改成后台可配置开关。
- 如果保留，需要接入真实接口，并处理提交中、成功、失败、重复订阅状态。

### 8. 主题里硬编码 AI 峰会/科技站内容

位置：

- `plugins/BanliTheme/Views/home.blade.php:15`
- `plugins/BanliTheme/Views/layout/footer.blade.php:46`
- `plugins/BanliTheme/Views/layout/footer.blade.php:49`
- `plugins/BanliTheme/Views/design/banli_hero.blade.php:81`

问题：

- 首页固定注入 AI marquee。
- 页脚订阅文案固定为英文科技会展语境。
- Hero 默认文案大量使用 `AI Summit 2026`、`San Francisco`、`Tickets/Schedule`。
- 作为演示站可以，但作为主题插件会污染所有真实商店。

建议：

- 把 marquee 和 footer subscribe 做成装修模块或后台配置。
- 默认文案改成通用电商语境。
- 所有 demo 文案通过 seeder 注入，主题运行时不要强绑行业内容。

### 9. 多语言体验不完整

位置：

- `plugins/BanliTheme/Views/category.blade.php:433`
- `plugins/BanliTheme/Views/category.blade.php:516`
- `plugins/BanliTheme/Views/layout/footer.blade.php:46`
- `plugins/BanliTheme/Views/layout/footer.blade.php:54`
- `plugins/BanliTheme/Views/layout/footer.blade.php:159`

问题：

- `Collection`、`Filter`、`Stay in the Loop`、`SIGN UP`、订阅提示等是硬编码英文/中文。
- 真实多语言店铺里会出现中英混杂。

建议：

- 全部进入 lang 文件或后台配置。
- 不要在 Blade 里直接写固定英文 CTA。

### 10. 搜索输入存在重复绑定与竞态

位置：

- `plugins/BanliTheme/Resources/beike/shop/banli_theme/js/header.js:13`
- `plugins/BanliTheme/Views/components/search-popover.blade.php:66`
- `plugins/BanliTheme/Views/components/search-popover.blade.php:118`

问题：

- `header.js` 每次搜索 offcanvas shown 都重新给 input 绑定 keydown。
- `search-popover.blade.php` 自己也绑定 keydown。
- 自动完成没有请求取消或响应序号控制，快速输入时旧结果可能覆盖新结果。

建议：

- 搜索提交只保留一个入口。
- 使用命名空间事件：`.off('keydown.banliSearch').on('keydown.banliSearch', ...)`。
- 自动完成增加 request id，只渲染最后一次请求结果。

### 11. 结账页动态 HTML 拼接没有转义边界

位置：

- `plugins/BanliTheme/Views/checkout.blade.php:240`
- `plugins/BanliTheme/Views/checkout.blade.php:249`
- `plugins/BanliTheme/Views/checkout.blade.php:269`

问题：

- `title`、`amount_format`、`quote.name`、`quote.html` 等直接拼成 HTML 字符串。
- 如果支付/物流插件返回异常 HTML 或未净化内容，会污染页面。
- 这类拼接也容易破坏布局，例如名称里有引号会打断属性。

建议：

- 用 DOM API 或 Vue 渲染结构化数据。
- 允许 HTML 的字段只保留白名单，并明确来源。

### 12. 结账提交按钮没有提交中状态

位置：`plugins/BanliTheme/Views/checkout.blade.php:186`

问题：

- 点提交订单后按钮不禁用，用户可重复点击。
- 网络慢时可能重复请求 `/checkout/confirm`。

建议：

- 提交开始禁用按钮并显示 loading。
- 请求完成或失败后恢复。
- 后端也应有幂等保护。

### 13. 移动菜单打开逻辑重复

位置：

- `plugins/BanliTheme/Views/layout/header.blade.php:593`
- `plugins/BanliTheme/Views/layout/header.blade.php:839`
- `plugins/BanliTheme/Resources/beike/shop/banli_theme/js/header.js:67`

问题：

- 元素已经有 `data-bs-toggle="offcanvas"`。
- JS 又监听 `.mobile-open-menu` 并手动 `new bootstrap.Offcanvas(...).show()`。
- 这会造成重复初始化/重复触发，某些 Bootstrap 状态下可能出现 backdrop、focus 状态不一致。

建议：

- 二选一。优先保留 Bootstrap data API，去掉手动 show。

### 14. 移动筛选抽屉是自制遮罩，缺少完整交互

位置：

- `plugins/BanliTheme/Views/category.blade.php:397`
- `plugins/BanliTheme/Views/category.blade.php:597`
- `plugins/BanliTheme/Views/category.blade.php:604`

问题：

- 筛选面板通过 `.left-column` fadeIn/fadeOut 自制，没有 focus trap、ESC 关闭、关闭按钮、body scroll lock。
- `setTimeout("...")` 使用字符串执行，属于不必要的 eval 风格。
- 手机用户打开筛选后不够明确如何退出。

建议：

- 改成 Bootstrap offcanvas。
- 添加明确关闭按钮、标题、应用/重置按钮。
- 不使用字符串形式 `setTimeout`。

### 15. 头部和页面顶部间距用硬编码 padding，容易错位

位置：

- `plugins/BanliTheme/Views/layout/master.blade.php:133`
- `plugins/BanliTheme/Views/search.blade.php:11`
- `plugins/BanliTheme/Views/category.blade.php:13`

问题：

- 多个页面自己写 `padding-top: 104px/132px/176px`。
- header 高度会因 top bar、语言/货币、滚动态、移动端换行而变化。
- 页面之间容易出现顶部空白不一致或内容被遮挡。

建议：

- 统一通过 JS 或 CSS 变量计算 `--banli-header-height`。
- 所有非首页页面引用同一个变量。

### 16. 分类和搜索页产品卡片行为不一致

位置：

- `plugins/BanliTheme/Views/shared/product.blade.php:23`
- `plugins/BanliTheme/Views/search.blade.php:138`
- `plugins/BanliTheme/Views/category.blade.php:522`

问题：

- 是否显示按钮依赖 `request('style_list')` 和传入的 `$style_list`。
- 搜索页没有工具条，分类页有工具条。
- 手机列表样式、网格样式、hover 按钮在不同入口上行为不统一。

建议：

- 明确产品卡片 props：`mode=grid|list`、`show_actions=true|false`。
- 不要让 shared component 直接读 request 决定 UI。

## P3 维护性与可访问性问题

### 17. 大量内联 CSS/JS 让主题不可维护

位置示例：

- `plugins/BanliTheme/Views/layout/header.blade.php:14`
- `plugins/BanliTheme/Views/layout/master.blade.php:117`
- `plugins/BanliTheme/Views/cart/mini.blade.php:1`
- `plugins/BanliTheme/Views/product/product.blade.php:630`

问题：

- 样式散落在多个 Blade 文件里，覆盖顺序难推断。
- 同一组件难复用，也难做移动端回归测试。

建议：

- 把主题级样式迁移到 `Resources/.../scss`。
- Blade 只保留必要的结构和少量动态 style 变量。

### 18. 每页加载 Vue，部分页面又重复加载 Vue

位置：

- `plugins/BanliTheme/Views/layout/master.blade.php:50`
- `plugins/BanliTheme/Views/cart/cart.blade.php:6`
- `plugins/BanliTheme/Views/checkout.blade.php:6`

问题：

- 主布局已经加载 Vue。
- 购物车/结账页又 push 一次 Vue。
- 重复加载会增加体积，也可能让之前注册在 Vue 全局上的组件/插件状态丢失。

建议：

- Vue 只在主布局或需要页面加载一次。
- ElementUI 只在购物车/结账等需要页面加载。

### 19. 外链新窗口缺少 rel

位置：

- `plugins/BanliTheme/Views/layout/footer.blade.php:106`
- `plugins/BanliTheme/Views/layout/header.blade.php:656`
- `plugins/BanliTheme/Views/shared/menu-mobile.blade.php:39`

问题：

- `target="_blank"` 没有 `rel="noopener noreferrer"`。
- 属于低级别安全与性能问题。

建议：

- 对所有新窗口链接补 `rel="noopener noreferrer"`。

### 20. 交互控件语义不稳定

位置示例：

- `plugins/BanliTheme/Views/checkout/_address.blade.php:112`
- `plugins/BanliTheme/Views/layout/header.blade.php:263`
- `plugins/BanliTheme/Views/shared/product.blade.php:31`

问题：

- 有些行为控件用 `<a href="javascript:void(0)">`，有些甚至把 `javascript:void(0)` 写进 class。
- 部分按钮依赖 inline onclick，难以管理 loading、disabled、埋点和可访问性。

建议：

- 行为用 `<button type="button">`。
- 链接只用于导航。
- JS 行为统一事件绑定或组件方法。

## 建议修复顺序

1. 先修 P1：视频 JS 注入、offcanvas z-index、插件资源打包、规格禁用项、详情页防连点、迷你购物车数量。
2. 再修交易路径 P2：结账动态 HTML、结账防重复提交、搜索重复绑定。
3. 然后产品化：移除硬编码 AI 内容，订阅改为真实功能或后台开关，多语言补齐。
4. 最后治理结构：内联 CSS/JS 收敛、产品卡片 props 化、统一 header 高度变量。

## 前端 QA / UIUX 审计规划

目标：把“看起来有问题”拆成可复现、可验收、可排期的专业检查项。每次主题改动后，至少跑首页、分类页、搜索页、商品详情、购物车、登录页；交易相关改动再补结账页。

### A. UI/UX Audit：用户体验审计

检查目标：

- 用户是否能在 3 秒内理解当前页面是什么、能做什么。
- 主要操作是否明显：搜索、加入购物车、筛选、结账、登录。
- 文案是否符合电商/企业独立站语境，没有演示站、活动站、AI 峰会残留。
- 空状态、错误状态、加载状态是否清楚。

检查方法：

- 桌面 `1440x900`、手机 `390x844` 各跑一遍。
- 首屏截图后，记录 H1/H2、主 CTA、导航、商品卡片是否可读。
- 对搜索、筛选、购物车、规格选择做一次无害交互。

通过标准：

- 首屏主体明确，无无关演示内容。
- CTA 不被遮挡、不裁切、不和背景混在一起。
- 空购物车、无搜索结果、未登录状态有清楚下一步。

当前已知问题：

- 手机首页 Hero 文案对比度和可读性不足，CTA 有裁切风险。

### B. Frontend QA / Smoke Test：前端质量冒烟测试

检查目标：

- 核心页面能打开，HTTP 状态正确。
- 核心交互不抛 JS 异常。
- 不做完整业务回归，但要快速发现阻断性前端问题。

检查页面：

- `/`
- `/categories/100006`
- `/products/search?keyword=dress`
- 任一真实商品详情页，如 `/products/1`
- `/carts`
- `/login`
- 有购物车数据时补 `/checkout`

通过标准：

- 预期页面返回 `200`；需要登录的页面允许 `302` 到 `/login`。
- 页面非空，无 Laravel/框架错误页。
- console 无相关 `error`，无未捕获异常。
- 搜索、菜单、筛选、购物车入口至少能打开。

记录格式：

- 页面路径
- HTTP 状态
- console error/warn
- 交互结果
- 截图路径
- 是否通过

### C. Visual Regression：视觉回归问题

检查目标：

- 本次修改是否让原本正常的页面视觉退化。
- 关注错位、遮挡、间距异常、按钮状态异常、文字不可读。

检查方法：

- 每个核心页面保存桌面和手机首屏截图。
- 截图前等待页面稳定：`load` 后等待 `800-1500ms`，图片加载完成，交互动效结束。
- 对 offcanvas/modal 截图前等待 `.show`、`visibility: visible`、`transform` 稳定。

通过标准：

- 首屏没有明显跳动、遮挡、错位、半透明导致不可读。
- 主题视觉一致，按钮、卡片、导航、footer 不出现局部旧样式。

当前已知问题：

- 手机 Hero 视觉可读性差。
- 分类筛选打开后面板位置异常。

### D. Responsive QA：响应式适配检查

检查目标：

- 手机、平板、桌面断点结构合理。
- header、导航、商品网格、筛选、footer 在小屏不挤压。

建议视口：

- 手机：`390x844`
- 小手机兜底：`360x740`
- 平板：`768x1024`
- 桌面：`1440x900`

重点区域：

- header top bar、logo、搜索、菜单、账户、购物车。
- 首页 Hero、倒计时条、marquee、图文模块。
- 分类页筛选、排序、产品网格。
- 商品详情图集、规格、数量、购买按钮。
- footer 链接组和联系信息。

通过标准：

- 无横向滚动。
- 触控目标建议不小于 `40x40px`，最低不低于 `32x32px`。
- 主要文案不截断，长商品名有合理行数限制。

### E. Layout Overflow / Clipping：布局溢出 / 内容裁切

检查目标：

- 检查元素是否超出视口，导致横向滚动或内容被裁。

检查方法：

- 对比 `documentElement.scrollWidth` 和 `window.innerWidth`。
- 扫描 `getBoundingClientRect()`，记录 `left < 0` 或 `right > innerWidth` 的可见元素。
- 排除有意设计的 marquee、carousel、背景视频，但仍要确认父容器 `overflow:hidden` 正确。

通过标准：

- 页面本身无横向滚动。
- CTA、表单、商品卡片、筛选面板不能被裁切。
- 有意溢出的动效元素不影响可点击区域。

当前已知问题：

- 手机 Hero CTA 和标题容器有裁切迹象。
- 分类 offcanvas 显示状态下实际坐标仍在屏幕外。

### F. Misalignment：错位 / 对不齐

检查目标：

- 组件之间对齐一致，视觉重心稳定。

重点检查：

- header logo 与图标垂直居中。
- 产品卡片图片、标题、价格、按钮高度一致。
- 商品详情左右栏在桌面齐平，手机堆叠顺序合理。
- footer 三列在桌面等高，手机不出现过大空洞。

通过标准：

- 同一行按钮基线一致。
- 同一组件重复项高度、间距、圆角、阴影一致。
- 不出现一个模块“跑出”容器的情况。

### G. Stacking Context / z-index Issue：层级冲突

检查目标：

- offcanvas、modal、dropdown、tooltip、sticky header、backdrop 层级正确。

重点交互：

- 搜索弹窗
- 手机菜单
- 迷你购物车
- 分类筛选
- 商品 quick view
- 语言/货币 dropdown

通过标准：

- 面板在 backdrop 之上。
- backdrop 不压住可交互面板。
- 打开一个面板时 body scroll lock 正常。
- 关闭后 backdrop 和 body class 清理干净。

当前已知风险：

- 分类筛选使用 `offcanvas-lg` 加自定义 sticky/transform，已出现 transform 冲突。

### H. Interaction State Bug：交互状态异常

检查目标：

- 交互状态和 UI 状态一致，不出现“看起来打开但不可用”。

检查项：

- 搜索输入后结果是否更新，旧请求不会覆盖新请求。
- 筛选打开/关闭后 body scroll lock 是否恢复。
- 加入购物车 loading 是否能恢复。
- 规格禁用项是否不可点击。
- 数量输入清空、0、非数字是否能兜底。
- 结账提交失败后按钮是否恢复。

通过标准：

- 每个交互有明确 loading/success/error/empty 状态。
- 重复点击不会重复提交。
- 关闭弹层后焦点、滚动、backdrop 状态恢复。

### I. Console Error Audit：控制台错误审计

检查目标：

- 捕获 JS runtime error、资源 404、第三方脚本异常。

检查方法：

- 监听 `console.error`、`console.warn`、`pageerror`、`requestfailed`。
- 每个页面导航后等待稳定再收集。
- 只记录相关错误，浏览器取消视频 range 请求这类需要区分是否真实故障。

通过标准：

- 无 `Uncaught TypeError`、`ReferenceError`、Vue warning、Bootstrap 初始化异常。
- 无主题资源 404。
- 允许可解释的非阻断 warning，但要记录来源。

当前审计结果：

- 核心页面未发现 JS runtime exception。
- `/account/login` 是错误路径导致 404；真实登录路径为 `/login`。

### J. Asset Loading Audit：静态资源加载检查

检查目标：

- 插件安装后 CSS、JS、图片、视频、字体资源不缺失。

检查方法：

- 扫描 `requestfailed`。
- 检查图片：`img.complete && naturalWidth > 0`。
- 检查视频：资源路径存在，首屏不依赖视频才显示关键文案。
- 新环境应只依赖 `plugins/BanliTheme/Static/public` 可发布资源。

通过标准：

- `public/build/beike/shop/banli_theme/js/app.js` 与插件 Static 构建产物一致。
- `banli_theme-assets` 在插件 Static 中完整。
- 首屏背景图/视频失败时仍有可读 fallback。

### K. 审计输出模板

每次审计建议输出：

```md
## QA Summary

- 范围：
- 视口：
- 工具：
- 结论：

## Findings

1. [P?] 问题标题
   - 页面：
   - 复现：
   - 证据：
   - 影响：
   - 建议修复：

## Checks

| 类别 | 结果 | 备注 |
| --- | --- | --- |
| Console Error Audit | Pass/Fail | ... |
| Responsive QA | Pass/Fail | ... |
| Visual Regression | Pass/Fail | ... |
| Asset Loading Audit | Pass/Fail | ... |

## Screenshots

- desktop:
- mobile:
```

## 建议验收清单

- 新环境只安装 `BanliTheme` 插件后，首页 CSS/JS/图片/视频无 404。
- 手机端依次打开搜索、菜单、购物车，面板都在遮罩上方且可点击。
- 商品详情选择无库存规格不会报错，禁用项不可点。
- 快速连点加入购物车/提交订单不会重复提交。
- 搜索快速输入不会出现旧关键词结果覆盖新关键词。
- 切换语言后，首页、分类、页脚、按钮不出现硬编码中英文混杂。
- 订阅功能要么真实提交，要么不显示。
