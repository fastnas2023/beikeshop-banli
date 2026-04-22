const { chromium } = require('playwright');

(async () => {
  const browser = await chromium.launch();
  const context = await browser.newContext({
    viewport: { width: 375, height: 812 },
    isMobile: true
  });
  const page = await context.newPage();
  await page.goto('http://bk.test');
  await page.screenshot({ path: 'mobile_home.png', fullPage: true });
  
  // also get product cards layout
  const productCards = await page.$$eval('.product-wrap', cards => {
    return cards.map(c => {
      const rect = c.getBoundingClientRect();
      const btnWrap = c.querySelector('.button-wrap');
      const btnRect = btnWrap ? btnWrap.getBoundingClientRect() : null;
      return { width: rect.width, btnWrap: btnRect };
    });
  });
  console.log(JSON.stringify(productCards.slice(0, 3), null, 2));
  
  await browser.close();
})();
