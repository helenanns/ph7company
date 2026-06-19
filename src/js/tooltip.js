import {
  computePosition,
  offset,
  flip,
  shift,
  autoUpdate,
} from '@floating-ui/dom';

class TooltipSystem {
  constructor() {
    this.tooltip = null;
    this.currentTarget = null;
    this.cleanupAutoUpdate = null;
    this.showTimeout = null;
    this.hideTimeout = null;
    
    this.showDelay = 350;
    this.hideDelay = 80;
    
    this.visible = false;
    this.pendingTarget = null;
    
    this.createTooltip();
    this.bindEvents();
  }

  createTooltip() {
    this.tooltip = document.createElement('div');
    this.tooltip.className = 'site-tooltip';
    document.body.appendChild(this.tooltip);
  }

  async updatePosition(target) {
    if (!target || !this.tooltip) return;
    
    const { x, y } = await computePosition(target, this.tooltip, {
      placement: 'top',
      middleware: [
        offset(10),
        flip(),
        shift({ padding: 8 }),
      ],
    });

    Object.assign(this.tooltip.style, {
      left: `${x}px`,
      top: `${y}px`,
    });
  }

  clearTimers() {
    clearTimeout(this.showTimeout);
    clearTimeout(this.hideTimeout);
    this.showTimeout = null;
    this.hideTimeout = null;
  }

  async mount(target) {
    if (this.currentTarget === target && this.visible) return;
    
    const content = target.dataset.tooltip;
    if (!content) return;

    this.pendingTarget = null;
    
    if (this.visible && this.currentTarget !== target) {
      await this.forceHide();
    }

    this.currentTarget = target;
    this.tooltip.innerHTML = content;

    if (this.cleanupAutoUpdate) {
      this.cleanupAutoUpdate();
      this.cleanupAutoUpdate = null;
    }

    this.cleanupAutoUpdate = autoUpdate(
      target,
      this.tooltip,
      () => this.updatePosition(target)
    );

    await this.updatePosition(target);

    if (!this.visible) {
      this.tooltip.offsetHeight;
      this.tooltip.classList.add('show');
      this.visible = true;
    }
  }

  async forceHide() {
    if (this.cleanupAutoUpdate) {
      this.cleanupAutoUpdate();
      this.cleanupAutoUpdate = null;
    }
    
    this.tooltip.classList.remove('show');
    this.visible = false;
    this.currentTarget = null;
    this.pendingTarget = null;
  }

  hide(immediate = false) {
    this.clearTimers();
    
    if (immediate) {
      this.forceHide();
    } else {
      this.hideTimeout = setTimeout(() => {
        this.forceHide();
      }, this.hideDelay);
    }
  }

  show(target) {
    this.clearTimers();
    
    if (this.pendingTarget && this.pendingTarget !== target) {
      this.pendingTarget = null;
    }
    
    if (this.currentTarget === target && this.visible) return;
    
    this.pendingTarget = target;
    
    this.showTimeout = setTimeout(() => {
      if (this.pendingTarget === target) {
        this.mount(target);
      }
      this.pendingTarget = null;
    }, this.showDelay);
  }

  bindEvents() {
    let currentHoverTarget = null;
    
    document.addEventListener('mouseenter', (e) => {
      const target = e.target.closest('[data-tooltip]');
      if (!target) return;
      
      currentHoverTarget = target;
      this.show(target);
    }, true);

    document.addEventListener('mouseleave', (e) => {
      const target = e.target.closest('[data-tooltip]');
      if (!target) return;
      
      const relatedTarget = e.relatedTarget;
      const nextTooltip = relatedTarget?.closest('[data-tooltip]');
      
      if (nextTooltip && nextTooltip !== target) {
        return;
      }
      
      const elementsFromPoint = document.elementsFromPoint(e.clientX, e.clientY);
      const hasTooltipUnderCursor = elementsFromPoint.some(el => 
        el.closest && el.closest('[data-tooltip]')
      );
      
      if (hasTooltipUnderCursor) {
        return;
      }
      
      currentHoverTarget = null;
      this.hide(false);
    }, true);
  }
}

export default TooltipSystem;