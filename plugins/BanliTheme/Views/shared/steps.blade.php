<style>
  .banli-steps-wrap {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
    position: relative;
    width: 100%;
    max-width: 100%;
    padding: 0 8px;
    margin: 0 auto;
  }

  .banli-steps-wrap::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 8%;
    right: 8%;
    border-bottom: 3px solid rgba(255, 255, 255, 0.14);
    pointer-events: none;
  }

  .banli-steps-wrap > div {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1 1 0;
    min-width: 0;
    text-align: center;
  }

  .banli-steps-wrap .number-wrap {
    padding: 0 8px;
    margin-bottom: 10px;
    background: transparent;
  }

  .banli-steps-wrap .number {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    border: 2px solid rgba(255, 255, 255, 0.2);
    background: #fff;
    color: #3c3d41;
    font-weight: 700;
    line-height: 1;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
  }

  .banli-steps-wrap .title {
    color: rgba(255, 255, 255, 0.58);
    font-size: 15px;
    font-weight: 500;
    line-height: 1.35;
  }

  .banli-steps-wrap > div.active .number {
    background: linear-gradient(135deg, #7f5bff 0%, #5c8dff 100%);
    border-color: rgba(126, 121, 255, 0.58);
    color: #fff;
    box-shadow: 0 10px 24px rgba(92, 141, 255, 0.28);
  }

  .banli-steps-wrap > div.active .title {
    color: #fff;
    font-weight: 700;
  }

  @media (max-width: 768px) {
    .banli-steps-wrap {
      gap: 8px;
      padding: 0;
    }

    .banli-steps-wrap::before {
      left: 10%;
      right: 10%;
      top: 13px;
      border-bottom-width: 2px;
    }

    .banli-steps-wrap .number-wrap {
      margin-bottom: 8px;
      padding: 0 4px;
    }

    .banli-steps-wrap .number {
      width: 28px;
      height: 28px;
      font-size: 13px;
    }

    .banli-steps-wrap .title {
      font-size: 12px;
    }
  }
</style>

<div class="steps-wrap banli-steps-wrap">
  <div class="{{ $steps == 1 || $steps == 2 || $steps == 3 ? 'active':'' }}">
    <div class="number-wrap"><span class="number">1</span></div>
    <span class="title">{{ __('shop/steps.cart') }}</span>
  </div>
  <div class="{{ $steps == 2 || $steps == 3  ? 'active':'' }}">
    <div class="number-wrap"><span class="number">2</span></div>
    <span class="title">{{ __('shop/steps.checkout') }}</span>
  </div>
  <div class="{{ $steps == 3 ? 'active':'' }}">
    <div class="number-wrap"><span class="number">3</span></div>
    <span class="title">{{ __('shop/steps.payment') }}</span>
  </div>
</div>
